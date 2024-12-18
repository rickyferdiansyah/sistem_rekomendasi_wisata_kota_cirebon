<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wisata extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Wisata');
        $this->load->model('M_ContentBased');
    }

	public function index()
	{
        $data['wisata_list'] = $this->M_Wisata->get_all_wisata();
        $this->load->view('list-wisata', $data);
	}
    public function detail_wisata($id)
    {
        // ----------------------- Pengambilan Data ----------------------
        // Ambil data wisata berdasarkan ID
        $current_wisata = $this->M_Wisata->get_current_wisata_by_id($id);
        // Ambil semua wisata kecuali yang saat ini sedang dibuka
        $wisata_list = $this->M_Wisata->get_all_wisata_except_current($id);


        // ----------------------- Pre Processing ----------------------
        //lakukan case folding pada deskripsi
        foreach ($current_wisata as $wisata) {
            // Remove HTML/PHP tags
            $wisata->deskripsi = $this->M_ContentBased->remove_tags($wisata->deskripsi);
            //case folding
            $wisata->deskripsi = $this->M_ContentBased->case_folding($wisata->deskripsi);
            //punctuation removal
            $wisata->deskripsi = $this->M_ContentBased->punctuation_removal($wisata->deskripsi);
            //tokenizing
            $wisata->deskripsi = $this->M_ContentBased->tokenizing($wisata->deskripsi);
            //stopword removal
            $wisata->deskripsi_clean = $this->M_ContentBased->stopword_removal($wisata->deskripsi);
            //imploding
            // $wisata->deskripsi_cleaned = $this->M_ContentBased->imploding($wisata->deskripsi_clean);
        }
        // Lakukan case folding pada setiap elemen di wisata_list
        foreach ($wisata_list as $wisata) {
            // Remove HTML/PHP tags
            $wisata->deskripsi = $this->M_ContentBased->remove_tags($wisata->deskripsi);
            //case folding
            $wisata->deskripsi = $this->M_ContentBased->case_folding($wisata->deskripsi);
            //punctuation removal
            $wisata->deskripsi = $this->M_ContentBased->punctuation_removal($wisata->deskripsi);
            //tokenizing
            $wisata->deskripsi = $this->M_ContentBased->tokenizing($wisata->deskripsi);
            //stopword removal
            $wisata->deskripsi_clean = $this->M_ContentBased->stopword_removal($wisata->deskripsi);
            //imploding
            // $wisata->deskripsi_cleaned = $this->M_ContentBased->imploding($wisata->deskripsi_clean);
        }
        // ----------------------- Jaccard Similarity ----------------------
        $similarities = [];
        foreach ($wisata_list as $wisata) {
            $similarity = $this->M_ContentBased->jaccard_similarity($current_wisata[0]->deskripsi_clean, $wisata->deskripsi_clean);
            $similarities[$wisata->id] = $similarity;
        }

        // Copy wisata_list untuk rekomendasi lokasi
        $wisata_by_location = $wisata_list;

        // ----------------------- Sorting by Similarity ----------------------
        $wisata_by_similarity = $wisata_list; // Salin array wisata_list
        usort($wisata_by_similarity, function($a, $b) use ($similarities) {
            return $similarities[$b->id] <=> $similarities[$a->id];
        });


        


        // ----------------------- Distance Calculation ----------------------
        $current_lat = $current_wisata[0]->lat;
        $current_lon = $current_wisata[0]->lon;

        foreach ($wisata_by_location as $wisata) {
            $distance = $this->M_Wisata->calculate_distance(
                $current_lat,
                $current_lon,
                $wisata->lat,
                $wisata->lon
            );
            $wisata->distance = $distance;
        }

        // ----------------------- Sorting by Distance ----------------------
        usort($wisata_by_location, function($a, $b) {
            return $a->distance <=> $b->distance;
        });


        // ----------------------- Data untuk View ----------------------
        $data['current_wisata'] = $this->M_Wisata->get_current_wisata_by_id($id);
        $data['wisata_by_similarity'] = $wisata_by_similarity; // Rekomendasi berdasarkan kemiripan
        $data['wisata_by_location'] = $wisata_by_location; // Rekomendasi berdasarkan lokasi
        $data['similarities'] = $similarities; // Menambahkan data similarity ke view


        // Load view
        $this->load->view('detail-wisata', $data);
    }

}
