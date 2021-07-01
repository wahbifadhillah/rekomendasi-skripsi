<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recommendation;
use App\Dataset;
use App\DecisionTree;

class RecommendationController extends Controller
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
    
    public function index()
    {
        $recommendations = Recommendation::latest()->paginate(15);
        if($recommendations->isEmpty()){
            $recommendations = NULL;
        }
        return view('pages.recommendation.index', compact(['recommendations']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $selected_tree = DecisionTree::latest()->first();
        if(!$selected_tree){
            $selected_tree = NULL;
        }
        $tree = collect(DecisionTree::latest()->first())->isEmpty() ? FALSE:TRUE;
        return view('pages.recommendation.create', compact(['tree', 'selected_tree']));
    }

    public function createBYtree($id)
    {
        $selected_tree = DecisionTree::where('tree_id', $id)->first();
        if(!$selected_tree){
            $selected_tree = NULL;
        }
        $tree = collect(DecisionTree::where('tree_id', $id)->get())->isEmpty() ? FALSE:TRUE;
        return view('pages.recommendation.create', compact(['tree', 'selected_tree']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private function transformGrade($grade){
        if($grade == 'A'){
            return 'A';
        }elseif($grade == 'B+'){
            return 'B';
        }elseif($grade == 'B'){
            return 'B';
        }elseif($grade == 'C+'){
            return 'C';
        }elseif($grade == 'C'){
            return 'C';
        }elseif($grade == 'D+'){
            return 'D';
        }elseif($grade == 'D'){
            return 'D';
        }elseif($grade == 'E'){
            return 'E';
        }elseif($grade == 'K'){
            return 'E';
        }elseif($grade == 'NULL' || $grade == NULL){
            return 'E';
        }else{
            return NULL;
        }
    }

    public function store(Request $request)
    {
        $recommendation = new Recommendation;
        $recommendation = Recommendation::create([
            'NIM' => $request->NIM,
            'skripsi_bidang_rekomendasi' => NULL,
            'mk_PGI' => $this->transformGrade($request->mk_PGI),
            'mk_SIGD1' => $this->transformGrade($request->mk_SIGD1),
            'mk_SIGD2' => $this->transformGrade($request->mk_SIGD2),
            'mk_SIGL' => $this->transformGrade($request->mk_SIGL),
            'mk_SPK' => $this->transformGrade($request->mk_SPK),
            'mk_ABD' => $this->transformGrade($request->mk_ABD),
            'mk_BDT' => $this->transformGrade($request->mk_BDT),
            'mk_DBD' => $this->transformGrade($request->mk_DBD),
            'mk_DM' => $this->transformGrade($request->mk_DM),
            'mk_DW' => $this->transformGrade($request->mk_DW),
            'mk_KB' => $this->transformGrade($request->mk_KB),
            'mk_PBD' => $this->transformGrade($request->mk_PBD),
            'mk_ADSI' => $this->transformGrade($request->mk_ADSI),
            'mk_DPSI' => $this->transformGrade($request->mk_DPSI),
            'mk_IPSI' => $this->transformGrade($request->mk_IPSI),
            'mk_PABW' => $this->transformGrade($request->mk_PABW),
            'mk_PBPU' => $this->transformGrade($request->mk_PBPU),
            'mk_PPP' => $this->transformGrade($request->mk_PPP),
            'mk_SE' => $this->transformGrade($request->mk_SE),
            'mk_PL' => $this->transformGrade($request->mk_PL),
            'mk_DDAP' => $this->transformGrade($request->mk_DDAP),
            'mk_DIAP' => $this->transformGrade($request->mk_DIAP),
            'mk_EPAP' => $this->transformGrade($request->mk_EPAP),
            'mk_EASI' => $this->transformGrade($request->mk_EASI),
            'mk_MO' => $this->transformGrade($request->mk_MO),
            'mk_MITI' => $this->transformGrade($request->mk_MITI),
            'mk_MLTI' => $this->transformGrade($request->mk_MLTI),
            'mk_MP' => $this->transformGrade($request->mk_MP),
            'mk_MPSI' => $this->transformGrade($request->mk_MPSI),
            'mk_MRS' => $this->transformGrade($request->mk_MRS),
            'mk_MR' => $this->transformGrade($request->mk_MR),
            'mk_PPB' => $this->transformGrade($request->mk_PPB),
            'mk_PSSI' => $this->transformGrade($request->mk_PSSI),
            'mk_TKTI' => $this->transformGrade($request->mk_TKTI),
            'mk_EA' => $this->transformGrade($request->mk_EA),
            'mk_SBF' => $this->transformGrade($request->mk_SBF),
            'mk_MHP' => $this->transformGrade($request->mk_MHP)
        ]);
        $table = 'recommendations';
        $decision_tree = new DecisionTreeController;
        $decision_tree->useModel($recommendation, $table, $request->tree_id);
        return redirect('admin/recommendation/'.$recommendation['id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recommendation = Recommendation::where('id', $id)->first();
        $researches = Dataset::where('skripsi_bidang', $recommendation->skripsi_bidang_rekomendasi)->paginate(15);
        return view('pages.recommendation.show', compact(['recommendation', 'researches']));
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
