@extends('pages.dataset.index')
@section('datatable')
    
<table class="table align-middle">
    <thead class="align-middle">
        <tr>
            <th scope="col" rowspan="2" class="text-center">#</th>
            <th scope="col" colspan="2">Data skripsi</th>
            <th scope="col" colspan="36">Nilai mata kuliah</th>
        </tr>
        <tr>
            <th scope="col">Tahun Skripsi</th>
            <th scope="col">Bidang Skripsi</th>
            <th scope="col">PGI</th>
            <th scope="col">SIGD1</th>
            <th scope="col">SIGD2</th>
            <th scope="col">SIGL</th>
            <th scope="col">SPK</th>
            <th scope="col">ABD</th>
            <th scope="col">BDT</th>
            <th scope="col">DBD</th>
            <th scope="col">DM</th>
            <th scope="col">DW</th>
            <th scope="col">KB</th>
            <th scope="col">PBD</th>
            <th scope="col">ADSI</th>
            <th scope="col">DPSI</th>
            <th scope="col">IPSI</th>
            <th scope="col">PABW</th>
            <th scope="col">PBPU</th>
            <th scope="col">PPP</th>
            <th scope="col">SE</th>
            <th scope="col">PL</th>
            <th scope="col">DDAP</th>
            <th scope="col">DIAP</th>
            <th scope="col">EPAP</th>
            <th scope="col">EASI</th>
            <th scope="col">MO</th>
            <th scope="col">MITI</th>
            <th scope="col">MLTI</th>
            <th scope="col">MP</th>
            <th scope="col">MPSI</th>
            <th scope="col">MRS</th>
            <th scope="col">MR</th>
            <th scope="col">PPB</th>
            <th scope="col">PSSI</th>
            <th scope="col">TKTI</th>
            <th scope="col">EA</th>
            <th scope="col">SBF</th>
            <th scope="col">MHP</th>
        </tr>
    </thead>

    <tbody>
        {{-- @if ($trainings)
            @foreach ($trainings as $training) --}}
                <tr>
                    <th scope="row" class="table-num">
                        {{-- {{($trainings->firstItem() + $loop->index)}} --}}
                    </th>
                    {{-- @php $pageCount = $trainings->firstItem() + $loop->index @endphp --}}
                    <td>
                        {{-- {{$training->skripsi_tahun}} --}}
                    </td>
                    <td>
                        {{-- @switch($training->skripsi_bidang)
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
                        @endswitch --}}
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    {{-- <td>{{$training->PGI}}</td>
                    <td>{{$training->SIGD1}}</td>
                    <td>{{$training->SIGD2}}</td>
                    <td>{{$training->SIGL}}</td>
                    <td>{{$training->SPK}}</td>
                    <td>{{$training->ABD}}</td>
                    <td>{{$training->BDT}}</td>
                    <td>{{$training->DBD}}</td>
                    <td>{{$training->DM}}</td>
                    <td>{{$training->DW}}</td>
                    <td>{{$training->KB}}</td>
                    <td>{{$training->PBD}}</td>
                    <td>{{$training->ADSI}}</td>
                    <td>{{$training->DPSI}}</td>
                    <td>{{$training->IPSI}}</td>
                    <td>{{$training->PABW}}</td>
                    <td>{{$training->PBPU}}</td>
                    <td>{{$training->PPP}}</td>
                    <td>{{$training->SE}}</td>
                    <td>{{$training->PL}}</td>
                    <td>{{$training->DDAP}}</td>
                    <td>{{$training->DIAP}}</td>
                    <td>{{$training->EPAP}}</td>
                    <td>{{$training->EASI}}</td>
                    <td>{{$training->MO}}</td>
                    <td>{{$training->MITI}}</td>
                    <td>{{$training->MLTI}}</td>
                    <td>{{$training->MP}}</td>
                    <td>{{$training->MPSI}}</td>
                    <td>{{$training->MRS}}</td>
                    <td>{{$training->MR}}</td>
                    <td>{{$training->PPB}}</td>
                    <td>{{$training->PSSI}}</td>
                    <td>{{$training->TKTI}}</td>
                    <td>{{$training->EA}}</td>
                    <td>{{$training->SBF}}</td>
                    <td>{{$training->MHP}}</td> --}}
                </tr>
            {{-- @endforeach
        @endif --}}
    </tbody>
</table>
@endsection