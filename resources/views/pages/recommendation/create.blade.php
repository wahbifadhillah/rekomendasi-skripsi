@extends('pages.recommendation.master')
@section('recommendation')
    @parent
    @php($route_prefix = NULL)
    @if (auth()->user()->role == 'kaprodi')
        @php($route_prefix = 'admin')
    @else
        @php($route_prefix = 'kjfd')
    @endif
    @if ($tree)
        <form action="{{route($route_prefix.'.recommendation.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <h5 class="mb-3">Data mahasiswa</h5>
            <input type="hidden" id="tree_id" name="tree_id" value="{{$selected_tree->tree_id}}">
            <div class="input-group mb-4">
                <div class="input-group-prepend">
                    <span class="input-group-text">NIM</span>
                </div>
                <input type="text" class="form-control" id="NIM" name="NIM">
            </div>
            <h5 class="mb-3">Data akademik</h5>
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text mk-input">PGI</span>
                </div>
                <input type="text" class="form-control" id="mk_PGI" name="mk_PGI">
                <div class="input-group-prepend">
                    <span class="input-group-text mk-input">SIGD1</span>
                </div>
                <input type="text" class="form-control" id="mk_SIGD1" name="mk_SIGD1">
                <div class="input-group-prepend">
                    <span class="input-group-text mk-input">SIGD2</span>
                </div>
                <input type="text" class="form-control" id="mk_SIGD2" name="mk_SIGD2">
                <div class="input-group-prepend">
                    <span class="input-group-text mk-input">SIGL</span>
                </div>
                <input type="text" class="form-control" id="mk_SIGL" name="mk_SIGL">
                <div class="input-group-prepend">
                    <span class="input-group-text mk-input">SPK</span>
                </div>
                <input type="text" class="form-control" id="mk_SPK" name="mk_SPK">
                <div class="input-group-prepend">
                    <span class="input-group-text mk-input">ABD</span>
                </div>
                <input type="text" class="form-control" id="mk_ABD" name="mk_ABD">
                <div class="input-group-prepend">
                    <span class="input-group-text mk-input">BDT</span>
                </div>
                <input type="text" class="form-control" id="mk_BDT" name="mk_BDT">
                <div class="input-group-prepend">
                    <span class="input-group-text mk-input">DBD</span>
                </div>
                <input type="text" class="form-control" id="mk_DBD" name="mk_DBD">
            </div>

            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text mk-input">DM</span>
                </div>
                <input type="text" class="form-control" id="mk_DM" name="mk_DM">
                <div class="input-group-prepend">
                    <span class="input-group-text mk-input">DW</span>
                </div>
                <input type="text" class="form-control" id="mk_DW" name="mk_DW">
                <div class="input-group-prepend">
                    <span class="input-group-text mk-input">KB</span>
                </div>
                <input type="text" class="form-control" id="mk_KB" name="mk_KB">
                <div class="input-group-prepend">
                    <span class="input-group-text mk-input">PBD</span>
                </div>
                <input type="text" class="form-control" id="mk_PBD" name="mk_PBD">
                <div class="input-group-prepend">
                    <span class="input-group-text mk-input">ADSI</span>
                </div>
                <input type="text" class="form-control" id="mk_ADSI" name="mk_ADSI">
                <div class="input-group-prepend">
                    <span class="input-group-text mk-input">DPSI</span>
                </div>
                <input type="text" class="form-control" id="mk_DPSI" name="mk_DPSI">
                <div class="input-group-prepend">
                    <span class="input-group-text mk-input">IPSI</span>
                </div>
                <input type="text" class="form-control" id="mk_IPSI" name="mk_IPSI">
                <div class="input-group-prepend">
                    <span class="input-group-text mk-input">PABW</span>
                </div>
                <input type="text" class="form-control" id="mk_PABW" name="mk_PABW">
            </div>

            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text mk-input">PBPU</span>
                </div>
                <input type="text" class="form-control" id="mk_PBPU" name="mk_PBPU">
                <div class="input-group-prepend">
                    <span class="input-group-text mk-input">PPP</span>
                </div>
                <input type="text" class="form-control" id="mk_PPP" name="mk_PPP">
                <div class="input-group-prepend">
                    <span class="input-group-text mk-input">SE</span>
                </div>
                <input type="text" class="form-control" id="mk_SE" name="mk_SE">
                <div class="input-group-prepend">
                    <span class="input-group-text mk-input">PL</span>
                </div>
                <input type="text" class="form-control" id="mk_PL" name="mk_PL">
                <div class="input-group-prepend">
                    <span class="input-group-text mk-input">DDAP</span>
                </div>
                <input type="text" class="form-control" id="mk_DDAP" name="mk_DDAP">
                <div class="input-group-prepend">
                    <span class="input-group-text mk-input">DIAP</span>
                </div>
                <input type="text" class="form-control" id="mk_DIAP" name="mk_DIAP">
                <div class="input-group-prepend">
                    <span class="input-group-text mk-input">EPAP</span>
                </div>
                <input type="text" class="form-control" id="mk_EPAP" name="mk_EPAP">
                <div class="input-group-prepend">
                    <span class="input-group-text mk-input">EASI</span>
                </div>
                <input type="text" class="form-control" id="mk_EASI" name="mk_EASI">
            </div>

            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text mk-input">MO</span>
                </div>
                <input type="text" class="form-control" id="mk_MO" name="mk_MO">
                <div class="input-group-prepend">
                    <span class="input-group-text mk-input">MITI</span>
                </div>
                <input type="text" class="form-control" id="mk_MITI" name="mk_MITI">
                <div class="input-group-prepend">
                    <span class="input-group-text mk-input">MLTI</span>
                </div>
                <input type="text" class="form-control" id="mk_MLTI" name="mk_MLTI">
                <div class="input-group-prepend">
                    <span class="input-group-text mk-input">MP</span>
                </div>
                <input type="text" class="form-control" id="mk_MP" name="mk_MP">
                <div class="input-group-prepend">
                    <span class="input-group-text mk-input">MPSI</span>
                </div>
                <input type="text" class="form-control" id="mk_MPSI" name="mk_MPSI">
                <div class="input-group-prepend">
                    <span class="input-group-text mk-input">MRS</span>
                </div>
                <input type="text" class="form-control" id="mk_MRS" name="mk_MRS">
                <div class="input-group-prepend">
                    <span class="input-group-text mk-input">MR</span>
                </div>
                <input type="text" class="form-control" id="mk_MR" name="mk_MR">
                <div class="input-group-prepend">
                    <span class="input-group-text mk-input">PPB</span>
                </div>
                <input type="text" class="form-control" id="mk_PPB" name="mk_PPB">
            </div>

            <div class="input-group input-group-sm mb-4">
                <div class="input-group-prepend">
                    <span class="input-group-text mk-input">PSSI</span>
                </div>
                <input type="text" class="form-control" id="mk_PSSI" name="mk_PSSI">
                <div class="input-group-prepend">
                    <span class="input-group-text mk-input">TKTI</span>
                </div>
                <input type="text" class="form-control" id="mk_TKTI" name="mk_TKTI">
                <div class="input-group-prepend">
                    <span class="input-group-text mk-input">EA</span>
                </div>
                <input type="text" class="form-control" id="mk_EA" name="mk_EA">
                <div class="input-group-prepend">
                    <span class="input-group-text mk-input">SBF</span>
                </div>
                <input type="text" class="form-control" id="mk_SBF" name="mk_SBF">
                <div class="input-group-prepend">
                    <span class="input-group-text mk-input">MHP</span>
                </div>
                <input type="text" class="form-control" id="mk_MHP" name="mk_MHP">
            </div>
            <div class="d-flex justify-content-between mt-3 align-middle">
                <div class="d-flex justify-content-start">
                    <small>Mendapatkan rekomendasi menggunakan model pohon keputusan <a href="{{route($route_prefix.'.decisiontree.show', $selected_tree->tree_id)}}"><span class="badge badge-primary">{{$selected_tree->tree_name}}</span></a></small>
                </div>
                <div class="d-flex justify-content-end">
                    <input type="submit" class="btn btn-primary" type="button" value="Dapatkan rekomendasi">

                </div>
            </div>
            
        </form>
    @else
        <div class="row">
            <div class="col-12">
                <div class="boxed">
                    @if(auth()->user()->role == 'kaprodi')
                        Model pohon keputusan tidak ditemukan, latih dan buat <a href="{{route($route_prefix.'.training.index')}}">model pohon keputusan</a> terlebih dahulu.
                    @else
                        Model pohon keputusan belum dilatih oleh admin.
                    @endif
                </div>
            </div>
        </div>
    @endif
@endsection