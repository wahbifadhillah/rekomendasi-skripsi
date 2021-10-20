<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Training;
use App\DecisionTree;
use App\Node;
use App\Configuration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class DataTrainingController extends Controller
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
    
    private $mk_list = array('mk_PGI', 'mk_SIGD1', 'mk_SIGD2', 
    'mk_SIGL', 'mk_SPK', 'mk_ABD', 'mk_BDT', 'mk_DBD', 'mk_DM', 'mk_DW', 'mk_KB', 'mk_PBD', 
    'mk_ADSI', 'mk_DPSI', 'mk_IPSI', 'mk_PABW', 'mk_PBPU', 'mk_PPP', 'mk_SE', 'mk_PL', 
    'mk_DDAP', 'mk_DIAP', 'mk_EPAP', 'mk_EASI', 'mk_MO', 'mk_MITI', 'mk_MLTI', 'mk_MP', 
    'mk_MPSI', 'mk_MRS', 'mk_MR', 'mk_PPB', 'mk_PSSI', 'mk_TKTI', 'mk_EA', 'mk_SBF', 'mk_MHP');

    private $bidang = array('Tata Kelola & Manajemen Sistem Informasi' => 'TKMSI', 
    'Pengembangan Sistem Informasi' => 'PSI', 
    'Manajemen Data & Informasi' => 'MDI', 
    'Sistem Informasi Geografis' => 'SIG');

    private $parent_node_list = array();

    public function getMKList()
    {
        return $this->mk_list;
    }

    public function getBidangList()
    {
        return $this->bidang;
    }

    public function setParentNodeList($parent_node_list)
    {
        $this->parent_node_list = $parent_node_list;
    }

    public function getParentNodeList()
    {
        return $this->parent_node_list;
    }

    public function index()
    {
        $trainings = Training::query()->paginate(15);
        $config = Configuration::latest()->first();
        $chart_data = new ChartData;
        if($trainings->isEmpty()){
            $trainings = NULL;
        }
        $total = Training::count();

        $training_trainings_bidang = $chart_data->getChartBidang(collect(Training::query()->get()));
        $training_trainings_bidang_waktu = $chart_data->getChartBidangXWaktu(collect(Training::query()->get()));

        $statistics = collect([
            'training' => $total,
            // 'tepat_waktu' => $total > 0 ? Training::havingRaw('DATEDIFF(skripsi_tanggal_semhas, skripsi_tanggal_proposal) <= 180')->count():0,
            // 'tidak_tepat_waktu' => $total > 0 ? Training::havingRaw('DATEDIFF(skripsi_tanggal_semhas, skripsi_tanggal_proposal) > 180')->count():0,
            'bidang_MDI' => Training::where('skripsi_bidang', 'Manajemen Data & Informasi')->count(),
            'bidang_PSI' => Training::where('skripsi_bidang', 'Pengembangan Sistem Informasi')->count(),
            'bidang_SIG' => Training::where('skripsi_bidang', 'Sistem Informasi Geografis')->count(),
            'bidang_TKTI' => Training::where('skripsi_bidang', 'Tata Kelola & Manajemen Sistem Informasi')->count()
        ]);
        return view('pages.training.index', compact(['trainings', 'total', 'statistics', 'training_trainings_bidang', 'training_trainings_bidang_waktu', 'config']));
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

    private function getTrainingDate(){
        $f = Training::first();
        $date = strtotime($f->created_at);
	    $newdate = date('d-m-Y-H-i',$date);
        return $newdate;

    }

    public function createTrainingDir()
    {
        Storage::makeDirectory('csv/train');
        Storage::makeDirectory('model');
    }

    public function createCSVTrainingData()
    {
        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
        ,   'Content-type'        => 'text/csv'
        ,   'Content-Disposition' => 'attachment; filename=train.csv'
        ,   'Expires'             => '0'
        ,   'Pragma'              => 'public'
        ];
        $filename = $this->getTrainingDate();
        $list = Training::select('mk_PGI', 'mk_SIGD1', 'mk_SIGD2', 
            'mk_SIGL', 'mk_SPK', 'mk_ABD', 'mk_BDT', 'mk_DBD', 'mk_DM', 'mk_DW', 'mk_KB', 'mk_PBD', 
            'mk_ADSI', 'mk_DPSI', 'mk_IPSI', 'mk_PABW', 'mk_PBPU', 'mk_PPP', 'mk_SE', 'mk_PL', 
            'mk_DDAP', 'mk_DIAP', 'mk_EPAP', 'mk_EASI', 'mk_MO', 'mk_MITI', 'mk_MLTI', 'mk_MP', 
            'mk_MPSI', 'mk_MRS', 'mk_MR', 'mk_PPB', 'mk_PSSI', 'mk_TKTI', 'mk_EA', 'mk_SBF', 'mk_MHP', 
            'skripsi_bidang')->get()->toArray();
        // dd($list[0]['mk_PBD']);
        foreach($list as $data => $value){
            foreach($list[$data] as $mk => $grade){
                if($list[$data][$mk] == 'N'){
                    $list[$data][$mk] = '?';
                }
            }
            
        }
        // dd($list);

        $columns = array('mk_PGI', 'mk_SIGD1', 'mk_SIGD2', 
        'mk_SIGL', 'mk_SPK', 'mk_ABD', 'mk_BDT', 'mk_DBD', 'mk_DM', 'mk_DW', 'mk_KB', 'mk_PBD', 
        'mk_ADSI', 'mk_DPSI', 'mk_IPSI', 'mk_PABW', 'mk_PBPU', 'mk_PPP', 'mk_SE', 'mk_PL', 
        'mk_DDAP', 'mk_DIAP', 'mk_EPAP', 'mk_EASI', 'mk_MO', 'mk_MITI', 'mk_MLTI', 'mk_MP', 
        'mk_MPSI', 'mk_MRS', 'mk_MR', 'mk_PPB', 'mk_PSSI', 'mk_TKTI', 'mk_EA', 'mk_SBF', 'mk_MHP', 
        'class');
        $this->createTrainingDir();
        $file = fopen('../storage/app/csv/train/train-'.$filename.'.csv', 'w');
        fputcsv($file, $columns);

        foreach($list as $row) {
            if($row == 'skripsi_bidang'){
                $row = 'class';
            }
            fputcsv($file, $row);
        }
        fclose($file);

        return $filename;
    }

    public function getNodeArray($tree_output)
    {
        // SLICING RULE //

        // MK LIST ARRAY
        $mk_list = $this->getMKList();

        // BIDANG ABBV.
        $bidang = $this->getBidangList();

        $i = 0;
        $keys = array();
        $node_db_id = array();
        $node_db_parent_id = array();
        $node_name_slicer = array();
        $node_label_slicer = array();
        $node_purity_slicer = array();
        $parent_node = array();
        $last_branch_value = NULL;
        
        // EXTRACT RULE TO EACH ARRAY
        foreach($tree_output as $rule){
            $node_name = Str::before($rule, ' [label=');
            $node_label = Str::between($rule, '[label="', '"');
            $node_purity = Str::between($rule, '(', ')');

            if(Str::contains($node_name, '{') || Str::contains($node_name, '}')){
                $node_name = "";
            }else{
                if(Str::contains($node_name, '->')){
                    $last_branch_value = $node_name;
                }
            }

            if(Str::contains($node_label, '{') || Str::contains($node_label, '}')){
                $node_label = "";
            }else{
                $node_label = Str::before($node_label, ' (');
            }

            if(Str::contains($node_purity, '{') || Str::contains($node_purity, '}')){
                $node_purity = "";
            }else if(!Str::contains($node_purity, '.')){
                $node_purity = "";
            }else{
                $node_purity = "(".$node_purity.")";
            }
            
            // GET PARENT NODE
            if(in_array($node_label, $mk_list)){
                if(Str::contains($last_branch_value, '->')){
                    $node_parent_name = Str::before($last_branch_value, '->');
                    array_push($parent_node, $node_parent_name);
                    $last_branch_value = NULL;
                }else{
                    array_push($parent_node, $node_name);
                }
            }else{
                array_push($parent_node, "");
            }
            array_push($node_db_id, "");
            array_push($node_db_parent_id, "");
            array_push($node_name_slicer, $node_name);
            array_push($node_label_slicer, $node_label);
            array_push($node_purity_slicer, $node_purity);
        }

        // CREATE ARRAY KEYS
        foreach($node_name_slicer as $key){
            array_push($keys, $i);
            $i++;
        }

        // COMBINE ARRAY TO CREATE ARRAY RULES
        $combined = array_combine($keys, array_map(function ($node_db_id, $node_db_parent_id, $parent_node, $node_name_slicer, $node_label_slicer, $node_purity_slicer) {
            return compact('node_db_id', 'node_db_parent_id', 'parent_node', 'node_name_slicer', 'node_label_slicer', 'node_purity_slicer');
        }, $node_db_id, $node_db_parent_id, $parent_node, $node_name_slicer, $node_label_slicer, $node_purity_slicer));

        // REMOVE BLANK RULES
        array_shift($combined);
        array_pop($combined);
        array_pop($combined);

        // GET UNIQUE PARENT NODE
        $parent_node_value = array();
        $parent_node_attribute = array();

        foreach($combined as $row => $key) {
            if($combined[$row]['parent_node'] != ""){
                array_push($parent_node_value, $combined[$row]['node_name_slicer']);
                array_push($parent_node_attribute, $combined[$row]['node_label_slicer']);
            }
        }

        $parent_node_list = array_combine($parent_node_value, $parent_node_attribute);
        $this->setParentNodeList($parent_node_list);

        // $unique_parent_node = array_unique($parent_node_value);
        
        // SETTING UP PARENT NODE
        $last_value=NULL;

        foreach($combined as $row => $key) {
            if(Str::contains($combined[$row]['node_name_slicer'], '->')){
                $p = Str::before($combined[$row]['node_name_slicer'], '->');
                $combined[$row]['parent_node'] = $p;
                $last_value = $p;
            }
            elseif ($key['parent_node']!="") {
            }else{
                $combined[$row]['parent_node'] = $last_value;
            }
        }
        
        // SETTING UP NODE DB DATA
        $date_id = $this->getTrainingDate();
        $n_last_parent = NULL;
        $parent_list = array();
        foreach($combined as $row => $key) {
            $n_parent = $combined[$row]['parent_node'];
            $n_name = $combined[$row]['node_name_slicer'];
            $n_label = $combined[$row]['node_label_slicer'];
            $branch_checker = Str::contains($n_name, '->');

            if(in_array($n_label, $mk_list)){
                $parent_list[$n_name]= $date_id.$n_parent."A".$n_name;
                $combined[$row]['node_db_id'] = $date_id.$n_parent."A".$n_name;
                $combined[$row]['node_db_parent_id'] = $parent_list[$n_parent];
            }elseif($combined[$row]['node_purity_slicer'] != ""){
                $combined[$row]['node_db_id'] = $date_id.$n_parent."C".$n_name;
                $combined[$row]['node_db_parent_id'] = $parent_list[$n_parent];
            }elseif($branch_checker){
                $n_id = Str::replaceFirst('->', 'B', $n_name);
                $combined[$row]['node_db_id'] = $date_id.$n_id;
                $combined[$row]['node_db_parent_id'] = $parent_list[$n_parent];
            }
        }
        return $combined;
    }

    public function getTreeRules($data)
    {
        // CONVERT TO PHP CONDITIONS

        // MK LIST ARRAY
        $mk_list = $this->getMKList();

        // BIDANG ABBV.
        $bidang = $this->getBidangList();

        $parent_node_list = $this->getParentNodeList();

        $rules = array();
        $encounter = 0;
        $counter = 0;
        $length = count($data);
        $last_attribute = NULL;
        foreach($data as $row => $key){
            $counter++;
            if(in_array($data[$row]['node_label_slicer'], $mk_list)){
                array_push($rules, "if(".$data[$row]['node_label_slicer']." ");
                $last_attribute = $data[$row]['node_label_slicer'];
                $encounter = 0;
            }

            if(Str::contains($data[$row]['node_name_slicer'], '->')){
                if($encounter==0){
                    $get_grade = Str::after($data[$row]['node_label_slicer'], "= ");
                    $grade = '== "'.$get_grade.'"';
                    array_push($rules, $grade.") {");
                    $encounter++;
                }
                elseif($encounter>0){
                    if($last_attribute != $parent_node_list[$data[$row]['parent_node']]){
                        $extra = "}";
                        $last_attribute = $parent_node_list[$data[$row]['parent_node']];
                    }else{
                        $extra = "";
                    }
                    $get_grade = Str::after($data[$row]['node_label_slicer'], "= ");
                    $grade = '== "'.$get_grade.'"';
                    array_push($rules, $extra."elseif(".$parent_node_list[$data[$row]['parent_node']]." ".$grade.") {");
                }
            }

            if($data[$row]['node_purity_slicer'] != ""){
                if($counter == $length){
                    $extra = "";
                }else{
                    $extra = "";
                }
                array_push($rules, 'return [VAR]="'.$data[$row]['node_label_slicer'].'";}'.$extra);
                // array_push($rules, 'return [VAR]="'.$bidang[$data[$row]['node_label_slicer']].'";}'.$extra);
            }
        }
        return $rules;
    }

    public function saveTree($tree_data_output, $tree_name, $data, $tree_graph)
    {
        $rules = $this->getTreeRules($data);
        $tree_leaves= 0;
        $tree_size= 0;
        $c_training = DB::table('trainings')->count();;
        $c_testing = DB::table('testings')->count();;
        
        foreach($tree_data_output as $row){
            if(Str::contains($row, "Number of Leaves  : \t")){
                $tree_leaves = Str::after($row, "\t");
            }
            if(Str::contains($row, "Size of the tree : \t")){
                $tree_size = Str::after($row, "\t");
            }
        }
        
        // $tree_graph = str_replace('"', "'", $tree_graph);

        // STORE TREE DATA
        $tree = new DecisionTree;
        $tree->node_id = NULL;
        $tree->tree_name = $tree_name;
        $tree->tree_training_data = $c_training;
        $tree->tree_testing_data = $c_testing;
        $tree->tree_accuracy = NULL;
        $tree->tree_size = $tree_size;
        $tree->tree_leaves = $tree_leaves;
        $tree->tree_graph = $tree_graph;
        $tree->tree_rules = implode($rules);
        $tree->save();
        $tree_id = DecisionTree::latest()->first();
        return $tree_id->tree_id;
    }

    public function updateTreeNodeID(){
        $latest_parent_node = Node::latest()->where('node_name', 'N0')->first();
        $tree = DecisionTree::latest()->first();
        $tree->node_id = $latest_parent_node->node_id;
        $tree->save();
    }

    public function saveTreeNodes($tree_id, $data)
    {
        $node = new Node;
        foreach($data as $row => $key) {
            $purity = NULL;
            if($data[$row]['node_purity_slicer'] != ''){
                $purity = $data[$row]['node_purity_slicer'];
            }
            $node = Node::create([
                'node_id' => $data[$row]['node_db_id'],
                'tree_id' => $tree_id,
                'node_parent' => $data[$row]['node_db_parent_id'],
                'node_name' => $data[$row]['node_name_slicer'],
                'node_value' => $data[$row]['node_label_slicer'],
                'node_leaf_purity' => $purity,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        $this->updateTreeNodeID();
    }

    public function trainData(){

        $config = Configuration::latest()->first();
        $dir_separator = '';
        $dir_base_path = base_path().'/';
        $dir_base_path = str_replace('\\', '/', $dir_base_path);
        $dir_weka_class_path = $dir_base_path.'dependency/weka.jar';
        $dir_data_train_file = $dir_base_path.'storage/app/csv/train/';
        $dir_model = $dir_base_path.'storage/app/model/';
        
        if($config->OS == 'WINDOWS 10'){
            $dir_separator = '"';
        }
        
        $filename = $this->createCSVTrainingData();

        // CONFIG //
        // Weka path on system
        $weka_class_path=$dir_separator.$dir_weka_class_path.$dir_separator.' ';

        // Legal values options for MK and Bidang Skripsi
        $legal_mk = '-L 1-37:SB,B,C,K,N';
        $legal_class = '-L 38:"Manajemen Data & Informasi","Pengembangan Sistem Informasi","Sistem Informasi Geografis","Tata Kelola & Manajemen Sistem Informasi"';

        // Datasets on web app (system dir)
        $data = $dir_separator.$dir_data_train_file.'train-'.$filename.'.csv'.$dir_separator;
        // $data='~/Websites/rekomendasi/storage/app/csv/train/train-'.$filename.'.csv';

        // Converted .arff datasets in web app (system dir)
        $data_arff = $dir_separator.$dir_data_train_file.'train-'.$filename.'.arff'.$dir_separator;
        // $data_arff = '~/Websites/rekomendasi/storage/app/csv/train/train-'.$filename.'.arff';

        // Model name is $filename -- Save model to
        $model = $dir_separator.$dir_model.$filename.'-jp48.model'.$dir_separator;
        // $model='~/Websites/rekomendasi/storage/app/model/'.$filename.'-jp48.model';

        // WEKA CLI Configuration
        $java_cmd = "java -cp ";
        $classifiers="weka.classifiers.trees.J48 ";
        $classifiers_options="-C 0.5 -M 2 -t ";
        
        $convert_csv_to_arff = $java_cmd.$weka_class_path.$dir_separator.'weka.core.converters.CSVLoader'.$dir_separator.' '.$data.' > '.$data_arff.' '.$legal_mk.' '.$legal_class;
        // java -cp /path/to/weka.jar weka.core.converters.CSVLoader filename.csv > filename.arff

        // CONVERT CSV TO ARFF FOR TRAINING FILE //
        exec($convert_csv_to_arff);

        $rules_cmd= $java_cmd.$weka_class_path.$classifiers.$classifiers_options.$data_arff.' -c 38 -d '.$model.' -g';
        $tree_data_cmd= $java_cmd.$weka_class_path.$classifiers.$classifiers_options.$data_arff.' -c 38 -d '.$model;
        
        exec($tree_data_cmd, $training_tree_data_output);
        exec($rules_cmd, $node_data_output);
        $tree_graph = implode($node_data_output);
        $node_data_output=collect($node_data_output);
        
        // GET NODE ARRAY RULES AND CONVERT TO COLLECTION //
        $data = $this->getNodeArray($node_data_output);

        // STORE TREE AND NODES DATA
        $nodes = $this->saveTreeNodes($this->saveTree($training_tree_data_output, $filename, $data, $tree_graph), $data);
        $testing = TRUE;
        return redirect('admin/testing/test');
        // return collect($nodes);
    }
}
