<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Testing;
use App\DecisionTree;
use App\Configuration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class DataTestingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    
    private $mk_list = array('mk_PGI', 'mk_SIGD1', 'mk_SIGD2', 
    'mk_SIGL', 'mk_SPK', 'mk_ABD', 'mk_BDT', 'mk_DBD', 'mk_DM', 'mk_DW', 'mk_KB', 'mk_PBD', 
    'mk_ADSI', 'mk_DPSI', 'mk_IPSI', 'mk_PABW', 'mk_PBPU', 'mk_PPP', 'mk_SE', 'mk_PL', 
    'mk_DDAP', 'mk_DIAP', 'mk_EPAP', 'mk_EASI', 'mk_MO', 'mk_MITI', 'mk_MLTI', 'mk_MP', 
    'mk_MPSI', 'mk_MRS', 'mk_MR', 'mk_PPB', 'mk_PSSI', 'mk_TKTI', 'mk_EA', 'mk_SBF', 'mk_MHP');

    private $mk_list_var = array('$testing->mk_PGI', '$testing->mk_SIGD1', '$testing->mk_SIGD2', 
    '$testing->mk_SIGL', '$testing->mk_SPK', '$testing->mk_ABD', '$testing->mk_BDT', '$testing->mk_DBD', '$testing->mk_DM', '$testing->mk_DW', '$testing->mk_KB', '$testing->mk_PBD', 
    '$testing->mk_ADSI', '$testing->mk_DPSI', '$testing->mk_IPSI', '$testing->mk_PABW', '$testing->mk_PBPU', '$testing->mk_PPP', '$testing->mk_SE', '$testing->mk_PL', 
    '$testing->mk_DDAP', '$testing->mk_DIAP', '$testing->mk_EPAP', '$testing->mk_EASI', '$testing->mk_MO', '$testing->mk_MITI', '$testing->mk_MLTI', '$testing->mk_MP', 
    '$testing->mk_MPSI', '$testing->mk_MRS', '$testing->mk_MR', '$testing->mk_PPB', '$testing->mk_PSSI', '$testing->mk_TKTI', '$testing->mk_EA', '$testing->mk_SBF', '$testing->mk_MHP');

    public function getMKList()
    {
        return $this->mk_list;
    }

    public function getMKListVar()
    {
        return $this->mk_list_var;
    }

    public function index()
    {
        $testings = Testing::query()->paginate(15);
        $chart_data = new ChartData;

        if($testings->isEmpty()){
            $testings = NULL;
            $testing_testings_rekomendasi = NULL;
            $testing_testings_bidang_rekomendasi = NULL;
        }else{
            $sbr_l = Testing::latest()->first();
            if($sbr_l->skripsi_bidang_rekomendasi == NULL){
                $testing_testings_rekomendasi = NULL;
                $testing_testings_bidang_rekomendasi = NULL;
            }else{
                $testing_testings_rekomendasi = $chart_data->getChartRekomendasi(collect(Testing::query()->get()));
                $testing_testings_bidang_rekomendasi = $chart_data->getChartBidangXRekomendasi(collect(Testing::query()->get()));
            }
        }

        $total = Testing::count();

        $statistics = collect([
            'testing' => $total,
            'rekomendasi_sama' => Testing::whereRaw('skripsi_bidang = skripsi_bidang_rekomendasi')->count(),
            'rekomendasi_tidak_sama' => Testing::whereRaw('skripsi_bidang != skripsi_bidang_rekomendasi')->count(),
        ]);
        return view('pages.testing.index', compact(['testings', 'total', 'statistics', 'testing_testings_rekomendasi', 'testing_testings_bidang_rekomendasi']));
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

    private function getTestingDate(){
        $f = Testing::first();
        $date = strtotime($f->created_at);
	    $newdate = date('d-m-Y-H-i',$date);
        return $newdate;

    }

    public function createTestingDir()
    {
        Storage::makeDirectory('csv/test');
    }

    private function createCSVTestingData()
    {
        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
        ,   'Content-type'        => 'text/csv'
        ,   'Content-Disposition' => 'attachment; filename=test.csv'
        ,   'Expires'             => '0'
        ,   'Pragma'              => 'public'
        ];
        $filename = $this->getTestingDate();
        $list = Testing::select('mk_PGI', 'mk_SIGD1', 'mk_SIGD2', 
            'mk_SIGL', 'mk_SPK', 'mk_ABD', 'mk_BDT', 'mk_DBD', 'mk_DM', 'mk_DW', 'mk_KB', 'mk_PBD', 
            'mk_ADSI', 'mk_DPSI', 'mk_IPSI', 'mk_PABW', 'mk_PBPU', 'mk_PPP', 'mk_SE', 'mk_PL', 
            'mk_DDAP', 'mk_DIAP', 'mk_EPAP', 'mk_EASI', 'mk_MO', 'mk_MITI', 'mk_MLTI', 'mk_MP', 
            'mk_MPSI', 'mk_MRS', 'mk_MR', 'mk_PPB', 'mk_PSSI', 'mk_TKTI', 'mk_EA', 'mk_SBF', 'mk_MHP',
            'skripsi_bidang_rekomendasi')->get()->toArray();

        $columns = array('mk_PGI', 'mk_SIGD1', 'mk_SIGD2', 
        'mk_SIGL', 'mk_SPK', 'mk_ABD', 'mk_BDT', 'mk_DBD', 'mk_DM', 'mk_DW', 'mk_KB', 'mk_PBD', 
        'mk_ADSI', 'mk_DPSI', 'mk_IPSI', 'mk_PABW', 'mk_PBPU', 'mk_PPP', 'mk_SE', 'mk_PL', 
        'mk_DDAP', 'mk_DIAP', 'mk_EPAP', 'mk_EASI', 'mk_MO', 'mk_MITI', 'mk_MLTI', 'mk_MP', 
        'mk_MPSI', 'mk_MRS', 'mk_MR', 'mk_PPB', 'mk_PSSI', 'mk_TKTI', 'mk_EA', 'mk_SBF', 'mk_MHP', 
        'class');
        $this->createTestingDir();
        $file = fopen('../storage/app/csv/test/test-'.$filename.'.csv', 'w');
        fputcsv($file, $columns);

        foreach($list as $row) {
            // if($row == 'skripsi_bidang'){
            //     $row = 'actual';
            // }
            if($row == 'skripsi_bidang_rekomendasi'){
                $row = 'class';
            }
            fputcsv($file, $row);
        }
        fclose($file);

        return $filename;
    }

    private function getFP($matrix, $matrix_pointer, $class){
        $fp = 0;
        foreach($matrix as $key => $value){
            $fp = $fp + $matrix[$key][$matrix_pointer[$class]];
        }
        $fp = $fp - $matrix[$class][$matrix_pointer[$class]];
        return $fp;

    }
    public function getConfusionMatrix()
    {
        $testing = Testing::get();
        $matrix_pointer = ["Tata Kelola & Manajemen Sistem Informasi" => 0, "Pengembangan Sistem Informasi" => 1,  "Manajemen Data & Informasi" => 2, "Sistem Informasi Geografis" => 3];
        $matrix = [
            "Tata Kelola & Manajemen Sistem Informasi" => [0,0,0,0],
            "Pengembangan Sistem Informasi" => [0,0,0,0],
            "Manajemen Data & Informasi" => [0,0,0,0],
            "Sistem Informasi Geografis" => [0,0,0,0],
        ];
        $fp_matrix = [
            "Tata Kelola & Manajemen Sistem Informasi" => 0,
            "Pengembangan Sistem Informasi" => 0,
            "Manajemen Data & Informasi" => 0,
            "Sistem Informasi Geografis" => 0,
        ];
        $fn_matrix = [
            "Tata Kelola & Manajemen Sistem Informasi" => 0,
            "Pengembangan Sistem Informasi" => 0,
            "Manajemen Data & Informasi" => 0,
            "Sistem Informasi Geografis" => 0,
        ];
        $tp = 0;
        $pcxac = 0;
        $accuracy = 0;
        foreach($testing as $testdata){
            if($testdata->skripsi_bidang == $testdata->skripsi_bidang_rekomendasi){
                $matrix[$testdata->skripsi_bidang][$matrix_pointer[$testdata->skripsi_bidang]]++;
            }else{
                $matrix[$testdata->skripsi_bidang][$matrix_pointer[$testdata->skripsi_bidang_rekomendasi]]++;
            }
        }

        // Accuracy
        foreach($matrix as $key => $value){
            $tp = $tp + $matrix[$key][$matrix_pointer[$key]];
            $pcxac = $pcxac + array_sum($matrix[$key]);
        }
        $accuracy = number_format($tp / $pcxac, 6);
        

        // Precision
        foreach($matrix as $key => $value){
            $fp_matrix[$key] = $this->getFP($matrix, $matrix_pointer, $key);
        }
        foreach($matrix as $key => $value){
            $fp_matrix[$key] = number_format($tp / ($tp+$fp_matrix[$key]), 6);
        }

        // Recall
        foreach($matrix as $key => $value){
            $fn_matrix[$key] = $fn_matrix[$key] + array_sum($matrix[$key]) - $matrix[$key][$matrix_pointer[$key]];
        }
        foreach($matrix as $key => $value){
            $fn_matrix[$key] = number_format($tp / ($tp+$fn_matrix[$key]), 6);
        }
        
        $tree = DecisionTree::latest()->first();
        $tree->tree_accuracy = $accuracy;
        $tree->tree_precision = serialize($fp_matrix);
        $tree->tree_recall = serialize($fn_matrix);
        $tree->save();
    }

    public function testData(){
        $config = Configuration::latest()->first();
        $dir_separator = '';
        $dir_base_path = base_path().'/';
        $dir_base_path = str_replace('\\', '/', $dir_base_path);
        $dir_weka_class_path = $dir_base_path.'dependency/weka.jar';
        // $dir_base_path = $config->base_path;
        // $dir_weka_class_path = $config->weka_path;
        $dir_data_test_file = $dir_base_path.'storage/app/csv/test/';
        $dir_model = $dir_base_path.'storage/app/model/';
        if($config->OS == 'WINDOWS 10'){
            $dir_separator = '"';
        }

        // CREATE DATA AND RETURN FILENAME //
        $filename = $this->createCSVTestingData();

        // CONFIG //
        // Weka path on system
        $weka_class_path = $dir_separator.$dir_weka_class_path.$dir_separator.' ';

        // Legal values options for MK and Bidang Skripsi
        $legal_mk = '-L 1-37:A,B,C,D,E';
        $legal_class = '-L 38:"Manajemen Data & Informasi","Pengembangan Sistem Informasi","Sistem Informasi Geografis","Tata Kelola & Manajemen Sistem Informasi"';

        // Datasets on web app (system dir)
        $data = $dir_separator.$dir_data_test_file.'test-'.$filename.'.csv'.$dir_separator;

        // Converted .arff datasets in web app (system dir)
        $data_arff = $dir_separator.$dir_data_test_file.'test-'.$filename.'.arff'.$dir_separator;

        // Model name is $filename -- Save model to
        $model = $dir_separator.$dir_model.$filename.'-jp48.model'.$dir_separator;

        // WEKA CLI Configuration
        $java_cmd = "java -cp ";
        $classifiers="weka.classifiers.trees.J48 -T ";
        
        $convert_csv_to_arff = $java_cmd.$weka_class_path.$dir_separator.'weka.core.converters.CSVLoader'.$dir_separator.' '.$data.' > '.$data_arff.' '.$legal_mk.' '.$legal_class;
        // java -cp /path/to/weka.jar weka.core.converters.CSVLoader filename.csv > filename.arff

        // CONVERT CSV TO ARFF FOR TRAINING FILE //
        exec($convert_csv_to_arff);
        
        // Set Up Command line instruction //
        $testing_cmd= $java_cmd.$weka_class_path.$classifiers.$data_arff.' -l '.$model.' -p 0';
        // $tree_data_cmd= $java_cmd.$weka_class_path.$classifiers.$classifiers_options.$data_arff.' -c 38 -d '.$model;
        
        exec($testing_cmd, $testing_output);

        $dataset = Testing::get();
        $table = 'testings';
        $decision_tree = new DecisionTreeController;
        $decision_tree->useModel($dataset, $table, NULL);

        
        $this->getConfusionMatrix();

        return redirect('admin/testing');
    }

    
}