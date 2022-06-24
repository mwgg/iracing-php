# iracing-php
iRacing Data API wrapper for PHP. API documentation and additional information can be found on the [iRacing Forums](https://forums.iracing.com/discussion/15068/general-availability-of-data-api/p1).

## Basic usage

Install with composer:
```
composer require mwgg/iracing-php
```
The names of all API services and methods match their API endpoints.

API Documentation excerpt:
```json
"stats": {
    "member_summary": {
        "link": "https://members-ng.iracing.com/data/stats/member_summary",
        "parameters": {
            "cust_id": {
                "type": "number",
                "note": "Defaults to the authenticated member."
            }
        }
    }
}
```
iRacingPHP:
```php
use iRacingPHP\iRacing;
$iracing = new iRacing('your@login.com', 'iRacingPassword');
$summary = $iracing->stats->member_summary();
```
Note that the `cust_id` parameter is optional in this case, thus may be omitted. All parameters that are denoted as required by the API documentation must be passed as separate parameters to the API method, optional parameters are grouped into a separate array parameter. This makes it easier to deal with methods that have a large number of optional parameters.

API Documentation excerpt:
```json
"league": {
    "season_standings": {
        "link": "https://members-ng.iracing.com/data/league/season_standings",
        "parameters": {
            "league_id": {
                "type": "number",
                "required": true
            },
            "season_id": {
                "type": "number",
                "required": true
            },
            "car_class_id": {
                "type": "number"
            },
            "car_id": {
                "type": "number",
                "note": "If car_class_id is included then the standings are for the car in that car class, otherwise they are for the car across car classes."
            }
        }
    }
}
```
iRacingPHP:
```php
use iRacingPHP\iRacing;
$iracing = new iRacing('your@login.com', 'iRacingPassword');
$standings = $iracing->league->season_standings(12345, 54321, [
    'car_id' => 123
]);
```

## Rate Limits
After making a request it is possible to check current rate limit values.
```php
$iracing->api->rateLimits->limit; // The current total rate limit
$iracing->api->rateLimits->remaining; // How much of the rate limit you have remaining
$iracing->api->rateLimits->reset; // When the rate limit will reset in epoch timestamp
```
Note that these rate limit values will update after all requests, *except* the `$iracing->constants->` endpoints, since those are retrieved locally.

## Cookies
iRacingPHP makes use of cookies to persist authentication between requests and executions. By default, cookies are stored in `/tmp/iracingphpcookie`.

If you wish to change the location of the cookie file, you may do so when instantiating the iRacing object:

```php
$iracing = new iRacing('your@login.com', 'iRacingPassword', '/path/to/cookies');
```

As long as the same path is used across all requests and executions, authentication will persist.

## Exceptions
iRacingPHP throws the following exceptions:

`iRacingPHP\Exceptions\ApiServiceNotFoundException` is thrown when attempting to access a non-existent API service.

`iRacingPHP\Exceptions\AuthenticationRequestFailedException` is thrown when authentication request fails for any reason.

`iRacingPHP\Exceptions\AuthenticationFailedException` is thrown when the authentication HTTP request succeeded but authentication did not happen (wrong username or password, etc).

`iRacingPHP\Exceptions\RequestFailedException` is thrown when the API endpoint request fails.

`iRacingPHP\Exceptions\DataRequestFailedException` is thrown when a request to retrieve cached data fails.

`iRacingPHP\Exceptions\RequestRateLimitedException` is thrown when a request failed due to rate limiting.

`iRacingPHP\Exceptions\SiteMaintenanceException` is thrown when iRacing services are down for maintenance.

In all cases you can view the error message using `$e->getMessage();`

In all cases but the `iRacingPHP\Exceptions\ApiServiceNotFoundException` exception, the parent Guzzle exception is chained with the iRacingPHP exception.
