<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dataset extends Model
{
    protected $table = 'datasets';
    protected $fillable = ['NIM', 
    'skripsi_judul', 
    'skripsi_tahun', 
    'skripsi_bidang', 
    'skripsi_bidang_rekomendasi', 
    'skripsi_tanggal_proposal', 
    'skripsi_tanggal_semhas', 
    'mk_PGI', 
    'mk_SIGD1', 
    'mk_SIGD2', 
    'mk_SIGL', 
    'mk_SPK', 
    'mk_ABD', 
    'mk_BDT', 
    'mk_DBD', 
    'mk_DM', 
    'mk_DW', 
    'mk_KB', 
    'mk_PBD', 
    'mk_ADSI', 
    'mk_DPSI', 
    'mk_IPSI', 
    'mk_PABW', 
    'mk_PBPU', 
    'mk_PPP', 
    'mk_SE', 
    'mk_PL', 
    'mk_DDAP', 
    'mk_DIAP', 
    'mk_EPAP', 
    'mk_EASI', 
    'mk_MO', 
    'mk_MITI', 
    'mk_MLTI', 
    'mk_MP', 
    'mk_MPSI', 
    'mk_MRS', 
    'mk_MR', 
    'mk_PPB', 
    'mk_PSSI', 
    'mk_TKTI', 
    'mk_EA', 
    'mk_SBF', 
    'mk_MHP'];
}
