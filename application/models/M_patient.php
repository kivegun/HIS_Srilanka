<?php

/**
 * Created by PhpStorm.
 * User: ManhDX
 * Date: 16-Oct-15
 * Time: 2:35 PM
 */
class m_patient extends MY_CRUD
{
    public function __construct()
    {
        parent::__construct();
        $this->_table = 'patient';
        $this->primary_key = 'PID';
        $this->belongs_to = array(
            'province' => array('model' => 'm_who_provinces', 'primary_key' => 'who_province_id'),
            'district' => array('model' => 'm_who_district', 'primary_key' => 'who_district_id'),
            'health_unit' => array('model' => 'm_who_health_unit', 'primary_key' => 'who_health_unit_id')
        );
    }

    public function generate_hin($id)
    {
        $result = "";
        for ($number_of_digit = 0; $number_of_digit < 9; $number_of_digit++) {
            if ($id > 0) {
                $last_digit = $id % 10;
                $id = $id / 10;
                $result = strval($last_digit) . $result;
            } else {
                $result = "0" . $result;
            }
        }
        return $result;
    }

    public function generate_present_hin($hin)
    {
        // $his is string
        $result = "";
        $len = strlen($hin) - 1;
        $count = 0;
        while ($len >= 0) {
            $count++;
            $result = strval($hin[$len]) . $result;
            if ($count == 3) {
                $count = 0;
                if ($len > 0) {
                    $result = "-" . $result;
                }
            }
            $len -= 1;
        }
        return $result;
    }

    public function get_patient($id)
    {
        $patient = $this->as_array()
            ->with('province')
            ->with('district')
            ->with('health_unit')
            ->get($id);
        $patient['HIN'] = $this->generate_hin($id);
        $patient['Present_HIN'] = $this->generate_present_hin($patient['HIN']);
//        var_dump($patient);
        return $patient;
    }
}