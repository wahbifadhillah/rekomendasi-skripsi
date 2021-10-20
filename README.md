<h1 align="center">Pengembangan Sistem Informasi Rekomendasi Pemilihan Bidang Skripsi Berdasarkan Nilai Akademik Menggunakan Algoritme Decision Tree C4.5</h1>

## About This App

Secara umum sistem yang dikembangkan dapat memberikan rekomendasi bidang skripsi dengan menggunakan aturan klasifikasi yang didapatkan dari proses mining menggunakan algoritme C4.5. Visualisasi data disajikan kepada pengguna sistem diantaranya, Ketua Program Studi Sistem Informasi dan Ketua Kelompok Jabatan Fungsional  Dosen (KJFD) masing-masing bidang keminatan. Proses data mining untuk memberikan rekomendasi dilakukan menggunakan data latih dan data uji yang terdapat dalam database yang dimasukkan oleh pengguna Ketua Program Studi Sistem Informasi, kemudian hasil dari proses mining data tersebut akan digunakan sebagai aturan klasifikasi untuk memberikan rekomendasi berupa bidang skripsi.

### Key Features
- Data Mining menggunakan algoritme Decision Tree C4.5 dengan library Java Weka.
- Import data mahasiswa (.csv) menggunakan [Laravel-Excel](https://github.com/Maatwebsite/Laravel-Excel).
- Penyajian visualisasi data dashboard menggunakan [Chart.js](https://github.com/chartjs/Chart.js).
- Visualisasi model Decision Tree menggunakan [Viz.js](https://github.com/mdaines/viz.js).
- Interaksi svg model Decision Tree menggunakan [SVG.js](https://github.com/svgdotjs).

### Technology
- SASS
- DBMS PostgresSql
- Vanilla Javascript
- PHP Laravel

## Preview
### Halaman Dashboard
![dashboard-preview](https://github.com/wahbifadhillah/rekomendasi-skripsi/blob/master/github/dashboard.png?raw=true)
### Halaman Dataset
![dataset-preview](https://github.com/wahbifadhillah/rekomendasi-skripsi/blob/master/github/dataset.png?raw=true)
### Halaman Input Dataset
![dataset-input-preview](https://github.com/wahbifadhillah/rekomendasi-skripsi/blob/master/github/dataset-input.png?raw=true)
### Halaman Data Latih
![train-data-preview](https://github.com/wahbifadhillah/rekomendasi-skripsi/blob/master/github/data%20latih.png?raw=true)
### Halaman Data Uji
![testi-data-preview](https://github.com/wahbifadhillah/rekomendasi-skripsi/blob/master/github/data%20uji.png?raw=true)
### Halaman Model Pohon Keputusan
![decision-tree-model-preview](https://github.com/wahbifadhillah/rekomendasi-skripsi/blob/master/github/model%20pohon%20keputusan.png?raw=true)
### Halaman Dapatkan Rekomendasi
![get-recommendation-preview](https://github.com/wahbifadhillah/rekomendasi-skripsi/blob/master/github/dapatkan%20rekomendasi.png?raw=true)