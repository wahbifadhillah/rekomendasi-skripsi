@extends('pages.dataset.master')
@section('dataset')
{{-- @if ($info)    
<div class="row mb-4">
    <div class="col-12">
        <div class="boxed">
            <h5>Informasi File</h5>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi dolor dolorum consequatur nemo molestiae cum quae doloremque id nulla! Alias in iusto rem sunt. Porro dolorum minima at quaerat praesentium.
            </p>
            <div class="d-flex justify-content-end mt-4">
                <a href="{{route('admin.dataset.index')}}" class="btn btn-primary">Kembali ke halaman dataset</a>
            </div>
        </div>
    </div>
</div>
@endif --}}
<form action="{{route('admin.dataset.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <h5>Pilih file dengan format .csv</h5>
    <div class="input-group">
        <div class="custom-file">
            <input type="file" class="custom-file-input" name="csv_dataset" id="csv_dataset" aria-describedby="inputGroupFileAddon04">
            <label class="custom-file-label" for="csv_dataset">Choose file</label>
        </div>
        <div class="input-group-append">
            <input type="submit" class="btn btn-primary" type="button" value="Unggah">
        </div>
    </div>
</form>
<div class="row mt-4">
    <div class="col-12">
        <div class="boxed">
            <h5 class="mb-3">Contoh struktur file .csv</h5>
            <table class="table table-sm">
                <tbody>
                    <tr class="statistic-table-top">
                        <th scope="row" class="px-3">Table Header</th>
                        <td scope="row" class="px-3"><span class="badge badge-danger">No</span></td>
                        <th scope="row" class="px-3 table-separator">Separator</th>
                        <td scope="row" class="px-3"><span class="badge badge-primary">,</span> / <span class="badge badge-primary">Comma</span></td>
                        <th scope="row" class="px-3 table-separator">Data Separator</th>
                        <td scope="row" class="px-3"><span class="badge badge-primary">" "</span> / <span class="badge badge-primary">Block-quotes</span></td>
                        <th scope="row" class="px-3 table-separator">NULL Data Format</th>
                        <td scope="row" class="px-3"><span class="badge badge-danger">NULL</span></td>
                    </tr>
                </tbody>
            </table>
            <textarea class="form-control mb-5" id="exampleFormControlTextarea1" rows="5">"165150407111001","Analisis Sentimen Opini Pelanggan Terhadap Aspek Pariwisata Pantai Malang Selatan Menggunakan TF-IDF Dan Support Vector Machine","2020","Manajemen Data & Informasi",NULL,"2020-01-16","2020-05-16",NULL,"A",NULL,NULL,"A","B+",NULL,"B","B","B+","B+","C+","B+","B+","B","B",NULL,NULL,"A","B","D+","A","A","A","A","B","B","B","A","B","C+","D","B","B+","A","C+","C+",NULL,NULL</textarea>
            <h5>Spesifikasi Data</h5>
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th scope="col" class="pl-3 pr-4">#</th>
                        <th scope="col" class="pl-4 pr-3 table-separator">Nama Kolom</th>
                        <th scope="col" class="px-3">Spesifikasi & Limit</th>
                        <th scope="col" class="px-3">Contoh Data</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><th scope="row" class="table-num pl-3 pr-4">1</th><td scope="row" class="table-num pl-4 pr-3 table-separator">NIM</td><td scope="row" class="table-num px-3">Varchar (15)</td>
                        <td scope="row" class="table-num px-3">165150407111001</td></tr>
                    <tr><th scope="row" class="table-num pl-3 pr-4">2</th><td scope="row" class="table-num pl-4 pr-3 table-separator">Judul Skripsi</td><td scope="row" class="table-num px-3">Varchar (255)</td>
                        <td scope="row" class="table-num px-3">Analisis Sentimen Opini Pelanggan Terhadap Aspek Pariwisata Pantai Malang Selatan Menggunakan TF-IDF Dan Support Vector Machine</td></tr>
                    <tr><th scope="row" class="table-num pl-3 pr-4">3</th><td scope="row" class="table-num pl-4 pr-3 table-separator">Tahun Skripsi</td><td scope="row" class="table-num px-3">Int (11)</td>
                        <td scope="row" class="table-num px-3">2020</td></tr>
                    <tr><th scope="row" class="table-num pl-3 pr-4">4</th><td scope="row" class="table-num pl-4 pr-3 table-separator">Bidang Skripsi</td><td scope="row" class="table-num px-3">Varchar (50)</td>
                        <td scope="row" class="table-num px-3">Manajemen Data & Informasi</td></tr>
                    <tr><th scope="row" class="table-num pl-3 pr-4">5</th><td scope="row" class="table-num pl-4 pr-3 table-separator">Rekomendasi Bidang Skripsi</td><td scope="row" class="table-num px-3">Varchar (50) <i>NULLABLE</i></td>
                        <td scope="row" class="table-num px-3"><i>NULL</i></td></tr>
                    <tr><th scope="row" class="table-num pl-3 pr-4">6</th><td scope="row" class="table-num pl-4 pr-3 table-separator">Tanggal Proposal</td><td scope="row" class="table-num px-3">Date (Y-M-d)</td>
                        <td scope="row" class="table-num px-3">2020-01-16</td></tr>
                    <tr><th scope="row" class="table-num pl-3 pr-4">7</th><td scope="row" class="table-num pl-4 pr-3 table-separator">Tanggal Semhas</td><td scope="row" class="table-num px-3">Date (Y-M-d)</td>
                        <td scope="row" class="table-num px-3">2020-05-16</td></tr>
                    <tr><th scope="row" class="table-num pl-3 pr-4">8-44</th><td scope="row" class="table-num pl-4 pr-3 table-separator">mk_</td><td scope="row" class="table-num px-3">Varchar (4)</td>
                        <td scope="row" class="table-num px-3">A</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection