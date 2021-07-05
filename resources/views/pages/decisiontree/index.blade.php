@extends('pages.decisiontree.master')
@section('decisiontree')
    @parent
    @php($route_prefix = NULL)
    @if (auth()->user()->role == 'kaprodi')
        @php($route_prefix = 'admin')
    @else
        @php($route_prefix = 'kjfd')
    @endif
    @if ($selected_tree)
        <div class="d-flex justify-content-end mb-3">
            <a href="{{route($route_prefix.'.recommendation.createbytree', $selected_tree->tree_id)}}" class="btn btn-primary">
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
    @endif
    
    <div class="row {{$selected_tree ? 'mt-5':'mt-2'}}">
        <div class="col-12">
            @if ($selected_tree)
                <h4 class="mb-3">Sejarah Model Pohon Keputusan</h4>
            @else
                
            @endif
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th rowspan="2" style="vertical-align: middle !important;" class="text-center px-3">#</th>
                        <th colspan="2" class="table-separator px-4">Data yang digunakan</th>
                        <th colspan="4" class="table-separator px-4">Statistik model pohon keputusan</th>
                    </tr>
                    <tr>
                        <th scope="col" class="sub-table table-separator pl-4 pr-3">Data Latih</th>
                        <th scope="col" class="sub-table px-3">Data Uji</th>
                        <th scope="col" class="sub-table table-separator pl-4 pr-3">Nama model</th>
                        <th scope="col" class="sub-table px-3">Akurasi</th>
                        <th scope="col" class="sub-table px-3">Ukuran Pohon</th>
                        <th scope="col" class="sub-table px-3">Jumlah Ranting</th>
                    </tr>
                </thead>
            
                <tbody>
                    @if ($trees)
                        @foreach ($trees as $tree)
                            <tr>
                                <th scope="row" class="table-num px-3">
                                    {{($trees->firstItem() + $loop->index)}}
                                </th>
                                <td class="pl-4 pr-3">
                                    {{$tree->tree_training_data}}
                                </td>
                                <td class="px-3">
                                    {{$tree->tree_testing_data}}
                                </td>
                                <td class="pl-4 pr-3 table-separator">
                                    {{-- View tree --}}
                                    <a href="{{route($route_prefix.'.decisiontree.show', $tree->tree_id)}}">
                                        {{$tree->tree_name}}
                                    </a>
                                </td>
                                <td class="px-3">
                                    {{number_format($tree->tree_accuracy *100, 2)}} %
                                </td>
                                <td class="px-3">
                                    {{$tree->tree_size}}
                                </td>
                                <td class="px-3">
                                    {{$tree->tree_leaves}}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            <div class="d-flex justify-content-between mt-3">
                <div class="d-flex justify-content-start">
                    @if ($trees)
                        <small>Menampilkan {{$trees->firstItem()}} hingga {{$trees->perPage()*$trees->currentPage()}} dari {{$trees->total()}} data</small>
                    @elseif ($selected_tree)
                        <small>Data model pohon keputusan terbaru sedang ditampilkan..</small>
                    @elseif (!$trees)
                        @if(auth()->user()->role == 'kaprodi')
                            <small>Data tidak ditemukan, latih dan buat <a href="{{route($route_prefix.'.training.index')}}">model pohon keputusan</a> terlebih dahulu.</small>
                        @else
                            <small>Model pohon keputusan belum dilatih oleh admin.</small>
                        @endif
                    @endif
                </div>
                    @if ($trees)
                        <div class="d-flex justify-content-end">{{$trees->onEachSide(3)->appends($_GET)->links()}}</div>
                    @endif
            </div>
        </div>
    </div>
@endsection