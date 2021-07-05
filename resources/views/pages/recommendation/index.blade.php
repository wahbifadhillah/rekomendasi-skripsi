@extends('pages.recommendation.master')
@section('recommendation')
    @parent
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
            @if ($recommendations)
                @foreach ($recommendations as $recommendation)
                    <tr>
                        <th scope="row" class="table-num text-center px-3">
                            {{($recommendations->firstItem() + $loop->index)}}
                        </th>
                        <td class="px-3">
                            {{$recommendation->NIM}}
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
                        <td class="table-separator pl-4 pr-3">{{$recommendation->mk_PGI}}</td>
                        <td class="px-3">{{$recommendation->mk_SIGD1}}</td>
                        <td class="px-3">{{$recommendation->mk_SIGD2}}</td>
                        <td class="px-3">{{$recommendation->mk_SIGL}}</td>
                        <td class="px-3">{{$recommendation->mk_SPK}}</td>
                        <td class="px-3">{{$recommendation->mk_ABD}}</td>
                        <td class="px-3">{{$recommendation->mk_BDT}}</td>
                        <td class="px-3">{{$recommendation->mk_DBD}}</td>
                        <td class="px-3">{{$recommendation->mk_DM}}</td>
                        <td class="px-3">{{$recommendation->mk_DW}}</td>
                        <td class="px-3">{{$recommendation->mk_KB}}</td>
                        <td class="px-3">{{$recommendation->mk_PBD}}</td>
                        <td class="px-3">{{$recommendation->mk_ADSI}}</td>
                        <td class="px-3">{{$recommendation->mk_DPSI}}</td>
                        <td class="px-3">{{$recommendation->mk_IPSI}}</td>
                        <td class="px-3">{{$recommendation->mk_PABW}}</td>
                        <td class="px-3">{{$recommendation->mk_PBPU}}</td>
                        <td class="px-3">{{$recommendation->mk_PPP}}</td>
                        <td class="px-3">{{$recommendation->mk_SE}}</td>
                        <td class="px-3">{{$recommendation->mk_PL}}</td>
                        <td class="px-3">{{$recommendation->mk_DDAP}}</td>
                        <td class="px-3">{{$recommendation->mk_DIAP}}</td>
                        <td class="px-3">{{$recommendation->mk_EPAP}}</td>
                        <td class="px-3">{{$recommendation->mk_EASI}}</td>
                        <td class="px-3">{{$recommendation->mk_MO}}</td>
                        <td class="px-3">{{$recommendation->mk_MITI}}</td>
                        <td class="px-3">{{$recommendation->mk_MLTI}}</td>
                        <td class="px-3">{{$recommendation->mk_MP}}</td>
                        <td class="px-3">{{$recommendation->mk_MPSI}}</td>
                        <td class="px-3">{{$recommendation->mk_MRS}}</td>
                        <td class="px-3">{{$recommendation->mk_MR}}</td>
                        <td class="px-3">{{$recommendation->mk_PPB}}</td>
                        <td class="px-3">{{$recommendation->mk_PSSI}}</td>
                        <td class="px-3">{{$recommendation->mk_TKTI}}</td>
                        <td class="px-3">{{$recommendation->mk_EA}}</td>
                        <td class="px-3">{{$recommendation->mk_SBF}}</td>
                        <td class="px-3">{{$recommendation->mk_MHP}}</td>
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
                @if(auth()->user()->role == 1)
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