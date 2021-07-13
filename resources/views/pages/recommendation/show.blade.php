@extends('pages.recommendation.master')
@section('recommendation')
    @parent
    <div class="row">
        <div class="col-12">
            <div class="boxed">
                <h4>Hasil Rekomendasi</h4>
                
                <span>Mahasiswa dengan NIM <span class='badge badge-primary'>{{$recommendation->NIM}}</span>, berdasarkan tingkat kompetensi akademik sebagai berikut:</span>
                <div class="mt-4">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                            <th scope="col" class="pl-2 pr-3">Keterangan Nilai</th>
                            <th scope="col" class="pl-3 pr-2 table-separator">Mata Kuliah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <th scope="row" class="pl-2 pr-3">Sangat Baik</th>
                            <td class="pl-3 pr-2 table-separator">
                                @foreach ($ggrade['Sangat Baik'] as $mk)
                                    <span class='badge badge-secondary mx-1'>{{$mk}} </span>
                                @endforeach
                            </td>
                            </tr>
                            <tr>
                            <th scope="row" class="pl-2 pr-3">Baik</th>
                            <td class="pl-3 pr-2 table-separator">
                                @foreach ($ggrade['Baik'] as $mk)
                                    <span class='badge badge-secondary mx-1'>{{$mk}} </span>
                                @endforeach
                            </td>
                            </tr>
                            <tr>
                            <th scope="row" class="pl-2 pr-3">Cukup</th>
                            <td class="pl-3 pr-2 table-separator">
                                @foreach ($ggrade['Cukup'] as $mk)
                                    <span class='badge badge-secondary mx-1'>{{$mk}} </span>
                                @endforeach
                            </td>
                            </tr>
                            <tr>
                            <th scope="row" class="pl-2 pr-3">Kurang</th>
                            <td class="pl-3 pr-2 table-separator">
                                @foreach ($ggrade['Kurang'] as $mk)
                                    <span class='badge badge-secondary mx-1'>{{$mk}} </span>
                                @endforeach
                            </td>
                            </tr>
                            <tr>
                            <th scope="row" class="pl-2 pr-3">Tidak mengambil</th>
                            <td class="pl-3 pr-2 table-separator">
                                @foreach ($ggrade['Tidak Ada'] as $mk)
                                    <span class='badge badge-secondary mx-1'>{{$mk}} </span>
                                @endforeach
                            </td>
                            </tr>
                        </tbody>
                    </table>
                    
                </div>
                <p class="lead">Maka rekomendasi bidang skripsi yang diberikan oleh sistem adalah <span class="badge badge-success">{{$recommendation->skripsi_bidang_rekomendasi}}</span>. Untuk mendapatkan wawasan terhadap bidang skripsi, berikut list judul skripsi pada bidang <span class="badge badge-success">{{$recommendation->skripsi_bidang_rekomendasi}}</p>
            </div>
        </div>
    </div>
    <table class="table table-sm mt-4">
        <thead>
            <tr>
                <th scope="col" class="text-center pl-3 pr-4">#</th>
                <th scope="col" class="pl-4 pr-3 table-separator">Judul Skripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($researches as $research)
                <tr>
                    <th scope="row" class="table-num text-center pl-3 pr-4">
                        {{($researches->firstItem() + $loop->index)}}
                        @php $pageCount = $researches->firstItem() + $loop->index @endphp
                    </th>
                    <td class="pl-4 pr-3 table-separator">{{$research->skripsi_judul}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-between mt-3">
        <div class="d-flex justify-content-start">
            <small>Menampilkan {{$researches->firstItem()}} hingga {{$researches->perPage()*$researches->currentPage()}} dari {{$researches->total()}} data</small>
        </div>
        <div class="d-flex justify-content-end">{{$researches->onEachSide(3)->appends($_GET)->links()}}</div>
    </div>
    @if (Session::has('pp_success'))
    <div class="modal fade" id="pre-process" tabindex="-1" aria-labelledby="pre-processLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pre-processLabel">Pre-processing nilai akademik mahasiswa</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <p>Nilai mata kuliah telah di pre-processing dengan ketentuan sebagai berikut:</p>
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
                            <td class="px-2 table-separator">Nilai Kosong/ Tidak mengambil Matkul</td>
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