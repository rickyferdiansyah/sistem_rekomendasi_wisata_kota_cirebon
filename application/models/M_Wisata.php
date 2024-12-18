<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Wisata extends CI_Model
{
    public function get_all_wisata()
    {
        $this->db->from('wisata');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function get_current_wisata_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->from('wisata');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function get_all_wisata_except_current($id)
    {
        $this->db->where('id !=', $id);
        $this->db->from('wisata');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function calculate_distance($lat1, $lon1, $lat2, $lon2)
    {
        $earth_radius = 6371; // Radius bumi dalam kilometer

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earth_radius * $c;

        return $distance; // Jarak dalam kilometer
    }


}
