<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_ContentBased extends CI_Model
{
    public function remove_tags($text)
    {
        // Hapus semua tag HTML dan PHP
        $clean_text = strip_tags($text);
        return $clean_text;
    }
    public function case_folding($current_wisata)
    {
        $current_wisata = strtolower($current_wisata);
        return $current_wisata;
    }

    public function punctuation_removal($text)
    {
        // Menghapus semua tanda baca menggunakan regex
        $text = preg_replace('/[^\w\s]/u', '', $text);
        return $text;
    }
    public function tokenizing($text)
    {
        $tokens = explode(' ', $text);
        return $tokens;
    }

    public function stopword_removal($words)
    {
        // Daftar stopword (bisa ditambah sesuai kebutuhan)
        $stopwords = [
            'di', 'ke', 'dari', 'dan', 'yang', 'ini', 'itu', 'untuk', 'pada', 'dengan',
            'adalah', 'atau', 'karena', 'jika', 'sudah', 'belum', 'sangat', 'juga',
            'seperti', 'tetapi', 'agar', 'oleh', 'dalam', 'yaitu', 'serta', 'sebagai', 
            'namun', 'tidak', 'ada', 'selain', 'setelah', 'masing-masing', 'sekitar', 'naik'
        ];
        
        $filtered_words = array_filter($words, function ($word) use ($stopwords) {
            return !in_array(strtolower($word), $stopwords); // Pastikan perbandingan case-insensitive
        });

        // Gabungkan kata-kata kembali menjadi string
        // $filtered_text = implode(' ', $filtered_words);

        return $filtered_words;
    }

    public function imploding($words)
    {
        // Gabungkan kata-kata kembali menjadi string
        $filtered_text = implode(' ', $words);
    }

    // Fungsi Jaccard Similarity untuk menghitung kemiripan dua set kata
    public function jaccard_similarity($set1, $set2)
    {
        // Menghitung irisan (intersection) dan gabungan (union) dari dua set
        $intersection = count(array_intersect($set1, $set2));
        $union = count(array_unique(array_merge($set1, $set2)));

        // Menghitung Jaccard Similarity
        if ($union == 0) {
            return 0; // Jika union kosong, kemiripan dianggap 0
        }

        return $intersection / $union;
    }



}
