<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;

class ChartData extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    private function getLamaPengerjaan($date_proposal, $date_semhas){
        $proposal = new DateTime($date_proposal);
        $semhas = new DateTime($date_semhas);
        $interval = $semhas->diff($proposal);
        $days = $interval->format('%a');
        $months = floor($days/30);
        return (int)$months;
    }

    private function getStatusRekomendasi($bidang, $rekomendasi)
    {
        $hasil = '';
        if($bidang == $rekomendasi){
            $hasil = 'Rekomendasi sama';
        }else{
            $hasil = 'Rekomendasi berbeda';
        }
        return $hasil;
    }

    private function getBidangAbv($bidang)
    {
        $bidang_abv = array('Tata Kelola & Manajemen Sistem Informasi' => 'TKMSI', 
            'Pengembangan Sistem Informasi' => 'PSI', 
            'Manajemen Data & Informasi' => 'MDI', 
            'Sistem Informasi Geografis' => 'SIG');
        return $bidang_abv[$bidang];
    }

    public function getChartBidang($collection)
    {
        $chart_data = array();
        $datasets = [];
        if($collection->isEmpty()){
            $chart_data = NULL;
        }else{
            foreach($collection as $c => $key){
                $datasets[$c]['bidang'] = $this->getBidangAbv($key->skripsi_bidang);
            }
            $datasets = collect($datasets);
            $unique_bidang = $datasets->pluck('bidang')->unique()->sort()->values();
            foreach($unique_bidang as $bidang => $header){
                $chart_data[$header] = $datasets->where('bidang', $header)->count();
            }
            $chart_data = json_encode($chart_data);
        }
        return $chart_data;
    }

    public function getChartRekomendasi($collection)
    {
        $chart_data = array();
        $datasets = [];
        if($collection->isEmpty()){
            $chart_data = NULL;
        }else{
            foreach($collection as $c => $key){
                $datasets[$c]['rekomendasi'] = $this->getBidangAbv($key->skripsi_bidang_rekomendasi);
            }
            $datasets = collect($datasets);
            $unique_rekomendasi = $datasets->pluck('rekomendasi')->unique()->sort()->values();
            foreach($unique_rekomendasi as $rekomendasi => $header){
                $chart_data[$header] = $datasets->where('rekomendasi', $header)->count();
            }
            $chart_data = json_encode($chart_data);
        }
        return $chart_data;
    }

    public function getChartBidangXWaktu($collection)
    {
        $datasets = [];
        $chart_data = array();
        if($collection->isEmpty()){
            $chart_data = NULL;
        }else{
            foreach($collection as $c => $key){
                $datasets[$c]['bidang'] = $this->getBidangAbv($key->skripsi_bidang);
                $datasets[$c]['lama'] = $this->getLamaPengerjaan($key->skripsi_tanggal_proposal, $key->skripsi_tanggal_semhas);
            }
            $datasets = collect($datasets);
            $unique_bidang = $datasets->pluck('bidang')->unique()->sort()->values();
            $unique_month = $datasets->pluck('lama')->unique()->sort()->values();
            foreach($unique_month as $month){
                foreach($unique_bidang as $bidang => $header){
                    $chart_data[$header][$month] = $datasets->where('bidang', $header)->where('lama', $month)->count();
                }
            }
            $chart_data = json_encode($chart_data);
        }
        return $chart_data;
    }

    public function getChartBidangXRekomendasi($collection)
    {
        $datasets = [];
        $chart_data = array();
        if($collection->isEmpty()){
            $chart_data = NULL;
        }else{
            foreach($collection as $c => $key){
                $datasets[$c]['bidang'] = $this->getBidangAbv($key->skripsi_bidang);
                $datasets[$c]['rekomendasi'] = $this->getBidangAbv($key->skripsi_bidang_rekomendasi);
            }
            $datasets = collect($datasets);
            $unique_bidang = $datasets->pluck('bidang')->unique()->sort()->values();
            foreach($unique_bidang as $bidang => $header){
                foreach($unique_bidang as $b => $content){
                    $chart_data[$header][$content] = $datasets->where('bidang', $header)->where('rekomendasi', $content)->count();
                }
            }
            $chart_data = json_encode($chart_data);
        }
        return $chart_data;
    }

    public function getChartBidangXRekomendasiWaktu($collection)
    {
        $datasets = [];
        $chart_data = array();
        if($collection->isEmpty()){
            $chart_data = NULL;
        }else{
            foreach($collection as $c => $key){
                $datasets[$c]['rekomendasi'] = $this->getStatusRekomendasi($key->skripsi_bidang, $key->skripsi_bidang_rekomendasi);
                $datasets[$c]['lama'] = $this->getLamaPengerjaan($key->skripsi_tanggal_proposal, $key->skripsi_tanggal_semhas);
            }
            $datasets = collect($datasets);
            $unique_month = $datasets->pluck('lama')->unique()->sort()->values();
            $unique_recommendation = $datasets->pluck('rekomendasi')->unique()->sort()->values();
            foreach($unique_month as $month){
                foreach($unique_recommendation as $recommendation){
                    $chart_data[$recommendation][$month] = $datasets->where('rekomendasi', $recommendation)->where('lama', $month)->count();
                }
            }
            $chart_data = json_encode($chart_data);
        }
        return $chart_data;
    }
}
