<?php

namespace iRacingPHP\Data;

use iRacingPHP\DataClass;

class Member extends DataClass
{

    /**
     * @param integer $cust_id
     * @param integer $category_id 1 - Oval; 2 - Road; 3 - Dirt oval; 4 - Dirt road
     * @param integer $chart_type 1 - iRating; 2 - TT Rating; 3 - License/SR
     * 
     * @return mixed
     */
    public function chart_data(int $cust_id, int $category_id, int $chart_type)
    {
        $params = array(
            'cust_id' => $cust_id,
            'category_id' => $category_id,
            'chart_type' => $chart_type
        );
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
        return $this->api->request('/member/get', $params);
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
        return $this->api->request('/member/profile');
    }

}