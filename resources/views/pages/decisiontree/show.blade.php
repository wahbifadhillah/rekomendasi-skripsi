@extends('pages.decisiontree.master')
@section('decisiontree')
    @parent
    <div class="d-flex justify-content-end mb-3">
        <a href="{{route('admin.recommendation.createbytree', $selected_tree->tree_id)}}" class="btn btn-primary">
            Gunakan model untuk mendapatkan rekomendasi
        </a>
    </div>
    <div class="row mb-4">
        <div class="col-12">
            <div class="boxed">
                <div id="tree_view">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="boxed">
                <h5>Statistik Pohon Keputusan</h5>
                <table class="table table-sm">
                    <tbody>
                        <tr class="statistic-table-top">
                            <th scope="row" class="pr-1">Nama</th>
                            <td colspan="2" scope="row" class="px-1"><span class="badge badge-primary">{{$selected_tree->tree_name}}</span></td>
                        </tr>
                        <tr>
                            <th scope="row" class="pr-1">Data Latih</th>
                            <td colspan="2" scope="row" class="px-1">{{$selected_tree->tree_training_data}}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="pr-1">Data Uji</th>
                            <td colspan="2" scope="row" class="px-1">{{$selected_tree->tree_testing_data}}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="pr-1">Akurasi</th>
                            <td colspan="2" scope="row" class="px-1">{{number_format($selected_tree->tree_accuracy *100, 2)}} %</td>
                        </tr>
                        <tr>
                            <th scope="row" class="pr-1">Ukuran Pohon</th>
                            <td colspan="2" scope="row" class="px-1">{{$selected_tree->tree_size}}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="pr-1">Jumlah Ranting</th>
                            <td colspan="2" scope="row" class="px-1">{{$selected_tree->tree_leaves}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-8">
            <div class="boxed">
                <h5>Aturan Kondisional</h5>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5">{{$selected_tree->tree_rules}}</textarea>
            </div>
        </div>
    </div>
@endsection