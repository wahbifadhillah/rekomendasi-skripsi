<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use App\Dataset;
use App\Training;
use App\Testing;
use App\DecisionTree;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('role:kaprodi,kjfd');
    }
    
    private function getLamaPengerjaan($date_proposal, $date_semhas){
        $proposal = new DateTime($date_proposal);
        $semhas = new DateTime($date_semhas);
        $interval = $semhas->diff($proposal);
        $days = $interval->format('%a');
        $months = floor($days/30);
        return (int)$months;
    }

    private function getAngkatan($NIM){
        $angkatan = substr($NIM, 0, 2);
        return '20'.$angkatan;
    }

    private function getFilters($model, $table, $deleted){
        $cols = Schema::getColumnListing($table);
        $filters = array();
        $work_months_date = array();
        $work_months = array();
        $list_angkatan = array();
        foreach($cols as $col){
            $col_newname = $col;
            if($col == 'NIM') {
                $col_newname = 'angkatan';
                foreach(collect($model::select($col)->get()) as $nim){
                    $angkatan = $this->getAngkatan($nim['NIM']);
                    array_push($list_angkatan, $angkatan);
                }
                $list_angkatan = collect(array_values(array_unique($list_angkatan)));
                $filters[$col_newname] = $list_angkatan->sort();
            }
            else{
                $work_months_date[$col] = collect($model::select($col)->get());
            }

        }
        // 
        $work_months_date = collect($work_months_date);
        foreach($deleted as $del){
            $work_months_date->forget($del);
        }
        foreach($work_months_date['skripsi_tanggal_proposal'] as $key => $value){
            $proposal = $work_months_date['skripsi_tanggal_proposal'][$key]->skripsi_tanggal_proposal;
            $semhas = $work_months_date['skripsi_tanggal_semhas'][$key]->skripsi_tanggal_semhas;
            $work_month = $this->getLamaPengerjaan($proposal, $semhas);
            array_push($work_months, $work_month);
        }
        $work_months = collect(array_values(array_unique($work_months)));
        $filters['lama_skripsi'] = $work_months->sort();
        $filters = collect($filters)->sort();
        foreach($deleted as $del){
            $filters->forget($del);
        }
        return $filters;
    }

    public function index(Request $request)
    {
        // Filter attr
        $filters = $this->getFilters(Dataset::class, 'datasets', ['id', 'skripsi_judul', 'skripsi_tahun', 'skripsi_bidang', 'skripsi_bidang_rekomendasi',
        'mk_PGI', 'mk_SIGD1', 'mk_SIGD2', 'mk_SIGL', 'mk_SPK',
        'mk_ABD', 'mk_BDT', 'mk_DBD', 'mk_DM', 'mk_DW',
        'mk_KB', 'mk_PBD', 'mk_ADSI', 'mk_DPSI', 'mk_IPSI',
        'mk_PABW', 'mk_PBPU', 'mk_PPP', 'mk_SE', 'mk_PL',
        'mk_DDAP', 'mk_DIAP', 'mk_EPAP', 'mk_EASI', 'mk_MO',
        'mk_MITI', 'mk_MLTI', 'mk_MP', 'mk_MPSI', 'mk_MRS',
        'mk_MR', 'mk_PPB', 'mk_PSSI', 'mk_TKTI', 'mk_EA',
        'mk_SBF', 'mk_MHP', 'created_at', 'updated_at']);

        $chart_data = new ChartData;
        $use_model = 0;
        // Filter query
        if ($request->has('filter')) {
            $filter = Dataset::query();
            $cfilter = Dataset::query();
            if($request->filled('angkatan')) {
                if($request->angkatan != 'semua_angkatan'){
                    $angkatan = substr($request->angkatan, 2, 4).'%';
                    $filter->where('NIM', 'LIKE', $angkatan);
                    $cfilter->where('NIM', 'LIKE', $angkatan);
                }
            }
            if($request->filled('lama_pengerjaan')) {
                if($request->lama_pengerjaan != 'semua_lama_pengerjaan'){
                    $filter->havingRaw('FLOOR((DATEDIFF(skripsi_tanggal_semhas, skripsi_tanggal_proposal) / 30)) ='.$request->lama_pengerjaan);
                    $cfilter->havingRaw('FLOOR((DATEDIFF(skripsi_tanggal_semhas, skripsi_tanggal_proposal) / 30)) ='.$request->lama_pengerjaan);
                }
            }
                if(!Dataset::get()->isEmpty()){
                    $sbr_l = Dataset::latest()->first();
                    $sbr_o = Dataset::oldest()->first();
                    if($sbr_l->skripsi_bidang_rekomendasi == NULL){
                        $dashboard_datasets_bidang_rekomendasi = NULL;
                        $dashboard_datasets_bidang_rekomendasi_waktu = NULL;
                    }
                    if($sbr_o->skripsi_bidang_rekomendasi != NULL){
                        $dashboard_datasets_bidang_rekomendasi = $chart_data->getChartBidangXRekomendasi($cfilter->get());
                        $dashboard_datasets_bidang_rekomendasi_waktu = $chart_data->getChartBidangXRekomendasiWaktu($cfilter->get());
                    }
                    if($sbr_l->skripsi_bidang_rekomendasi == NULL AND $sbr_o->skripsi_bidang_rekomendasi != NULL){
                        $dashboard_datasets_bidang_rekomendasi = NULL;
                        $dashboard_datasets_bidang_rekomendasi_waktu = NULL;
                    }
                }else{
                    $dashboard_datasets_bidang_rekomendasi = NULL;
                    $dashboard_datasets_bidang_rekomendasi_waktu = NULL;
                }
            $datasets = $filter->latest()->paginate(15);
        }else{
            $datasets = Dataset::query()->latest()->paginate(15);
            if($datasets->isEmpty()){
                $datasets = NULL;
                $dashboard_datasets_bidang_rekomendasi = NULL;
                $dashboard_datasets_bidang_rekomendasi_waktu = NULL;
            }else{
                $sbr_l = Dataset::latest()->first();
                $sbr_o = Dataset::oldest()->first();
                if($sbr_l->skripsi_bidang_rekomendasi == NULL){
                    $use_model = 0;
                    $dashboard_datasets_bidang_rekomendasi = NULL;
                    $dashboard_datasets_bidang_rekomendasi_waktu = NULL;
                }
                if($sbr_o->skripsi_bidang_rekomendasi != NULL){
                    $use_model = 1;
                    $dashboard_datasets_bidang_rekomendasi = $chart_data->getChartBidangXRekomendasi(collect(Dataset::query()->get()));
                    $dashboard_datasets_bidang_rekomendasi_waktu = $chart_data->getChartBidangXRekomendasiWaktu(collect(Dataset::query()->get()));
                }
                if($sbr_l->skripsi_bidang_rekomendasi == NULL AND $sbr_o->skripsi_bidang_rekomendasi != NULL){
                    $use_model = 2;
                    $dashboard_datasets_bidang_rekomendasi = NULL;
                    $dashboard_datasets_bidang_rekomendasi_waktu = NULL;
                }
            }
        }

        $tree = DecisionTree::latest()->first();
        if($tree){
            $tree_accuracy = number_format($tree->tree_accuracy*100, 2);
        }else{
            $tree_accuracy = NULL;
        }

        $total = Dataset::count();
        $statistics = collect([
            'dataset' => $total,
            'training' => Training::count(),
            'testing' => Testing::count()
        ]);

        return view('pages.dashboard.index', compact(['datasets', 'filters', 'total', 'tree_accuracy', 'statistics', 'use_model', 'dashboard_datasets_bidang_rekomendasi', 'dashboard_datasets_bidang_rekomendasi_waktu']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
