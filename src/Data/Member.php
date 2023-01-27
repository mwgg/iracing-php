<?php

namespace iRacingPHP\Data;

use iRacingPHP\DataClass;

class Member extends DataClass
{

    /**
     * @param int ['cust_id'] Defaults to the authenticated member.
     * @return mixed
     */
    public function awards(array $params = [])
    {
        return $this->api->request('/member/awards', $params);
    }

    /**
     * @param int $cust_id
     * @param int $category_id 1 - Oval; 2 - Road; 3 - Dirt oval; 4 - Dirt road
     * @param int $chart_type 1 - iRating; 2 - TT Rating; 3 - License/SR
     * 
     * @return mixed
     */
    public function chart_data(int $category_id, int $chart_type, array $params = [])
    {
        $params['category_id'] = $category_id;
        $params['chart_type'] = $chart_type;
        return $this->api->request('/member/chart_data', $params);
    }

    /**
     * @param string $cust_ids [Comma-separated numbers]
     * @param boolean ['include_licenses']
     * 
     * @return mixed
     */
    public function get(string $cust_ids, array $params = [])
    {
        $params['cust_ids'] = $cust_ids;
        return $this->api->request('/member/get', $params);
    }

    /**
     * Always the authenticated member.
     *
     * @return mixed
     */
    public function participation_credits()
    {
        return $this->api->request('/member/participation_credits');
    }

    /**
     * Always the authenticated member.
     *
     * @return mixed
     */
    public function info()
    {
        return $this->api->request('/member/info');
    }

    /**
     * @param int ['cust_id'] Defaults to the authenticated member.
     * @return mixed
     */
    public function profile(array $params = [])
    {
        return $this->api->request('/member/profile', $params);
    }

}