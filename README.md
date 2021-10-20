<h1 align="center">Pengembangan Sistem Informasi Rekomendasi Pemilihan Bidang Skripsi Berdasarkan Nilai Akademik Menggunakan Algoritme Decision Tree C4.5</h1>

## About This App

Berdasarkan data skripsi mahasiswa prodi SI angkatan 2014-2015 yang dihimpun dari PSIK didapatkan 42 persen mahasiswa tidak dapat menyelesaikan skripsi dengan tepat waktu. Saat ini prodi SI belum memiliki rangkaian mata kuliah yang mengacu pada keminatan khusus, tetapi berdasarkan data yang didapatkan dari PSIK FILKOM terdapat data bidang skripsi yang mengarahkan mahasiswa pada bidang keahlian tertentu. Karena belum adanya serangkaian mata kuliah yang mengacu pada keminatan khusus ini, maka perlu untuk dicari tahu apakah terdapat mata kuliah yang memiliki hubungan dengan bidang skripsi serta kesesuaianya dengan lama pengerjaan skripsi. Sehingga dibutuhkan sistem yang dapat menemukan pola data tersebut. Salah satu solusinya adalah menggunakan algoritme klasifikasi data mining. Pada penelitian ini akan mengimplementasikan sistem rekomendasi bidang skripsi berbasis web menggunakan Weka untuk memberikan rekomendasi bidang skripsi kepada mehasiswa melalui Ketua Program Studi Sistem Informasi atau Koordinator Kelompok Jabatan Fungsional Dosen masing-masing bidang pada Fakultas Ilmu Komputer Universitas Brawijaya. Terdapat 4 kelas rekomendasi bidang skripsi yaitu Manajemen Data dan Informasi (1), Pengembangan Sistem Informasi (2), Sistem Informasi Geografis (3), dan Tata Kelola dan Manajemen Sistem Informasi (4). Klasifikasi dilakukan menggunakan algoritme Decision Tree C4.5. Dataset yang digunakan adalah gabungan antara data skripsi mahasiswa dan data akademik mahasiswa yang disediakan oleh kaprodi SI. Dataset yang digunakan untuk melakukan proses training adalah data dengan rentang waktu tanggal pengajuan proposal hingga tanggal semhas adalah kurang dari sama dengan 180 hari, sedangkan data yang digunakan untuk proses testing adalah data dengan rentang waktu lebih dari 180 hari. Hasil dari penelitian ini adalah sebuah sistem yang dapat memberikan rekomendasi bidang skripsi dan dashboard untuk mengetahui pola data skripsi yang ada pada prodi SI. Sistem di implementasi menggunakan Laravel sedangkan implementasi proses mining menggunakan Weka.

## Deskripsi Umum Sistem

Dalam penelitian ini, secara umum sistem yang dikembangkan dapat memberikan rekomendasi bidang skripsi dengan menggunakan aturan klasifikasi yang didapatkan dari proses mining menggunakan algoritme C4.5. Visualisasi data disajikan kepada pengguna sistem diantaranya, Ketua Program Studi Sistem Informasi dan Ketua Kelompok Jabatan Fungsional  Dosen (KJFD) masing-masing bidang keminatan. Proses data mining untuk memberikan rekomendasi dilakukan menggunakan data latih dan data uji yang terdapat dalam database yang dimasukkan oleh pengguna Ketua Program Studi Sistem Informasi, kemudian hasil dari proses mining data tersebut akan digunakan sebagai aturan klasifikasi untuk memberikan rekomendasi berupa bidang skripsi.

### Fitur Utama
- Data Mining menggunakan algoritme Decision Tree C4.5 dengan library Java Weka.
- Import data mahasiswa (.csv) menggunakan [Laravel-Excel](https://github.com/Maatwebsite/Laravel-Excel).
- Penyajian visualisasi data dashboard menggunakan[Chart.js](https://github.com/chartjs/Chart.js).
- Visualisasi model Decision Tree menggunakan [Viz.js](https://github.com/mdaines/viz.js).
- Interaksi svg model Decision Tree menggunakan [SVG.js](https://github.com/svgdotjs).

### Tools Pengembangan
- SASS
- DBMS PostgresSql
- Javascript

## Demo

Akses sistem dapat dilakukan melalui [link](http://fierce-anchorage-86085.herokuapp.com/) dengan informasi akses sebagai berikut:
- email: kjfd@test.com
- password: kjfddemo