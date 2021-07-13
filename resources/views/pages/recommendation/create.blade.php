@extends('pages.recommendation.master')
@section('recommendation')
    @parent
    @php($route_prefix = NULL)
    @if (auth()->user()->role == 'kaprodi')
        @php($route_prefix = 'admin')
    @else
        @php($route_prefix = 'kjfd')
    @endif
    @if (!$errors)
        
    @endif
    @if ($tree)
        <form action="{{route($route_prefix.'.recommendation.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <h5 class="mb-3">Data mahasiswa</h5>
            <input type="hidden" id="tree_id" name="tree_id" value="{{$selected_tree->tree_id}}">
            <div class="input-group has-validation mb-4">
                <div class="input-group-prepend">
                    <span class="input-group-text">NIM</span>
                </div>
                <input type="text" class="form-control {{$errors->has('NIM') ? 'is-invalid':''}}" id="NIM" name="NIM" value="{{ old('NIM')}}" autocomplete="off" autofocus>
                @error('NIM')
                <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
            </div>
            <h5 class="mb-3">Data akademik</h5>
            <div class="bg-light py-3">
                <table class="table table-sm my-0">
                    <tbody>
                        <tr class="statistic-table-top">
                            <th scope="row" class="px-3">Nilai yang diijinkan</th>
                            <td scope="row" class="px-3">
                                <span class="badge badge-success">A</span> | 
                                <span class="badge badge-success">B+</span> | 
                                <span class="badge badge-success">B</span> | 
                                <span class="badge badge-success">C+</span> | 
                                <span class="badge badge-success">C</span> | 
                                <span class="badge badge-success">D+</span> | 
                                <span class="badge badge-success">D</span> | 
                                <span class="badge badge-success">E</span> | 
                                <span class="badge badge-success">K</span>
                            </td>
                            <th scope="row" class="px-3 table-separator">Nilai pada mata kuliah yang tidak diambil</th>
                            <td scope="row" class="px-3">
                                <span class="badge badge-warning">NULL</span> atau 
                                <span class="badge badge-warning">Kosongkan</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            {{-- Row 1 --}}
            <div class="row mt-4">
                <div class="col-md-2">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text mk-input">PGI</span>
                        </div>
                        <input type="text" class="form-control {{$errors->has('mk_PGI') ? 'is-invalid':''}}" id="mk_PGI" name="mk_PGI" value="{{ old('mk_PGI')}}" autocomplete="off">
                        @error('mk_PGI')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text mk-input">SIGD1</span>
                        </div>
                        <input type="text" class="form-control {{$errors->has('mk_SIGD1') ? 'is-invalid':''}}" id="mk_SIGD1" name="mk_SIGD1" value="{{ old('mk_SIGD1')}}" autocomplete="off">
                        @error('mk_SIGD1')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text mk-input">SIGD2</span>
                        </div>
                        <input type="text" class="form-control {{$errors->has('mk_SIGD2') ? 'is-invalid':''}}" id="mk_SIGD2" name="mk_SIGD2" value="{{ old('mk_SIGD2')}}" autocomplete="off">
                        @error('mk_SIGD2')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text mk-input">SIGL</span>
                        </div>
                        <input type="text" class="form-control {{$errors->has('mk_SIGL') ? 'is-invalid':''}}" id="mk_SIGL" name="mk_SIGL" value="{{ old('mk_SIGL')}}" autocomplete="off">
                        @error('mk_SIGL')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text mk-input">SPK</span>
                        </div>
                        <input type="text" class="form-control {{$errors->has('mk_SPK') ? 'is-invalid':''}}" id="mk_SPK" name="mk_SPK" value="{{ old('mk_SPK')}}" autocomplete="off">
                        @error('mk_SPK')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text mk-input">ABD</span>
                        </div>
                        <input type="text" class="form-control {{$errors->has('mk_ABD') ? 'is-invalid':''}}" id="mk_ABD" name="mk_ABD" value="{{ old('mk_ABD')}}" autocomplete="off">
                        @error('mk_ABD')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            {{-- Row 2 --}}
            <div class="row">
                <div class="col-md-2">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text mk-input">BDT</span>
                        </div>
                        <input type="text" class="form-control {{$errors->has('mk_BDT') ? 'is-invalid':''}}" id="mk_BDT" name="mk_BDT" value="{{ old('mk_BDT')}}" autocomplete="off">
                        @error('mk_BDT')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text mk-input">DBD</span>
                        </div>
                        <input type="text" class="form-control {{$errors->has('mk_DBD') ? 'is-invalid':''}}" id="mk_DBD" name="mk_DBD" value="{{ old('mk_DBD')}}" autocomplete="off">
                        @error('mk_DBD')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text mk-input">DM</span>
                        </div>
                        <input type="text" class="form-control {{$errors->has('mk_DM') ? 'is-invalid':''}}" id="mk_DM" name="mk_DM" value="{{ old('mk_DM')}}" autocomplete="off">
                        @error('mk_DM')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text mk-input">DW</span>
                        </div>
                        <input type="text" class="form-control {{$errors->has('mk_DW') ? 'is-invalid':''}}" id="mk_DW" name="mk_DW" value="{{ old('mk_DW')}}" autocomplete="off">
                        @error('mk_DW')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text mk-input">KB</span>
                        </div>
                        <input type="text" class="form-control {{$errors->has('mk_KB') ? 'is-invalid':''}}" id="mk_KB" name="mk_KB" value="{{ old('mk_KB')}}" autocomplete="off">
                        @error('mk_KB')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text mk-input">PBD</span>
                        </div>
                        <input type="text" class="form-control {{$errors->has('mk_PBD') ? 'is-invalid':''}}" id="mk_PBD" name="mk_PBD" value="{{ old('mk_PBD')}}" autocomplete="off">
                        @error('mk_PBD')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            {{-- Row 3 --}}
            <div class="row">
                <div class="col-md-2">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text mk-input">ADSI</span>
                        </div>
                        <input type="text" class="form-control {{$errors->has('mk_ADSI') ? 'is-invalid':''}}" id="mk_ADSI" name="mk_ADSI" value="{{ old('mk_ADSI')}}" autocomplete="off">
                        @error('mk_ADSI')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text mk-input">DPSI</span>
                        </div>
                        <input type="text" class="form-control {{$errors->has('mk_DPSI') ? 'is-invalid':''}}" id="mk_DPSI" name="mk_DPSI" value="{{ old('mk_DPSI')}}" autocomplete="off">
                        @error('mk_DPSI')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text mk-input">IPSI</span>
                        </div>
                        <input type="text" class="form-control {{$errors->has('mk_IPSI') ? 'is-invalid':''}}" id="mk_IPSI" name="mk_IPSI" value="{{ old('mk_IPSI')}}" autocomplete="off">
                        @error('mk_IPSI')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text mk-input">PABW</span>
                        </div>
                        <input type="text" class="form-control {{$errors->has('mk_PABW') ? 'is-invalid':''}}" id="mk_PABW" name="mk_PABW" value="{{ old('mk_PABW')}}" autocomplete="off">
                        @error('mk_PABW')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text mk-input">PBPU</span>
                        </div>
                        <input type="text" class="form-control {{$errors->has('mk_PBPU') ? 'is-invalid':''}}" id="mk_PBPU" name="mk_PBPU" value="{{ old('mk_PBPU')}}" autocomplete="off">
                        @error('mk_PBPU')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text mk-input">PPP</span>
                        </div>
                        <input type="text" class="form-control {{$errors->has('mk_PPP') ? 'is-invalid':''}}" id="mk_PPP" name="mk_PPP" value="{{ old('mk_PPP')}}" autocomplete="off">
                        @error('mk_PPP')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            {{-- Row 4 --}}
            <div class="row">
                <div class="col-md-2">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text mk-input">SE</span>
                        </div>
                        <input type="text" class="form-control {{$errors->has('mk_SE') ? 'is-invalid':''}}" id="mk_SE" name="mk_SE" value="{{ old('mk_SE')}}" autocomplete="off">
                        @error('mk_SE')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text mk-input">PL</span>
                        </div>
                        <input type="text" class="form-control {{$errors->has('mk_PL') ? 'is-invalid':''}}" id="mk_PL" name="mk_PL" value="{{ old('mk_PL')}}" autocomplete="off">
                        @error('mk_PL')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text mk-input">DDAP</span>
                        </div>
                        <input type="text" class="form-control {{$errors->has('mk_DDAP') ? 'is-invalid':''}}" id="mk_DDAP" name="mk_DDAP" value="{{ old('mk_DDAP')}}" autocomplete="off">
                        @error('mk_DDAP')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text mk-input">DIAP</span>
                        </div>
                        <input type="text" class="form-control {{$errors->has('mk_DIAP') ? 'is-invalid':''}}" id="mk_DIAP" name="mk_DIAP" value="{{ old('mk_DIAP')}}" autocomplete="off">
                        @error('mk_DIAP')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text mk-input">EPAP</span>
                        </div>
                        <input type="text" class="form-control {{$errors->has('mk_EPAP') ? 'is-invalid':''}}" id="mk_EPAP" name="mk_EPAP" value="{{ old('mk_EPAP')}}" autocomplete="off">
                        @error('mk_EPAP')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text mk-input">EASI</span>
                        </div>
                        <input type="text" class="form-control {{$errors->has('mk_EASI') ? 'is-invalid':''}}" id="mk_EASI" name="mk_EASI" value="{{ old('mk_EASI')}}" autocomplete="off">
                        @error('mk_EASI')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            {{-- Row 5 --}}
            <div class="row">
                <div class="col-md-2">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text mk-input">MO</span>
                        </div>
                        <input type="text" class="form-control {{$errors->has('mk_MO') ? 'is-invalid':''}}" id="mk_MO" name="mk_MO" value="{{ old('mk_MO')}}" autocomplete="off">
                        @error('mk_MO')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text mk-input">MITI</span>
                    </div>
                    <input type="text" class="form-control {{$errors->has('mk_MITI') ? 'is-invalid':''}}" id="mk_MITI" name="mk_MITI" value="{{ old('mk_MITI')}}" autocomplete="off">
                    @error('mk_MITI')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                </div>
            </div>
            <div class="col-md-2">
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text mk-input">MLTI</span>
                    </div>
                    <input type="text" class="form-control {{$errors->has('mk_MLTI') ? 'is-invalid':''}}" id="mk_MLTI" name="mk_MLTI" value="{{ old('mk_MLTI')}}" autocomplete="off">
                    @error('mk_MLTI')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                </div>
            </div>
            <div class="col-md-2">
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text mk-input">MP</span>
                    </div>
                    <input type="text" class="form-control {{$errors->has('mk_MP') ? 'is-invalid':''}}" id="mk_MP" name="mk_MP" value="{{ old('mk_MP')}}" autocomplete="off">
                    @error('mk_MP')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                </div>
            </div>
            <div class="col-md-2">
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text mk-input">MPSI</span>
                    </div>
                    <input type="text" class="form-control {{$errors->has('mk_MPSI') ? 'is-invalid':''}}" id="mk_MPSI" name="mk_MPSI" value="{{ old('mk_MPSI')}}" autocomplete="off">
                    @error('mk_MPSI')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text mk-input">MRS</span>
                        </div>
                        <input type="text" class="form-control {{$errors->has('mk_MRS') ? 'is-invalid':''}}" id="mk_MRS" name="mk_MRS" value="{{ old('mk_MRS')}}" autocomplete="off">
                        @error('mk_MRS')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            {{-- Row 6 --}}
            <div class="row">
                <div class="col-md-2">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text mk-input">MR</span>
                        </div>
                        <input type="text" class="form-control {{$errors->has('mk_MR') ? 'is-invalid':''}}" id="mk_MR" name="mk_MR" value="{{ old('mk_MR')}}" autocomplete="off">
                        @error('mk_MR')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text mk-input">PPB</span>
                        </div>
                        <input type="text" class="form-control {{$errors->has('mk_PPB') ? 'is-invalid':''}}" id="mk_PPB" name="mk_PPB" value="{{ old('mk_PPB')}}" autocomplete="off">
                        @error('mk_PPB')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text mk-input">PSSI</span>
                        </div>
                        <input type="text" class="form-control {{$errors->has('mk_PSSI') ? 'is-invalid':''}}" id="mk_PSSI" name="mk_PSSI" value="{{ old('mk_PSSI')}}" autocomplete="off">
                        @error('mk_PSSI')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text mk-input">TKTI</span>
                        </div>
                        <input type="text" class="form-control {{$errors->has('mk_TKTI') ? 'is-invalid':''}}" id="mk_TKTI" name="mk_TKTI" value="{{ old('mk_TKTI')}}" autocomplete="off">
                        @error('mk_TKTI')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text mk-input">EA</span>
                        </div>
                        <input type="text" class="form-control {{$errors->has('mk_EA') ? 'is-invalid':''}}" id="mk_EA" name="mk_EA" value="{{ old('mk_EA')}}" autocomplete="off">
                        @error('mk_EA')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text mk-input">SBF</span>
                        </div>
                        <input type="text" class="form-control {{$errors->has('mk_SBF') ? 'is-invalid':''}}" id="mk_SBF" name="mk_SBF" value="{{ old('mk_SBF')}}" autocomplete="off">
                        @error('mk_SBF')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            {{-- Row 7 --}}
            <div class="row">
                    <div class="col-md-2">
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text mk-input">MHP</span>
                            </div>
                            <input type="text" class="form-control {{$errors->has('mk_MHP') ? 'is-invalid':''}}" id="mk_MHP" name="mk_MHP" value="{{ old('mk_MHP')}}" autocomplete="off">
                            @error('mk_MHP')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            @if (Session::has('empty_error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {!!Session::get('empty_error')!!}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
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