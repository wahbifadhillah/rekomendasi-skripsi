@extends('pages.dataset.master')
@section('filters')
    @parent
    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.dataset.index')}}" method="GET">
                <input type="hidden" name="filter">
                <div class="input-group mb-4">
                    <select class="custom-select" name="angkatan" id="angkatan">
                        <option value="semua_angkatan" {{request()->query('angkatan') == 'semua_angkatan' ? 'selected':''}}>Semua Angkatan</option>
                        @foreach ($filters['angkatan'] as $angkatan)
                            <option value="{{$angkatan}}" {{request()->query('angkatan') == $angkatan ? 'selected':''}}>{{$angkatan}}</option>
                        @endforeach
                    </select>
                    <select class="custom-select" name="status_skripsi" id="status_skripsi">
                        <option {{request()->query('status_skripsi') == 'semua_status_skripsi' ? 'selected':''}}>Semua Status Skripsi</option>
                        <option value="tepat_waktu" {{request()->query('status_skripsi') == 'tepat_waktu' ? 'selected':''}}>Tepat Waktu</option>
                        <option value="tidak_tepat_waktu" {{request()->query('status_skripsi') == 'tidak_tepat_waktu' ? 'selected':''}}>Tidak Tepat Waktu</option>
                    </select>
                    <div class="input-group-append">
                        <input type="submit" class="btn btn-primary" type="button"  value="Tampilkan">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('dataset')
    @parent
    <div class="d-flex justify-content-end mb-3">
        <div class="pr-3">
            <a href="{{route('admin.dataset.applymodel')}}" class="btn {{$use_model == 0 ? 'btn-warning':''}} {{$use_model == 1 ? 'btn-outline-warning text-dark disabled':''}} {{$use_model == 2 ? 'btn-outline-warning text-dark':''}} {{$tree ? 'disabled':''}}">
                @if ($use_model == 1 || $use_model == 2)
                    Aplikasikan model pada dataset lagi
                @else
                    Aplikasikan model pada dataset
                @endif
            </a>
        </div>
        <a href="{{route('admin.dataset.splitdata')}}" class="btn {{$split ? 'btn-primary':'btn-outline-primary'}} {{$datasets ? '':'disabled'}}">
            @if ($split)
                Buat data latih dan data uji
            @else
                Buat ulang data latih dan data uji
            @endif
        </a>
    </div>
    {{-- {{dd($tree)}} --}}
    <table class="table table-sm data-table">
        <thead>
            <tr>
                <th rowspan="2" style="vertical-align: middle !important;" class="text-center px-3">#</th>
                <th rowspan="2" style="vertical-align: middle !important;" class="pl-3 pr-4">Angkatan</th>
                <th colspan="5" class="table-separator px-4">Data skripsi</th>
                <th colspan="37" class="table-separator px-4">Nilai mata kuliah</th>
            </tr>
            <tr>
                
                <th scope="col" class="sub-table table-separator pl-4 pr-3">Tahun Skripsi</th>
                <th scope="col" class="sub-table px-3">Lama Skripsi</th>
                <th scope="col" class="sub-table px-3">Status Pengerjaan</th>
                <th scope="col" class="sub-table px-3">Bidang Skripsi</th>
                <th scope="col" class="sub-table pl-3 pr-4">Rekomendasi</th>
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
            @if ($datasets)
                @foreach ($datasets as $dataset)
                    <tr>
                        <th scope="row" class="table-num px-3">
                            {{($datasets->firstItem() + $loop->index)}}
                        </th>
                        @php $pageCount = $datasets->firstItem() + $loop->index @endphp
                        <td class="pl-3 pr-4">
                            {{'20'.substr($dataset->NIM, 0, 2)}}
                        </td>
                        <td class="table-separator pl-4 pr-3">
                            {{$dataset->skripsi_tahun}}
                        </td>
                        <td class="px-3">
                            @php $proposal = new DateTime($dataset->skripsi_tanggal_proposal); $semhas = new DateTime($dataset->skripsi_tanggal_semhas); $interval = $semhas->diff($proposal); $days = $interval->format('%a'); $months = floor($days/30);@endphp
                            {{-- {{$days.' hari ('.$months.' bulan)'}} --}}
                            <span class="badge badge-primary">{{$days}} hari</span> <span class="badge badge-success">{{$months}} bulan</span>
                        </td>
                        <td class="px-3">
                            @php $proposal = new DateTime($dataset->skripsi_tanggal_proposal); $semhas = new DateTime($dataset->skripsi_tanggal_semhas); $interval = $semhas->diff($proposal); $days = $interval->format('%a'); @endphp
                            @if ($days <= 180)
                            Tepat waktu
                            @else
                            Tidak tepat waktu
                            @endif
                        </td>
                        <td class="px-3">
                            @switch($dataset->skripsi_bidang)
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
                        </td>
                        <td class="pl-3 pr-4">
                            @php
                                $is_match = $dataset->skripsi_bidang == $dataset->skripsi_bidang_rekomendasi ? TRUE:FALSE;
                            @endphp
                            @if ($dataset->skripsi_bidang_rekomendasi)
                                @switch($dataset->skripsi_bidang_rekomendasi)
                                    @case('Tata Kelola & Manajemen Sistem Informasi')
                                        @if ($is_match)
                                            <span class="badge badge-primary">
                                                <i class="fas fa-check"></i>
                                            </span>
                                        @else
                                            <span class="badge badge-danger">
                                                <i class="fas fa-times"></i>
                                            </span>
                                        @endif
                                         TKMSI
                                        @break

                                    @case('Pengembangan Sistem Informasi')
                                        @if ($is_match)
                                            <span class="badge badge-primary">
                                                <i class="fas fa-check"></i>
                                            </span>
                                        @else
                                            <span class="badge badge-danger">
                                                <i class="fas fa-times"></i>
                                            </span>
                                        @endif
                                         PSI
                                        @break

                                    @case('Manajemen Data & Informasi')
                                        @if ($is_match)
                                            <span class="badge badge-primary">
                                                <i class="fas fa-check"></i>
                                            </span>
                                        @else
                                            <span class="badge badge-danger">
                                                <i class="fas fa-times"></i>
                                            </span>
                                        @endif
                                         MDI
                                        @break

                                    @case('Sistem Informasi Geografis')
                                        @if ($is_match)
                                            <span class="badge badge-primary">
                                                <i class="fas fa-check"></i>
                                            </span>
                                        @else
                                            <span class="badge badge-danger">
                                                <i class="fas fa-times"></i>
                                            </span>
                                        @endif
                                         SIG
                                        @break

                                    @default
                                        Not defined
                                @endswitch
                            @else
                                -
                            @endif
                        </td>
                        <td class="table-separator pl-4 pr-3">{{$dataset->mk_PGI}}</td>
                        <td class="px-3">{{$dataset->mk_SIGD1}}</td>
                        <td class="px-3">{{$dataset->mk_SIGD2}}</td>
                        <td class="px-3">{{$dataset->mk_SIGL}}</td>
                        <td class="px-3">{{$dataset->mk_SPK}}</td>
                        <td class="px-3">{{$dataset->mk_ABD}}</td>
                        <td class="px-3">{{$dataset->mk_BDT}}</td>
                        <td class="px-3">{{$dataset->mk_DBD}}</td>
                        <td class="px-3">{{$dataset->mk_DM}}</td>
                        <td class="px-3">{{$dataset->mk_DW}}</td>
                        <td class="px-3">{{$dataset->mk_KB}}</td>
                        <td class="px-3">{{$dataset->mk_PBD}}</td>
                        <td class="px-3">{{$dataset->mk_ADSI}}</td>
                        <td class="px-3">{{$dataset->mk_DPSI}}</td>
                        <td class="px-3">{{$dataset->mk_IPSI}}</td>
                        <td class="px-3">{{$dataset->mk_PABW}}</td>
                        <td class="px-3">{{$dataset->mk_PBPU}}</td>
                        <td class="px-3">{{$dataset->mk_PPP}}</td>
                        <td class="px-3">{{$dataset->mk_SE}}</td>
                        <td class="px-3">{{$dataset->mk_PL}}</td>
                        <td class="px-3">{{$dataset->mk_DDAP}}</td>
                        <td class="px-3">{{$dataset->mk_DIAP}}</td>
                        <td class="px-3">{{$dataset->mk_EPAP}}</td>
                        <td class="px-3">{{$dataset->mk_EASI}}</td>
                        <td class="px-3">{{$dataset->mk_MO}}</td>
                        <td class="px-3">{{$dataset->mk_MITI}}</td>
                        <td class="px-3">{{$dataset->mk_MLTI}}</td>
                        <td class="px-3">{{$dataset->mk_MP}}</td>
                        <td class="px-3">{{$dataset->mk_MPSI}}</td>
                        <td class="px-3">{{$dataset->mk_MRS}}</td>
                        <td class="px-3">{{$dataset->mk_MR}}</td>
                        <td class="px-3">{{$dataset->mk_PPB}}</td>
                        <td class="px-3">{{$dataset->mk_PSSI}}</td>
                        <td class="px-3">{{$dataset->mk_TKTI}}</td>
                        <td class="px-3">{{$dataset->mk_EA}}</td>
                        <td class="px-3">{{$dataset->mk_SBF}}</td>
                        <td class="px-3">{{$dataset->mk_MHP}}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <div class="d-flex justify-content-between mt-3">
        <div class="d-flex justify-content-start">
            @if ($datasets)
                <small>Menampilkan {{$datasets->firstItem()}} hingga {{$datasets->perPage()*$datasets->currentPage()}} dari {{$datasets->total()}} data</small>
            @else
                <small>Data tidak ditemukan, input <a href="{{route('admin.dataset.create')}}">dataset</a> terlebih dahulu.</small>
            @endif
        </div>
            @if ($datasets)
                <div class="d-flex justify-content-end">{{$datasets->onEachSide(3)->appends($_GET)->links()}}</div>
            @endif
    </div>
    @if (Session::has('file_success'))
    <div class="modal fade" id="pre-process" tabindex="-1" aria-labelledby="pre-processLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pre-processLabel">Pre-processing data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <p>Data telah di pre-processing dengan ketentuan sebagai berikut:</p>
                <table class="table table-sm">
                    <thead>
                        <th class="px-2">Nilai Mata Kuliah</th>
                        <th class="px-2 table-separator">Transformasi</th>
                        <th class="px-2 table-separator">Keterangan</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-2">A</td>
                            <td class="px-2 table-separator">SB</td>
                            <td class="px-2 table-separator">Sangat Baik</td>
                        </tr>
                        <tr>
                            <td class="px-2">B+</td>
                            <td class="px-2 table-separator" rowspan="2">B</td>
                            <td class="px-2 table-separator" rowspan="2">Baik</td>
                        </tr>
                        <tr>
                            <td class="px-2">B</td>
                        </tr>
                        <tr>
                            <td class="px-2">C+</td>
                            <td class="px-2 table-separator" rowspan="2">C</td>
                            <td class="px-2 table-separator" rowspan="2">Cukup</td>
                        </tr>
                        <tr>
                            <td class="px-2">C</td>
                        </tr>
                        <tr>
                            <td class="px-2">D+</td>
                            <td class="px-2 table-separator" rowspan="4">K</td>
                            <td class="px-2 table-separator" rowspan="4">Kurang</td>
                        </tr>
                        <tr>
                            <td class="px-2">D</td>
                        </tr>
                        <tr>
                            <td class="px-2">E</td>
                        </tr>
                        <tr>
                            <td class="px-2">K</td>
                        </tr>
                        <tr>
                            <td class="px-2"><i>NULL</i></td>
                            <td class="px-2 table-separator">N</td>
                            <td class="px-2 table-separator">Nilai Kosong</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
          </div>
        </div>
      </div>
    @endif
@endsection