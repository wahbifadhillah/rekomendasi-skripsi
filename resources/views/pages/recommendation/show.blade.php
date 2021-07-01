@extends('pages.recommendation.master')
@section('recommendation')
    @parent
    <div class="row">
        <div class="col-12">
            <div class="boxed">
                <h4>Hasil Rekomendasi</h4>
                <p class="lead">
                    Berdasarkan mata kuliah yang telah diambil, rekomendasi bidang skripsi yang diberikan oleh sistem adalah <span class="badge badge-primary">{{$recommendation->skripsi_bidang_rekomendasi}}</span>. Untuk mendapatkan wawasan terhadap bidang skripsi, berikut list judul skripsi pada bidang <span class="badge badge-primary">{{$recommendation->skripsi_bidang_rekomendasi}}</span>.
                </p>
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
@endsection