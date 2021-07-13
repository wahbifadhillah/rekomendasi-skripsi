<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dataset;
use App\DecisionTree;
use App\Training;
use App\Testing;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DatasetsImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatasetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('role:kaprodi');
    }
    
    private function getAngkatan($NIM){
        $angkatan = substr($NIM, 0, 2);

        return '20'.$angkatan;
    }

    private function getFilters($model, $table, $deleted){
        $cols = Schema::getColumnListing($table);
        $filters = array();
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
            }else{
                $filters[$col] = collect($model::select($col)->groupBy($col)->get());
            }

        }
        $filters = collect($filters);
        foreach($deleted as $del){
            $filters->forget($del);
        }
        return $filters;
    }

    public function index(Request $request)
    {
        // Filter attr
        $filters = $this->getFilters(Dataset::class, 'datasets', ['id', 'skripsi_judul', 'skripsi_tahun', 'skripsi_bidang', 'skripsi_bidang_rekomendasi', 'skripsi_tanggal_proposal', 'skripsi_tanggal_semhas',
        'mk_PGI', 'mk_SIGD1', 'mk_SIGD2', 'mk_SIGL', 'mk_SPK',
        'mk_ABD', 'mk_BDT', 'mk_DBD', 'mk_DM', 'mk_DW',
        'mk_KB', 'mk_PBD', 'mk_ADSI', 'mk_DPSI', 'mk_IPSI',
        'mk_PABW', 'mk_PBPU', 'mk_PPP', 'mk_SE', 'mk_PL',
        'mk_DDAP', 'mk_DIAP', 'mk_EPAP', 'mk_EASI', 'mk_MO',
        'mk_MITI', 'mk_MLTI', 'mk_MP', 'mk_MPSI', 'mk_MRS',
        'mk_MR', 'mk_PPB', 'mk_PSSI', 'mk_TKTI', 'mk_EA',
        'mk_SBF', 'mk_MHP', 'created_at', 'updated_at']);

        $use_model = 0;

        // Filter query
        if ($request->has('filter')) {
            $filter = Dataset::query();
            if($request->filled('angkatan')) {
                if($request->angkatan != 'semua_angkatan'){
                    $angkatan = substr($request->angkatan, 2, 4).'%';
                    $filter->where('NIM', 'LIKE', $angkatan);
                }
            }
            if($request->filled('status_skripsi')) {
                if($request->status_skripsi != 'semua_status_skripsi'){
                    if($request->status_skripsi == 'tepat_waktu'){
                        $filter->havingRaw('DATEDIFF(skripsi_tanggal_semhas, skripsi_tanggal_proposal) <= 180');
                    }
                    if($request->status_skripsi == 'tidak_tepat_waktu'){
                        $filter->havingRaw('DATEDIFF(skripsi_tanggal_semhas, skripsi_tanggal_proposal) > 180');
                    }
                }
            }
            $datasets = $filter->latest()->paginate(15);
            if($datasets->isEmpty()){
                $datasets = NULL;
            }else{
                $sbr_l = Dataset::latest()->first();
                $sbr_o = Dataset::oldest()->first();
                if($sbr_l->skripsi_bidang_rekomendasi == NULL){
                    $use_model = 0;
                }
                if($sbr_o->skripsi_bidang_rekomendasi != NULL){
                    $use_model = 1;
                }
                if($sbr_l->skripsi_bidang_rekomendasi == NULL AND $sbr_o->skripsi_bidang_rekomendasi != NULL){
                    $use_model = 2;
                }
            }
        }else{
            $datasets = Dataset::query()->latest()->paginate(15);
            if($datasets->isEmpty()){
                $datasets = NULL;
            }else{
                $sbr_l = Dataset::latest()->first();
                $sbr_o = Dataset::oldest()->first();
                if($sbr_l->skripsi_bidang_rekomendasi == NULL){
                    $use_model = 0;
                }
                if($sbr_o->skripsi_bidang_rekomendasi != NULL){
                    $use_model = 1;
                }
                if($sbr_l->skripsi_bidang_rekomendasi == NULL AND $sbr_o->skripsi_bidang_rekomendasi != NULL){
                    $use_model = 2;
                }
            }
        }
        $tree = collect(DecisionTree::latest()->first())->isEmpty() ? TRUE:FALSE;
        $split = collect(Training::get())->isEmpty() ? TRUE:FALSE;
        $total = Dataset::count();

        return view('pages.dataset.index', compact(['datasets', 'filters', 'tree', 'split', 'use_model', 'total']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if(session()->get('info')){
        //     $info = TRUE;
        // }else{
        //     $info = FALSE;
        // }
        // return redirect()->route('admin.dataset.index');
        return view('pages.dataset.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'csv_dataset' => 'required|mimes:csv',
        ],
        [
            'csv_dataset.required' => 'Anda harus memilih file dengan format .csv.',
            'csv_dataset.mimes' => 'File yang anda pilih harus file dengan format .csv.',
        ]);

        $import = new DatasetsImport;
        $xl = $import->toCollection($request->file('csv_dataset'));
        // dd($xl[0]->first());
        if($xl[0]->first()->count() != 44){
            return redirect()->back()->with('file_error', "Jumlah kolom tidak sesuai: Kolom = ".$xl[0]->first()->count().", diijinkan = 44");
        }
        Excel::import($import, $request->file('csv_dataset')->store('temp'));
        $msg = "Dataset telah di pre-process dan ".$import->getRowCount()." data baru berhasil ditambahkan.";
        if($import->getRowCount() == 0){
            $msg = "Terdapat ".$import->failures()->count()." duplikasi data pada file .csv, tidak ada data yang ditambahkan.";
            return redirect()->route('admin.dataset.index')->with('warning', $msg);
        }elseif($import->failures()->count() > 0 && $import->getRowCount() > 0){
            $msg = "Terdapat ".$import->failures()->count()." duplikasi data pada file .csv, ".$import->getRowCount()." data baru telah di pre-process dan berhasil ditambahkan.";
        }
        // dd('Row count: ' . $import->getRowCount()); 
        // $info = TRUE;
        return redirect()->route('admin.dataset.index')->with('file_success', $msg);
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

    public function splitData(){
        $trainings = Dataset::havingRaw('DATEDIFF(skripsi_tanggal_semhas, skripsi_tanggal_proposal) <= 180')->get();
        $testings = Dataset::havingRaw('DATEDIFF(skripsi_tanggal_semhas, skripsi_tanggal_proposal) > 180')->get();
        DB::table('trainings')->truncate();
        foreach($trainings as $row => $key){
            $training = Training::create([
                'skripsi_bidang' => $trainings[$row]['skripsi_bidang'],
                'skripsi_tanggal_proposal' => $trainings[$row]['skripsi_tanggal_proposal'],
                'skripsi_tanggal_semhas' => $trainings[$row]['skripsi_tanggal_semhas'],
                'mk_PGI' => $trainings[$row]['mk_PGI'],
                'mk_SIGD1' => $trainings[$row]['mk_SIGD1'],
                'mk_SIGD2' => $trainings[$row]['mk_SIGD2'],
                'mk_SIGL' => $trainings[$row]['mk_SIGL'],
                'mk_SPK' => $trainings[$row]['mk_SPK'],
                'mk_ABD' => $trainings[$row]['mk_ABD'],
                'mk_BDT' => $trainings[$row]['mk_BDT'],
                'mk_DBD' => $trainings[$row]['mk_DBD'],
                'mk_DM' => $trainings[$row]['mk_DM'],
                'mk_DW' => $trainings[$row]['mk_DW'],
                'mk_KB' => $trainings[$row]['mk_KB'],
                'mk_PBD' => $trainings[$row]['mk_PBD'],
                'mk_ADSI' => $trainings[$row]['mk_ADSI'],
                'mk_DPSI' => $trainings[$row]['mk_DPSI'],
                'mk_IPSI' => $trainings[$row]['mk_IPSI'],
                'mk_PABW' => $trainings[$row]['mk_PABW'],
                'mk_PBPU' => $trainings[$row]['mk_PBPU'],
                'mk_PPP' => $trainings[$row]['mk_PPP'],
                'mk_SE' => $trainings[$row]['mk_SE'],
                'mk_PL' => $trainings[$row]['mk_PL'],
                'mk_DDAP' => $trainings[$row]['mk_DDAP'],
                'mk_DIAP' => $trainings[$row]['mk_DIAP'],
                'mk_EPAP' => $trainings[$row]['mk_EPAP'],
                'mk_EASI' => $trainings[$row]['mk_EASI'],
                'mk_MO' => $trainings[$row]['mk_MO'],
                'mk_MITI' => $trainings[$row]['mk_MITI'],
                'mk_MLTI' => $trainings[$row]['mk_MLTI'],
                'mk_MP' => $trainings[$row]['mk_MP'],
                'mk_MPSI' => $trainings[$row]['mk_MPSI'],
                'mk_MRS' => $trainings[$row]['mk_MRS'],
                'mk_MR' => $trainings[$row]['mk_MR'],
                'mk_PPB' => $trainings[$row]['mk_PPB'],
                'mk_PSSI' => $trainings[$row]['mk_PSSI'],
                'mk_TKTI' => $trainings[$row]['mk_TKTI'],
                'mk_EA' => $trainings[$row]['mk_EA'],
                'mk_SBF' => $trainings[$row]['mk_SBF'],
                'mk_MHP' => $trainings[$row]['mk_MHP'],
            ]);
        }

        DB::table('testings')->truncate();
        foreach($testings as $row => $key){
            $testing = Testing::create([
                'skripsi_bidang' => $testings[$row]['skripsi_bidang'],
                'skripsi_bidang_rekomendasi' => NULL,
                'mk_PGI' => $testings[$row]['mk_PGI'],
                'mk_SIGD1' => $testings[$row]['mk_SIGD1'],
                'mk_SIGD2' => $testings[$row]['mk_SIGD2'],
                'mk_SIGL' => $testings[$row]['mk_SIGL'],
                'mk_SPK' => $testings[$row]['mk_SPK'],
                'mk_ABD' => $testings[$row]['mk_ABD'],
                'mk_BDT' => $testings[$row]['mk_BDT'],
                'mk_DBD' => $testings[$row]['mk_DBD'],
                'mk_DM' => $testings[$row]['mk_DM'],
                'mk_DW' => $testings[$row]['mk_DW'],
                'mk_KB' => $testings[$row]['mk_KB'],
                'mk_PBD' => $testings[$row]['mk_PBD'],
                'mk_ADSI' => $testings[$row]['mk_ADSI'],
                'mk_DPSI' => $testings[$row]['mk_DPSI'],
                'mk_IPSI' => $testings[$row]['mk_IPSI'],
                'mk_PABW' => $testings[$row]['mk_PABW'],
                'mk_PBPU' => $testings[$row]['mk_PBPU'],
                'mk_PPP' => $testings[$row]['mk_PPP'],
                'mk_SE' => $testings[$row]['mk_SE'],
                'mk_PL' => $testings[$row]['mk_PL'],
                'mk_DDAP' => $testings[$row]['mk_DDAP'],
                'mk_DIAP' => $testings[$row]['mk_DIAP'],
                'mk_EPAP' => $testings[$row]['mk_EPAP'],
                'mk_EASI' => $testings[$row]['mk_EASI'],
                'mk_MO' => $testings[$row]['mk_MO'],
                'mk_MITI' => $testings[$row]['mk_MITI'],
                'mk_MLTI' => $testings[$row]['mk_MLTI'],
                'mk_MP' => $testings[$row]['mk_MP'],
                'mk_MPSI' => $testings[$row]['mk_MPSI'],
                'mk_MRS' => $testings[$row]['mk_MRS'],
                'mk_MR' => $testings[$row]['mk_MR'],
                'mk_PPB' => $testings[$row]['mk_PPB'],
                'mk_PSSI' => $testings[$row]['mk_PSSI'],
                'mk_TKTI' => $testings[$row]['mk_TKTI'],
                'mk_EA' => $testings[$row]['mk_EA'],
                'mk_SBF' => $testings[$row]['mk_SBF'],
                'mk_MHP' => $testings[$row]['mk_MHP']
            ]);
        }

        return redirect('admin/training')->with('success', "Dataset telah dibagi menjadi data latih dan data uji.");
    }

    public function applyModel(){
        $dataset = Dataset::get();
        $table = 'datasets';
        $decision_tree = new DecisionTreeController;
        $decision_tree->useModel($dataset, $table, NULL);

        return redirect('admin/dataset')->with('success',"Rekomendasi (Model pohon keputusan) telah diaplikasikan ke dataset, <a href='".route('admin.dashboard.index')."'>klik disini</a> untuk melihat visualisasi data.");
    }
}