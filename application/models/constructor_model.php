<?php

class Constructor_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function locations($p_date) {

        $date = $this->get_date_search($p_date);

        $result = false;

        if ($date != false) {
            $sql = "SELECT DISTINCT l.id, l.name AS name_locality, d.name AS name_deparment FROM province p JOIN department d ON d.province_id = p.id JOIN locality l ON l.department_id = d.id JOIN pharmacy ph ON ph.locality_id = l.id JOIN turn t ON t.pharmacy_id = ph.id WHERE t.date ='" . addslashes($date) . "' ORDER BY l.name;";
            $locations = $this->db->query($sql)->result();

            $result = array(0 => '');

            foreach ($locations as $location) {
                $result[$location->id] = $location->name_locality . ' (' . $location->name_deparment . ')';
            }
        }
        return $result;
    }

    function all_locations_dropdown() {
        $result = array(0 => '');
        foreach ($this->localities() as $locality)
            $result[$locality->id] = $locality->name_locality . ' (' . $locality->name_deparment . ')';

        return $result;
    }

    function localities() {
        $sql = "SELECT DISTINCT l.id, l.name AS name_locality, d.name AS name_deparment FROM province p JOIN department d ON d.province_id = p.id JOIN locality l ON l.department_id = d.id JOIN pharmacy ph ON ph.locality_id = l.id ORDER BY l.name;";
        return $this->db->query($sql)->result();
    }

    function all_pharmacies_by_locations($location_id) {
        $sql = "SELECT *, p.name AS name_pharmacy, l.name AS name_locality FROM pharmacy p JOIN locality l ON l.id = p.locality_id WHERE l.id = $location_id ORDER BY p.name; ";
        return $this->db->query($sql)->result();
    }

    function get_date_search($p_date) {
        if ($p_date == date('Y-m-d')) {
            $hour = date('H');
            if ($hour < 8) {
                $date = date('Y-m-d', strtotime('-1 day'));
            } else {
                $date = date('Y-m-d');
            }
        } elseif ($p_date > date('Y-m-d') && $p_date <= $this->date_max()) {
            $date = $p_date;
        } else {
            $date = false;
        }

        return $date;
    }

    function pharmacies_on_turn($obj) {
        $hour = date('H');

        if ($hour < 8) {
            $date_temp = strtotime('-1 day', strtotime($obj->date_turn));
            $date = date('Y-m-d', $date_temp);
        } else {
            $date = $obj->date_turn;
        }

        $sql = "SELECT t.date, p.telephone, p.address, p.name AS name_pharmacy, l.name AS name_locality, d.name AS name_department, pr.name AS name_province, p.latitude, p.longitude, p.foto, p.locality_id FROM turn t JOIN pharmacy p ON t.pharmacy_id = p.id JOIN locality l ON l.id = p.locality_id JOIN department d ON d.id = l.department_id JOIN province pr ON pr.id = d.province_id WHERE t.date = '$date' AND l.id = $obj->location ORDER BY t.order; ";
        return $this->db->query($sql)->result();
    }

    function date_max() {
        $sql = "SELECT MAX(date) AS date_max FROM turn";
        return $this->db->query($sql)->row()->date_max;
    }

    function all_pharmacies() {
        $sql = "SELECT ph.address, d.name AS name_department,p.name AS name_province, ph.name AS name_pharmacy, l.id, l.name AS name_locality, d.name AS name_deparment FROM province p JOIN department d ON d.province_id = p.id JOIN locality l ON l.department_id = d.id JOIN pharmacy ph ON ph.locality_id = l.id ORDER BY l.name;";
        return $this->db->query($sql)->result();
    }

}
