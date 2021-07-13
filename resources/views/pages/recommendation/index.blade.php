@extends('pages.recommendation.master')
@section('recommendation')
    @parent
    @section('search')
    @parent
    {{-- {{dd(route(auth()->user()->role == 'kaprodi' ? 'admin.recommendation.index':'kjfd.recommendation.index'))}} --}}
    @if ($recommendations)    
    <div class="row">
        <div class="col-12">
            <form action="{{ route(auth()->user()->role == 'kaprodi' ? 'admin.recommendation.index':'kjfd.recommendation.index')}}" method="GET">
                <div class="input-group mb-4">
                    <input type="search" id="search" name="search" class="form-control" placeholder="Cari dengan NIM" aria-label="Cari dengan NIM" aria-describedby="button-addon2" value="{{request()->query('search')}}" autocomplete="off">
                    <div class="input-group-append">
                        <input type="submit" class="btn btn-primary" type="button"  value="Cari">
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif
    @endsection
    <h5 class="mb-3">Keterangan Nilai Mata Kuliah</h5>
    <div class="bg-light py-3">
        <table class="table table-sm my-0">
            <tbody>
                <tr class="statistic-table-top">
                    <th scope="row" class="px-3">
                        <span class='badge badge-success'>SB</span>
                    </th>
                    <td scope="row" class="px-3">Sangat Baik</td>
                    <th scope="row" class="px-3 table-separator">
                        <span class='badge badge-success'>B</span>
                    </th>
                    <td scope="row" class="px-3">Baik</td>
                    <th scope="row" class="px-3 table-separator">
                        <span class='badge badge-success'>C</span>
                    </th>
                    <td scope="row" class="px-3">Cukup</td>
                    <th scope="row" class="px-3 table-separator">
                        <span class='badge badge-success'>K</span>
                    </th>
                    <td scope="row" class="px-3">Kurang</td>
                    <th scope="row" class="px-3 table-separator">
                        <span class='badge badge-secondary'>N</span>
                    </th>
                    <td scope="row" class="px-3">Mata kuliah tidak diambil oleh mahasiswa.</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="mt-3"></div>
    <table class="table table-sm data-table">
        <thead>
            <tr>
                <th rowspan="2" style="vertical-align: middle !important;" class="text-center px-3">#</th>
                <th rowspan="2" style="vertical-align: middle !important;" class="px-3">NIM</th>
                <th rowspan="2" style="vertical-align: middle !important;" class="pl-3 pr-4">Rekomendasi</th>
                <th colspan="37" class="table-separator px-4">Nilai mata kuliah</th>
            </tr>
            <tr>
                <th scope="col" class="sub-table table-separator pl-4 pr-3">PGI</th>
                <th scope="col" class="sub-table px-3">SIGD1</th>
                <th scope="col" class="sub-table px-3">SIGD2</th>
                <th scope="col" class="sub-table px-3">SIGL</th>
                <th scope="col" class="sub-table px-3">SPK</th>
                <th scope="col" class="sub-table px-3">ABD</th>
                <th scope="col" class="sub-table px-3">BDT</th>
                <th scope="col" class="sub-table px-3">DBD</th>
                <th scope="col" class="sub-table px-3">DM</th>
                <th scope="col" class="sub-table px-3">DW</th>
                <th scope="col" class="sub-table px-3">KB</th>
                <th scope="col" class="sub-table px-3">PBD</th>
                <th scope="col" class="sub-table px-3">ADSI</th>
                <th scope="col" class="sub-table px-3">DPSI</th>
                <th scope="col" class="sub-table px-3">IPSI</th>
                <th scope="col" class="sub-table px-3">PABW</th>
                <th scope="col" class="sub-table px-3">PBPU</th>
                <th scope="col" class="sub-table px-3">PPP</th>
                <th scope="col" class="sub-table px-3">SE</th>
                <th scope="col" class="sub-table px-3">PL</th>
                <th scope="col" class="sub-table px-3">DDAP</th>
                <th scope="col" class="sub-table px-3">DIAP</th>
                <th scope="col" class="sub-table px-3">EPAP</th>
                <th scope="col" class="sub-table px-3">EASI</th>
                <th scope="col" class="sub-table px-3">MO</th>
                <th scope="col" class="sub-table px-3">MITI</th>
                <th scope="col" class="sub-table px-3">MLTI</th>
                <th scope="col" class="sub-table px-3">MP</th>
                <th scope="col" class="sub-table px-3">MPSI</th>
                <th scope="col" class="sub-table px-3">MRS</th>
                <th scope="col" class="sub-table px-3">MR</th>
                <th scope="col" class="sub-table px-3">PPB</th>
                <th scope="col" class="sub-table px-3">PSSI</th>
                <th scope="col" class="sub-table px-3">TKTI</th>
                <th scope="col" class="sub-table px-3">EA</th>
                <th scope="col" class="sub-table px-3">SBF</th>
                <th scope="col" class="sub-table px-3">MHP</th>
            </tr>
        </thead>
    
        <tbody>
            @php
                function viewGrade($pgrade){
                    if($pgrade == 'SB'){
                        echo ("<span class='badge badge-success'>SB</span>");
                    }elseif ($pgrade == 'B') {
                        echo ("<span class='badge badge-success'>B</span>");
                    }elseif($pgrade == 'C'){
                        echo ("<span class='badge badge-success'>C</span>");
                    }elseif($pgrade == 'K'){
                        echo ("<span class='badge badge-success'>K</span>");
                    }elseif($pgrade == 'N'){
                        echo ("<span class='badge badge-secondary'>N</span>");
                    }
                }
            @endphp
            @php($route_prefix = NULL)
            @if (auth()->user()->role == 'kaprodi')
                @php($route_prefix = 'admin')
            @else
                @php($route_prefix = 'kjfd')
            @endif
            @if ($recommendations)
                @foreach ($recommendations as $recommendation)
                    <tr>
                        <th scope="row" class="table-num text-center px-3">
                            {{($recommendations->firstItem() + $loop->index)}}
                        </th>
                        <td class="px-3">
                            <a href="{{route($route_prefix.'.recommendation.show', $recommendation->NIM)}}">{{$recommendation->NIM}}</a>
                        </td>
                        <td class="pl-3 pr-4">
                            @if ($recommendation->skripsi_bidang_rekomendasi)
                                @switch($recommendation->skripsi_bidang_rekomendasi)
                                    @case('Tata Kelola & Manajemen Sistem Informasi')
                                         TKMSI
                                        @break

                                    @case('Pengembangan Sistem Informasi')
                                         PSI
                                        @break

                                    @case('Manajemen Data & Informasi')
                                         MDI
                                        @break

                                    @case('Sistem Informasi Geografis')
                                         SIG
                                        @break

                                    @default
                                        Not defined
                                @endswitch
                            @else
                                -
                            @endif
                        </td>
                        <td class="table-separator pl-4 pr-3">{!!viewGrade($recommendation->mk_PGI)!!}</td>
                        <td class="px-3">{!!viewGrade($recommendation->mk_SIGD1)!!}</td>
                        <td class="px-3">{!!viewGrade($recommendation->mk_SIGD2)!!}</td>
                        <td class="px-3">{!!viewGrade($recommendation->mk_SIGL)!!}</td>
                        <td class="px-3">{!!viewGrade($recommendation->mk_SPK)!!}</td>
                        <td class="px-3">{!!viewGrade($recommendation->mk_ABD)!!}</td>
                        <td class="px-3">{!!viewGrade($recommendation->mk_BDT)!!}</td>
                        <td class="px-3">{!!viewGrade($recommendation->mk_DBD)!!}</td>
                        <td class="px-3">{!!viewGrade($recommendation->mk_DM)!!}</td>
                        <td class="px-3">{!!viewGrade($recommendation->mk_DW)!!}</td>
                        <td class="px-3">{!!viewGrade($recommendation->mk_KB)!!}</td>
                        <td class="px-3">{!!viewGrade($recommendation->mk_PBD)!!}</td>
                        <td class="px-3">{!!viewGrade($recommendation->mk_ADSI)!!}</td>
                        <td class="px-3">{!!viewGrade($recommendation->mk_DPSI)!!}</td>
                        <td class="px-3">{!!viewGrade($recommendation->mk_IPSI)!!}</td>
                        <td class="px-3">{!!viewGrade($recommendation->mk_PABW)!!}</td>
                        <td class="px-3">{!!viewGrade($recommendation->mk_PBPU)!!}</td>
                        <td class="px-3">{!!viewGrade($recommendation->mk_PPP)!!}</td>
                        <td class="px-3">{!!viewGrade($recommendation->mk_SE)!!}</td>
                        <td class="px-3">{!!viewGrade($recommendation->mk_PL)!!}</td>
                        <td class="px-3">{!!viewGrade($recommendation->mk_DDAP)!!}</td>
                        <td class="px-3">{!!viewGrade($recommendation->mk_DIAP)!!}</td>
                        <td class="px-3">{!!viewGrade($recommendation->mk_EPAP)!!}</td>
                        <td class="px-3">{!!viewGrade($recommendation->mk_EASI)!!}</td>
                        <td class="px-3">{!!viewGrade($recommendation->mk_MO)!!}</td>
                        <td class="px-3">{!!viewGrade($recommendation->MK_MITI)!!}</td>
                        <td class="px-3">{!!viewGrade($recommendation->mk_MLTI)!!}</td>
                        <td class="px-3">{!!viewGrade($recommendation->mk_MP)!!}</td>
                        <td class="px-3">{!!viewGrade($recommendation->mk_MPSI)!!}</td>
                        <td class="px-3">{!!viewGrade($recommendation->mk_MRS)!!}</td>
                        <td class="px-3">{!!viewGrade($recommendation->mk_MR)!!}</td>
                        <td class="px-3">{!!viewGrade($recommendation->mk_PPB)!!}</td>
                        <td class="px-3">{!!viewGrade($recommendation->mk_PSSI)!!}</td>
                        <td class="px-3">{!!viewGrade($recommendation->mk_TKTI)!!}</td>
                        <td class="px-3">{!!viewGrade($recommendation->mk_EA)!!}</td>
                        <td class="px-3">{!!viewGrade($recommendation->mk_SBF)!!}</td>
                        <td class="px-3">{!!viewGrade($recommendation->mk_MHP)!!}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <div class="d-flex justify-content-between mt-3">
        <div class="d-flex justify-content-start">
            @if ($recommendations)
                <small>Menampilkan {{$recommendations->firstItem()}} hingga {{$recommendations->perPage()*$recommendations->currentPage()}} dari {{$recommendations->total()}} data</small>
            @else
                @if(auth()->user()->role == 'kaprodi')
                    <small>Data tidak ditemukan, dapatkan <a href="{{route('admin.recommendation.create')}}">rekomendasi</a> bidang skripsi.</small>
                @else
                    <small>Model pohon keputusan belum dilatih oleh admin.</small>
                @endif
            @endif
        </div>
            @if ($recommendations)
                <div class="d-flex justify-content-end">{{$recommendations->onEachSide(3)->appends($_GET)->links()}}</div>
            @endif
    </div>
@endsection