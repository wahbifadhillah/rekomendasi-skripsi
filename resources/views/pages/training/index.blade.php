@extends('pages.training.master')
@section('training')
    @parent
    <div class="row equal-cols mb-4">
        <div class="col-4">
            <div class="boxed">
                <h5 class="mb-3">Bidang Skripsi yang diambil</h5>
                <div class="graph">
                    @if ($training_trainings_bidang)
                        <canvas id="training_trainings_bidang"></canvas>
                        <p class="text-center text-muted">Bidang Skripsi</p>    
                    @else
                        <small>Buat <a href="{{route('admin.dataset.index')}}">data latih dan data uji</a> terlebih dahulu untuk melihat chart.</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="boxed">
                <h5 class="mb-3">Lama Skripsi berdasarkan Bidang Skripsi</h5>
                <div class="graph">
                    @if ($training_trainings_bidang_waktu)    
                        <canvas id="training_trainings_bidang_waktu"></canvas>
                        <p class="text-center text-muted">Lama pengerjaan (bulan)</p>
                    @else
                        <small>Buat <a href="{{route('admin.dataset.index')}}">data latih dan data uji</a> terlebih dahulu untuk melihat chart.</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="boxed">
                <h5>Statistik data latih</h5>
                <table class="table table-sm">
                    <tbody>
                        <tr class="statistic-table-top">
                            <th scope="row" class="pr-1">Jumlah Data</th>
                            <td scope="row" class="px-1">{{$statistics['training']}}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="pr-1">Bidang MDI</th>
                            <td scope="row" class="px-1">{{$statistics['bidang_MDI']}}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="pr-1">Bidang PSI</th>
                            <td scope="row" class="px-1">{{$statistics['bidang_PSI']}}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="pr-1">Bidang SIG</th>
                            <td scope="row" class="px-1">{{$statistics['bidang_SIG']}}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="pr-1">Bidang TKTI</th>
                            <td scope="row" class="px-1">{{$statistics['bidang_TKTI']}}</td>
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
                <th colspan="4" class="table-separator px-4">Data skripsi</th>
                <th colspan="37" class="table-separator px-4">Nilai mata kuliah</th>
            </tr>
            <tr>
                
                <th scope="col" class="sub-table table-separator pl-4 pr-3">Bidang Skripsi</th>
                <th scope="col" class="sub-table px-3">Tanggal Proposal</th>
                <th scope="col" class="sub-table px-3">Tanggal Semhas</th>
                <th scope="col" class="sub-table pl-3 pr-4">Lama Skripsi</th>
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
            @if ($trainings)
                @foreach ($trainings as $training)
                    <tr>
                        <th scope="row" class="table-num pl-3 pr-4">
                            {{($trainings->firstItem() + $loop->index)}}
                        </th>
                        <td class="table-separator pl-4 pr-3">
                            @switch($training->skripsi_bidang)
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
                            {{$training->skripsi_tanggal_proposal}}
                        </td>
                        <td class="px-3">
                            {{$training->skripsi_tanggal_semhas}}
                        </td>
                        <td class="pl-3 pr-3">
                            @php $proposal = new DateTime($training->skripsi_tanggal_proposal); $semhas = new DateTime($training->skripsi_tanggal_semhas); $interval = $semhas->diff($proposal); $days = $interval->format('%a'); $months = floor($days/30);@endphp
                            <span class="badge badge-primary">{{$days}} hari</span> <span class="badge badge-success">{{$months}} bulan</span>
                        </td>
                        <td class="table-separator pl-4 pr-3">{{$training->mk_PGI}}</td>
                        <td class="px-3">{{$training->mk_SIGD1}}</td>
                        <td class="px-3">{{$training->mk_SIGD2}}</td>
                        <td class="px-3">{{$training->mk_SIGL}}</td>
                        <td class="px-3">{{$training->mk_SPK}}</td>
                        <td class="px-3">{{$training->mk_ABD}}</td>
                        <td class="px-3">{{$training->mk_BDT}}</td>
                        <td class="px-3">{{$training->mk_DBD}}</td>
                        <td class="px-3">{{$training->mk_DM}}</td>
                        <td class="px-3">{{$training->mk_DW}}</td>
                        <td class="px-3">{{$training->mk_KB}}</td>
                        <td class="px-3">{{$training->mk_PBD}}</td>
                        <td class="px-3">{{$training->mk_ADSI}}</td>
                        <td class="px-3">{{$training->mk_DPSI}}</td>
                        <td class="px-3">{{$training->mk_IPSI}}</td>
                        <td class="px-3">{{$training->mk_PABW}}</td>
                        <td class="px-3">{{$training->mk_PBPU}}</td>
                        <td class="px-3">{{$training->mk_PPP}}</td>
                        <td class="px-3">{{$training->mk_SE}}</td>
                        <td class="px-3">{{$training->mk_PL}}</td>
                        <td class="px-3">{{$training->mk_DDAP}}</td>
                        <td class="px-3">{{$training->mk_DIAP}}</td>
                        <td class="px-3">{{$training->mk_EPAP}}</td>
                        <td class="px-3">{{$training->mk_EASI}}</td>
                        <td class="px-3">{{$training->mk_MO}}</td>
                        <td class="px-3">{{$training->mk_MITI}}</td>
                        <td class="px-3">{{$training->mk_MLTI}}</td>
                        <td class="px-3">{{$training->mk_MP}}</td>
                        <td class="px-3">{{$training->mk_MPSI}}</td>
                        <td class="px-3">{{$training->mk_MRS}}</td>
                        <td class="px-3">{{$training->mk_MR}}</td>
                        <td class="px-3">{{$training->mk_PPB}}</td>
                        <td class="px-3">{{$training->mk_PSSI}}</td>
                        <td class="px-3">{{$training->mk_TKTI}}</td>
                        <td class="px-3">{{$training->mk_EA}}</td>
                        <td class="px-3">{{$training->mk_SBF}}</td>
                        <td class="px-3">{{$training->mk_MHP}}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <div class="d-flex justify-content-between mt-3">
        <div class="d-flex justify-content-start">
            @if ($trainings)
                <small>Menampilkan {{$trainings->firstItem()}} hingga {{$trainings->perPage()*$trainings->currentPage()}} dari {{$trainings->total()}} data</small>
            @else
                <small>Data latih tidak ditemukan, buat <a href="{{route('admin.dataset.index')}}">data latih dan data uji</a> terlebih dahulu.</small>
            @endif
        </div>
            @if ($trainings)
                <div class="d-flex justify-content-end">{{$trainings->onEachSide(3)->appends($_GET)->links()}}</div>
            @endif
    </div>
    <script>
        // Load Data
        var bidang = JSON.parse(`<?php echo $training_trainings_bidang; ?>`);
        var bidang_waktu = JSON.parse(`<?php echo $training_trainings_bidang_waktu; ?>`);


        // Select Canvas
        var chart_bidang = document.getElementById('training_trainings_bidang');
        var chart_bidang_waktu = document.getElementById('training_trainings_bidang_waktu');


        // Chart Data
        var data_bidang = {
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
                data: bidang
            }]
        }

        var data_bidang_waktu = {
            datasets: [{
                label: 'MDI',
                backgroundColor: 'rgba(255, 159, 64, 0.3)',
                borderColor: 'rgb(255, 159, 64)',
                borderWidth: 1,
                data: bidang_waktu.MDI
            }, {
                label: 'PSI',
                backgroundColor: 'rgba(255, 99, 132, 0.3)',
                borderColor: 'rgb(255, 99, 132)',
                borderWidth: 1,
                data: bidang_waktu.PSI
            }, {
                label: 'SIG',
                backgroundColor: 'rgba(75, 192, 192, 0.3)',
                borderColor: 'rgb(75, 192, 192)',
                borderWidth: 1,
                data: bidang_waktu.SIG
            }, {
                label: 'TKMSI',
                backgroundColor: 'rgba(54, 162, 235, 0.3)',
                borderColor: 'rgb(54, 162, 235)',
                borderWidth: 1,
                data: bidang_waktu.TKMSI
            }]
        }


        // Chart
        var bar_bidang = new Chart(chart_bidang, {
            type: 'bar',
            data: data_bidang,
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

        var bar_bidang_waktu = new Chart(chart_bidang_waktu, {
            type: 'bar',
            data: data_bidang_waktu,
            options: {
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
    </script>
@endsection