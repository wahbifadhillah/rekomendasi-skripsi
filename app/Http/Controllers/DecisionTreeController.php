<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DecisionTree;
use App\Testing;
use App\Dataset;
use App\Recommendation;

class DecisionTreeController extends Controller
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

    private $mk_list_var = array('$dataset->mk_PGI', '$dataset->mk_SIGD1', '$dataset->mk_SIGD2', 
    '$dataset->mk_SIGL', '$dataset->mk_SPK', '$dataset->mk_ABD', '$dataset->mk_BDT', '$dataset->mk_DBD', '$dataset->mk_DM', '$dataset->mk_DW', '$dataset->mk_KB', '$dataset->mk_PBD', 
    '$dataset->mk_ADSI', '$dataset->mk_DPSI', '$dataset->mk_IPSI', '$dataset->mk_PABW', '$dataset->mk_PBPU', '$dataset->mk_PPP', '$dataset->mk_SE', '$dataset->mk_PL', 
    '$dataset->mk_DDAP', '$dataset->mk_DIAP', '$dataset->mk_EPAP', '$dataset->mk_EASI', '$dataset->mk_MO', '$dataset->mk_MITI', '$dataset->mk_MLTI', '$dataset->mk_MP', 
    '$dataset->mk_MPSI', '$dataset->mk_MRS', '$dataset->mk_MR', '$dataset->mk_PPB', '$dataset->mk_PSSI', '$dataset->mk_TKTI', '$dataset->mk_EA', '$dataset->mk_SBF', '$dataset->mk_MHP');

    private $mk_list_col = array('$dataset["mk_PGI"]', '$dataset["mk_SIGD1"]', '$dataset["mk_SIGD2"]', 
    '$dataset["mk_SIGL"]', '$dataset["mk_SPK"]', '$dataset["mk_ABD"]', '$dataset["mk_BDT"]', '$dataset["mk_DBD"]', '$dataset["mk_DM"]', '$dataset["mk_DW"]', '$dataset["mk_KB"]', '$dataset["mk_PBD"]', 
    '$dataset["mk_ADSI"]', '$dataset["mk_DPSI"]', '$dataset["mk_IPSI"]', '$dataset["mk_PABW"]', '$dataset["mk_PBPU"]', '$dataset["mk_PPP"]', '$dataset["mk_SE"]', '$dataset["mk_PL"]', 
    '$dataset["mk_DDAP"]', '$dataset["mk_DIAP"]', '$dataset["mk_EPAP"]', '$dataset["mk_EASI"]', '$dataset["mk_MO"]', '$dataset["mk_MITI"]', '$dataset["mk_MLTI"]', '$dataset["mk_MP"]', 
    '$dataset["mk_MPSI"]', '$dataset["mk_MRS"]', '$dataset["mk_MR"]', '$dataset["mk_PPB"]', '$dataset["mk_PSSI"]', '$dataset["mk_TKTI"]', '$dataset["mk_EA"]', '$dataset["mk_SBF"]', '$dataset["mk_MHP"]',);

    public function getMKList()
    {
        return $this->mk_list;
    }

    public function getMKListVar()
    {
        return $this->mk_list_var;
    }

    public function getMKListCol()
    {
        return $this->mk_list_col;
    }

    public function index()
    {
        $selected_tree = DecisionTree::latest()->first();
        $trees = NULL;
        $tree = NULL;
        if(!$selected_tree){
            $selected_tree = NULL;
        }else{
            $trees = DecisionTree::where('tree_id', '!=', $selected_tree->tree_id)->paginate(15);
            if($trees->isEmpty()){
                $trees = NULL;
            }
        }
        // if(!$trees){
        //     $trees = NULL;
        // }
        // dd($trees);
        return view('pages.decisiontree.index', compact(['selected_tree', 'trees', 'tree']));
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
        $selected_tree = DecisionTree::where('tree_id', $id)->first();
        // $selected_tree = NULL;
        return view('pages.decisiontree.show', compact(['selected_tree']));
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

    private function getRecommendation($dataset, $is_collection, $tree_id)
    {
        if($tree_id == NULL){
            $tree = DecisionTree::latest()->first();
        }else{
            $tree = DecisionTree::where('tree_id', $tree_id)->first();
        }
        $rules = $tree->tree_rules;
        $mk_list = $this->getMKList();
        foreach($mk_list as $mk => $key){
            $mk_list[$mk] = '/\b'.$mk_list[$mk].'\b/';
        }
        $rekomendasi = NULL;
        if($is_collection){
            $mk_list_var = $this->getMKListCol();    
        }else{
            $mk_list_var = $this->getMKListVar();
        }
        $rules = str_replace("[VAR]", '$rekomendasi', $rules);
        $rules = preg_replace($mk_list, $mk_list_var, $rules);
        // dd($rules);
        ob_start();
            eval($rules);
        ob_end_clean();
        return $rekomendasi;
    }

    private function setRecommendation($dataset, $table, $tree_id)
    {
        if($table == 'testings'){
            foreach($dataset as $data){
                Testing::where('testing_id', $data->testing_id)->update(['skripsi_bidang_rekomendasi' => $this->getRecommendation($data, FALSE, $tree_id)]);
            }
        }
        if($table == 'datasets'){
            foreach($dataset as $data){
                Dataset::where('id', $data->id)->update(['skripsi_bidang_rekomendasi' => $this->getRecommendation($data, FALSE, $tree_id)]);
            }   
        }
        if($table == 'recommendations'){
            $data = collect($dataset);
            Recommendation::where('id', $data['id'])->update(['skripsi_bidang_rekomendasi' => $this->getRecommendation($data, TRUE, $tree_id)]);
        }
    }

    public function useModel($dataset, $table, $tree_id)
    {
        $dataset = collect($dataset);
        $this->setRecommendation($dataset, $table, $tree_id);
    }
}
