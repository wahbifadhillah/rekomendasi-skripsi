@extends('pages.testing.master')
@section('testing')
    @parent
    <div class="row mb-4">
        <div class="col-4">
            <div class="boxed">
                <h5 class="mb-3">Rekomendasi Bidang Skripsi</h5>
                <div class="graph">
                    @if($testings)
                        @if ($testing_testings_rekomendasi)    
                            <canvas id="testing_testings_rekomendasi"></canvas>
                            <p class="text-center text-muted">Rekomendasi Bidang Skripsi</p>
                        @else
                            <small>Latih <a href="{{route('admin.training.index')}}">model</a> terlebih dahulu untuk melihat chart.</small>
                        @endif
                    @else
                        <small>Buat <a href="{{route('admin.dataset.index')}}">data latih dan data uji</a> terlebih dahulu untuk melihat chart.</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="boxed">
                <h5 class="mb-3">Rekomendasi berdasarkan Bidang Skripsi</h5>
                <div class="graph">
                    @if($testings)
                        @if ($testing_testings_bidang_rekomendasi)    
                            <canvas id="testing_testings_bidang_rekomendasi"></canvas>
                            <p class="text-center text-muted">Bidang Skripsi</p>
                            @else
                            <small>Latih <a href="{{route('admin.training.index')}}">model</a> terlebih dahulu untuk melihat chart.</small>
                        @endif
                    @else
                        <small>Buat <a href="{{route('admin.dataset.index')}}">data latih dan data uji</a> terlebih dahulu untuk melihat chart.</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="boxed">
                <h5>Statistik data uji</h5>
                <table class="table table-sm">
                    <tbody>
                        <tr class="statistic-table-top">
                            <th scope="row" class="pr-1">Jumlah Data</th>
                            <td scope="row" class="px-1">{{$statistics['testing']}}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="pr-1">Rekomendasi Sama</th>
                            <td scope="row" class="px-1">{{$statistics['rekomendasi_sama']}}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="pr-1">Rekomendasi Tidak Sama</th>
                            <td scope="row" class="px-1">{{$statistics['rekomendasi_tidak_sama']}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <table class="table table-sm data-table">
        <thead>
            <tr>
                <th rowspan="2" style="vertical-align: middle !important;" class="text-center pl-3 pr-4">#</th>
                <th colspan="2" class="table-separator px-4">Data skripsi</th>
                <th colspan="37" class="table-separator px-4">Nilai mata kuliah</th>
            </tr>
            <tr>
                
                <th scope="col" class="sub-table table-separator pl-4 pr-3">Bidang Skripsi</th>
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
            @if ($testings)
                @foreach ($testings as $testing)
                    <tr>
                        <th scope="row" class="table-num pl-3 pr-4">
                            {{($testings->firstItem() + $loop->index)}}
                        </th>
                        @php $pageCount = $testings->firstItem() + $loop->index @endphp
                        <td class="table-separator pl-4 pr-3">
                            @switch($testing->skripsi_bidang)
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
                        <td class="pl-3 pr-3">
                            @php
                                $is_match = $testing->skripsi_bidang == $testing->skripsi_bidang_rekomendasi ? TRUE:FALSE;
                            @endphp
                            @if ($testing->skripsi_bidang_rekomendasi)
                                @switch($testing->skripsi_bidang_rekomendasi)
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
                                <small><a href="{{route('admin.training.index')}}">Latih model</a> terlebih dahulu</small>
                            @endif
                        </td>
                        <td class="table-separator pl-4 pr-3">{{$testing->mk_PGI}}</td>
                        <td class="px-3">{{$testing->mk_SIGD1}}</td>
                        <td class="px-3">{{$testing->mk_SIGD2}}</td>
                        <td class="px-3">{{$testing->mk_SIGL}}</td>
                        <td class="px-3">{{$testing->mk_SPK}}</td>
                        <td class="px-3">{{$testing->mk_ABD}}</td>
                        <td class="px-3">{{$testing->mk_BDT}}</td>
                        <td class="px-3">{{$testing->mk_DBD}}</td>
                        <td class="px-3">{{$testing->mk_DM}}</td>
                        <td class="px-3">{{$testing->mk_DW}}</td>
                        <td class="px-3">{{$testing->mk_KB}}</td>
                        <td class="px-3">{{$testing->mk_PBD}}</td>
                        <td class="px-3">{{$testing->mk_ADSI}}</td>
                        <td class="px-3">{{$testing->mk_DPSI}}</td>
                        <td class="px-3">{{$testing->mk_IPSI}}</td>
                        <td class="px-3">{{$testing->mk_PABW}}</td>
                        <td class="px-3">{{$testing->mk_PBPU}}</td>
                        <td class="px-3">{{$testing->mk_PPP}}</td>
                        <td class="px-3">{{$testing->mk_SE}}</td>
                        <td class="px-3">{{$testing->mk_PL}}</td>
                        <td class="px-3">{{$testing->mk_DDAP}}</td>
                        <td class="px-3">{{$testing->mk_DIAP}}</td>
                        <td class="px-3">{{$testing->mk_EPAP}}</td>
                        <td class="px-3">{{$testing->mk_EASI}}</td>
                        <td class="px-3">{{$testing->mk_MO}}</td>
                        <td class="px-3">{{$testing->mk_MITI}}</td>
                        <td class="px-3">{{$testing->mk_MLTI}}</td>
                        <td class="px-3">{{$testing->mk_MP}}</td>
                        <td class="px-3">{{$testing->mk_MPSI}}</td>
                        <td class="px-3">{{$testing->mk_MRS}}</td>
                        <td class="px-3">{{$testing->mk_MR}}</td>
                        <td class="px-3">{{$testing->mk_PPB}}</td>
                        <td class="px-3">{{$testing->mk_PSSI}}</td>
                        <td class="px-3">{{$testing->mk_TKTI}}</td>
                        <td class="px-3">{{$testing->mk_EA}}</td>
                        <td class="px-3">{{$testing->mk_SBF}}</td>
                        <td class="px-3">{{$testing->mk_MHP}}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <div class="d-flex justify-content-between mt-3">
        <div class="d-flex justify-content-start">
            @if ($testings)
                <small>Menampilkan {{$testings->firstItem()}} hingga {{$testings->perPage()*$testings->currentPage()}} dari {{$testings->total()}} data</small>
            @else
                <small>Data uji tidak ditemukan, buat <a href="{{route('admin.dataset.index')}}">data latih dan data uji</a> terlebih dahulu.</small>
            @endif
        </div>
            @if ($testings)
                <div class="d-flex justify-content-end">{{$testings->onEachSide(3)->appends($_GET)->links()}}</div>
            @endif
    </div>
    <script>
        // Load Data
        var bidang_rekomendasi = JSON.parse(`<?php echo $testing_testings_bidang_rekomendasi; ?>`);
        var rekomendasi = JSON.parse(`<?php echo $testing_testings_rekomendasi; ?>`);


        // Select Canvas
        var chart_bidang_rekomendasi = document.getElementById('testing_testings_bidang_rekomendasi');
        var chart_rekomendasi = document.getElementById('testing_testings_rekomendasi');


        // Chart Data
        var data_bidang_rekomendasi = {
            datasets: [{
                label: 'Rekomendasi MDI',
                backgroundColor: 'rgba(255, 159, 64, 0.3)',
                borderColor: 'rgb(255, 159, 64)',
                borderWidth: 1,
                data: bidang_rekomendasi.MDI
            }, {
                label: 'Rekomendasi PSI',
                backgroundColor: 'rgba(255, 99, 132, 0.3)',
                borderColor: 'rgb(255, 99, 132)',
                borderWidth: 1,
                data: bidang_rekomendasi.PSI
            }, {
                label: 'Rekomendasi SIG',
                backgroundColor: 'rgba(75, 192, 192, 0.3)',
                borderColor: 'rgb(75, 192, 192)',
                borderWidth: 1,
                data: bidang_rekomendasi.SIG
            }, {
                label: 'Rekomendasi TKMSI',
                backgroundColor: 'rgba(54, 162, 235, 0.3)',
                borderColor: 'rgb(54, 162, 235)',
                borderWidth: 1,
                data: bidang_rekomendasi.TKMSI
            }]
        };

        var data_rekomendasi = {
            datasets: [{
                label: false,
                backgroundColor: [
                    'rgba(255, 159, 64, 0.3)',
                    'rgba(255, 99, 132, 0.3)',
                    'rgba(75, 192, 192, 0.3)',
                    'rgba(54, 162, 235, 0.3)',
                ],
                borderColor: [
                    'rgb(255, 159, 64)',
                    'rgb(255, 99, 132)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                ],
                borderWidth: 1,
                data: rekomendasi
            }]
        }


        // Chart
        var bar_bidang_rekomendasi = new Chart(chart_bidang_rekomendasi, {
            type: 'bar',
            data: data_bidang_rekomendasi,
            options: {
                // responsiveAnimationDuration: 1800,
                barValueSpacing: 20,
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                yAxes: [{
                    ticks: {
                    min: 0,
                    }
                }]
                }
            }
        });

        var bar_rekomendasi = new Chart(chart_rekomendasi, {
            type: 'bar',
            data: data_rekomendasi,
            options: {
                barValueSpacing: 20,
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                       display: false
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                        min: 0,
                        }
                    }]
                }
            }
        });
    </script>
@endsection