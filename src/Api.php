<?php

namespace iRacingPHP;

use iRacingPHP\Exceptions\AuthenticationFailedException;
use iRacingPHP\Exceptions\AuthenticationRequestFailedException;
use iRacingPHP\Exceptions\RequestRateLimitedException;
use iRacingPHP\Exceptions\SiteMaintenanceException;
use iRacingPHP\Exceptions\RequestFailedException;
use iRacingPHP\Models\RateLimits;
use \GuzzleHttp\Cookie\FileCookieJar;
use iRacingPHP\Exceptions\DataRequestFailedException;

class Api
{
    private string $username;
    private string $loginHash;

    private FileCookieJar $jar;
    private \GuzzleHttp\Client $guzzle;

    public RateLimits $rateLimits;

    function __construct(string $username, string $password, string $cookiejar)
    {
        $this->username = $username;
        $this->loginHash = $this->hashLogin($username, $password);
        $this->jar = new FileCookieJar($cookiejar);
        $this->guzzle = new \GuzzleHttp\Client();
        $this->rateLimits = new RateLimits();
    }

    /**
     * Calls requestLogin() to make the authentication request, checks the response.
     *
     * @return mixed Authentication response
     * @throws AuthenticationFailedException
     */
    private function authenticate()
    {
        $auth = $this->requestLogin();

        if($auth->authcode === 0)
        {
            throw new AuthenticationFailedException($auth->message);
        }

        return $auth;
    }

    /**
     * Hashes the username and password according to iRacing requirements.
     *
     * @param string $username
     * @param string $password
     * @return string
     */
    private function hashLogin(string $username, string $password)
    {
        $concat = mb_convert_encoding($password . strtolower($username), 'UTF-8');
        $hash = hash('sha256', $concat, true);
        return base64_encode($hash);
    }

    /**
     * Makes a POST request to authenticate.
     *
     * @return mixed Authentication result
     * @throws AuthenticationRequestFailedException
     */
    private function requestLogin()
    {
        try
        {
            $response = $this->guzzle->request('POST', 'https://members-ng.iracing.com/auth', [
                'cookies' => $this->jar,
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'body' => json_encode([
                    'email' => $this->username,
                    'password' => $this->loginHash
                ])
            ]);

            return json_decode($response->getBody());
        }
        catch(\GuzzleHttp\Exception\BadResponseException $e)
        {
            throw new AuthenticationRequestFailedException($e->getMessage(), 0, $e);
        }

        return null;
    }

    /**
     * Retrieved cached data via the URL provided by the API,
     * and any associated chunks.
     *
     * @param string $url
     * @return mixed
     * @throws DataRequestFailedException
     */
    private function retrieveData(string $url)
    {
        try
        {
            $response = $this->guzzle->request('GET', $url);
            $responseBody = json_decode($response->getBody());

            if(isset($responseBody->chunk_info))
            {
                $responseBody->data = $this->retrieveChunks($responseBody->chunk_info);
                unset($responseBody->chunk_info);
            }

            return $responseBody;
        }
        catch(\GuzzleHttp\Exception\BadResponseException $e)
        {
            throw new DataRequestFailedException($e->getMessage(), 0, $e);
        }
        return null;
    }

    /**
     * Retrieves cached data chunks from the URL provided by the API.
     *
     * @param mixed $body
     * @return mixed
     * @throws DataRequestFailedException
     */
    private function retrieveChunks(mixed $chunks)
    {
        $result = [];
        try
        {
            $baseUrl = $chunks->base_download_url;
            foreach($chunks->chunk_file_names as $fileName)
            {
                $response = $this->guzzle->request('GET', $baseUrl . $fileName);
                $result[] = json_decode($response->getBody());
            }

            return $result;
        }
        catch(\GuzzleHttp\Exception\BadResponseException $e)
        {
            throw new DataRequestFailedException($e->getMessage(), 0, $e);
        }
    }

    /**
     * Public request method, used by the Data classes.
     * Retrieves the cached data link or chunk data from the API endpoint, then the data itself.
     *
     * @param string $endpoint 
     * @param array $data Optional parameters to be passed with the request
     * @return mixed Requested data
     */
    public function request(string $endpoint, array $data = [])
    {
        $url = LibConstants::APIURL . $endpoint;
        try
        {
            $response = $this->guzzle->request('GET', $url, [
                'cookies' => $this->jar,
                'query' => $data
            ]);

            $this->setRateLimits($response);

            $responseBody = json_decode($response->getBody());
            if(isset($responseBody->link))
            {
                return $this->retrieveData($responseBody->link);
            }
            if(isset($responseBody->data->chunk_info))
            {
                return $this->retrieveChunks($responseBody->data->chunk_info);
            }
        }
        catch(\GuzzleHttp\Exception\BadResponseException $e)
        {
            $response = $e->getResponse();
            $this->setRateLimits($response);
            if($this->shouldRetryRequest($response, $e->getMessage(), $e))
            {
                return $this->request($endpoint, $data);
            }
        }
        return null;
    }

    /**
     * Updates the rate limit values.
     *
     * @param \GuzzleHttp\Psr7\Response $response API request response object.
     * @return void
     */
    private function setRateLimits(\GuzzleHttp\Psr7\Response $response)
    {
        $this->rateLimits->limit = (int)$response->getHeaderLine('x-ratelimit-limit');
        $this->rateLimits->remaining = (int)$response->getHeaderLine('x-ratelimit-remaining');
        $this->rateLimits->reset = (int)$response->getHeaderLine('x-ratelimit-reset');
    }

    /**
     * Checks response code, attempts authentication if unauthorized, throws specific exceptions otherwise.
     *
     * @param \GuzzleHttp\Psr7\Response $response Response returned by the request
     * @param string $message Response message to be injected into Exceptions
     * @return boolean True if another attempt to make the request should be made (after authentication)
     * @throws RequestRateLimitedException
     * @throws SiteMaintenanceException
     * @throws RequestFailedException|AuthenticationFailedException
     */
    private function shouldRetryRequest(\GuzzleHttp\Psr7\Response $response, string $message, \Exception $oldEx)
    {
        switch($response->getStatusCode())
        {
            case 401:
                $this->authenticate();
                return true;
            case 429:
                throw new RequestRateLimitedException('Rate limit exceeded', 0, $oldEx);
            case 503:
                throw new SiteMaintenanceException('Site maintenance', 0, $oldEx);
        }

        throw new RequestFailedException($message, 0, $oldEx);
    }

}