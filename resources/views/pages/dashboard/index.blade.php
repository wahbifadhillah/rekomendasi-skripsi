@extends('pages.dashboard.master')
@section('filters')
    @parent
    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.dashboard.index')}}" method="GET">
                <input type="hidden" name="filter">
                <div class="input-group mb-4">
                    <select class="custom-select" name="angkatan" id="angkatan">
                        <option value="semua_angkatan" {{request()->query('angkatan') == 'semua_angkatan' ? 'selected':''}}>Semua Angkatan</option>
                        @foreach ($filters['angkatan'] as $angkatan)
                            <option value="{{$angkatan}}" {{request()->query('angkatan') == $angkatan ? 'selected':''}}>{{$angkatan}}</option>
                        @endforeach
                    </select>
                    <select  class="custom-select" name="lama_pengerjaan" id="lama_pengerjaan">
                        <option value="semua_lama_pengerjaan" {{request()->query('lama_pengerjaan') == 'semua_lama_pengerjaan' ? 'selected':''}}>Semua Waktu Pengerjaan</option>
                        @foreach ($filters['lama_skripsi'] as $lama_skripsi)
                            <option value="{{$lama_skripsi}}" {{request()->query('lama_pengerjaan') == $lama_skripsi ? 'selected':''}}>{{$lama_skripsi}} bulan</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <input type="submit" class="btn btn-primary" type="button"  value="Tampilkan">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('dashboard')
    @parent
    <div class="row equal-cols mb-3">
        <div class="col-5">
            <div class="boxed">
                <h5 class="mb-3">Rekomendasi berdasarkan Bidang Skripsi</h5>
                <div class="graph">
                    {{-- if use model = 0 --}}
                    @if ($dashboard_datasets_bidang_rekomendasi)
                        <canvas id="dashboard_datasets_bidang_rekomendasi"></canvas>
                        <p class="text-center text-muted">Bidang Skripsi</p>
                    @else
                        <small>Aplikasikan <a href="{{route('admin.dataset.index')}}">model pada dataset</a> terlebih dahulu untuk melihat chart.</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-5">
            <div class="boxed">
                <h5 class="mb-3">Lama Skripsi berdasarkan Rekomendasi</h5>
                <div class="graph">
                    @if ($dashboard_datasets_bidang_rekomendasi_waktu)    
                        <canvas id="dashboard_datasets_bidang_rekomendasi_waktu"></canvas>
                        <p class="text-center text-muted">Lama pengerjaan (bulan)</p>
                    @else
                        <small>Aplikasikan <a href="{{route('admin.dataset.index')}}">model pada dataset</a> terlebih dahulu untuk melihat chart.</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-2">
            <div class="row">
                <div class="col-12">
                    <div class="boxed">
                        <h5>Akurasi model pohon keputusan aktif</h5>
                        @if ($tree_accuracy)
                            <h2>{{$tree_accuracy}} %</h2>
                        @else
                            <small>Model tidak ditemukan, latih dan buat <a href="{{route('admin.training.index')}}">model pohon keputusan</a> terlebih dahulu.</small>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="boxed">
                        <h5>Statistik data</h5>
                        <table class="table table-sm">
                            <tbody>
                                <tr class="statistic-table-top">
                                    <th scope="row" class="pr-1">Dataset</th>
                                    <td scope="row" class="px-1">{{$statistics['dataset']}}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="pr-1">Data Latih</th>
                                    <td scope="row" class="px-1">{{$statistics['training']}}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="pr-1">Data Uji</th>
                                    <td scope="row" class="px-1">{{$statistics['testing']}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-sm">
        <thead>
            <tr>
                <th rowspan="2" style="vertical-align: middle !important;" class="text-center px-3">#</th>
                <th rowspan="2" style="vertical-align: middle !important;" class="pl-3 pr-4">Angkatan</th>
                <th colspan="37" class="table-separator px-4">Data skripsi</th>
            </tr>
            <tr>
                <th scope="col" class="sub-table table-separator pl-4 pr-3">Tahun Skripsi</th>
                <th scope="col" class="sub-table px-3">Bidang Skripsi</th>
                <th scope="col" class="sub-table px-3">Rekomendasi</th>
                <th scope="col" class="sub-table px-3">Lama Skripsi</th>
                <th scope="col" class="sub-table px-3">Judul Skripsi</th>
            </tr>
        </thead>
    
        <tbody>
            
            @if ($datasets)
                @foreach ($datasets as $dataset)
                    <tr>
                        <th scope="row" class="table-num px-3">
                            {{($datasets->firstItem() + $loop->index)}}
                        </th>
                        <td class="pl-3 pr-4">
                            {{'20'.substr($dataset->NIM, 0, 2)}}
                        </td>
                        <td class="table-separator pl-4 pr-3">
                            {{$dataset->skripsi_tahun}}
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
                        <td class="px-3">
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
                        <td class="px-3">
                            @php $proposal = new DateTime($dataset->skripsi_tanggal_proposal); $semhas = new DateTime($dataset->skripsi_tanggal_semhas); $interval = $semhas->diff($proposal); $days = $interval->format('%a'); $months = floor($days/30);@endphp
                            @if ($months <= 6)
                                <span class="badge badge-success">{{$months}} bulan</span>
                            @else
                                <span class="badge badge-danger">{{$months}} bulan</span>
                            @endif
                        </td>
                        <td class="pl-3 pr-4">
                            {{$dataset->skripsi_judul}}
                        </td>
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
    <script>
        // Load Data
        var bidang_rekomendasi = JSON.parse(`<?php echo $dashboard_datasets_bidang_rekomendasi; ?>`);
        var bidang_rekomendasi_waktu = JSON.parse(`<?php echo $dashboard_datasets_bidang_rekomendasi_waktu; ?>`);


        // Select Canvas
        var chart_bidang_rekomendasi = document.getElementById('dashboard_datasets_bidang_rekomendasi');
        var chart_bidang_rekomendasi_waktu = document.getElementById('dashboard_datasets_bidang_rekomendasi_waktu');


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

        var data_bidang_rekomendasi_waktu = {
            datasets: [{
                label: 'Rekomendasi Sama',
                backgroundColor: 'rgba(54, 162, 235, 0.3)',
                borderColor: 'rgb(54, 162, 235)',
                borderWidth: 1,
                data: bidang_rekomendasi_waktu['Rekomendasi sama']
            }, {
                label: 'Rekomendasi Berbeda',
                backgroundColor: 'rgba(255, 99, 132, 0.3)',
                borderColor: 'rgb(255, 99, 132)',
                borderWidth: 1,
                data: bidang_rekomendasi_waktu['Rekomendasi berbeda']
            }]
        };


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

        var bar_bidang_rekomendasi_waktu = new Chart(chart_bidang_rekomendasi_waktu, {
            type: 'bar',
            data: data_bidang_rekomendasi_waktu,
            options: {
                barValueSpacing: 20,
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                yAxes: [{
                    ticks: {
                        min: 0,
                    },
                }]
                }
            }
        });
    </script>
@endsection