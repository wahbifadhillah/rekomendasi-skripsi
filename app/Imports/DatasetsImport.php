<?php

namespace App\Imports;

use App\Dataset;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Illuminate\Validation\Rule;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsFailures;


class DatasetsImport implements ToModel, withValidation, SkipsOnFailure, SkipsEmptyRows
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $rows = 0;
    private function transformGrade($grade){
        if($grade == 'A' || $grade == 'a'){
            return 'SB';
        }elseif($grade == 'B+' || $grade == 'b+'){
            return 'B';
        }elseif($grade == 'B' || $grade == 'b'){
            return 'B';
        }elseif($grade == 'C+' || $grade == 'c+'){
            return 'C';
        }elseif($grade == 'C' || $grade == 'c'){
            return 'C';
        }elseif($grade == 'D+' || $grade == 'd+'){
            return 'K';
        }elseif($grade == 'D' || $grade == 'd'){
            return 'K';
        }elseif($grade == 'E' || $grade == 'e'){
            return 'K';
        }elseif($grade == 'K' || $grade == 'k'){
            return 'K';
        }elseif($grade == 'NULL' || $grade == '?' || $grade == '' || $grade == NULL){
            return 'N';
        }else{
            return NULL;
        }
    }

    private function transformNULL($data){
        if($data == 'NULL'){
            return NULL;
        }else{
            return $data;
        }
    }
    public function model(array $row)
    {
        ++$this->rows;
        return new Dataset([
            'NIM' => $row[0],
            'skripsi_judul' => $row[1],
            'skripsi_tahun' => $row[2],
            'skripsi_bidang' => $row[3],
            'skripsi_bidang_rekomendasi' => $this->transformNULL($row[4]),
            'skripsi_tanggal_proposal' => $row[5],
            'skripsi_tanggal_semhas' => $row[6],
            'mk_PGI' => $this->transformGrade($row[7]),
            'mk_SIGD1' => $this->transformGrade($row[8]),
            'mk_SIGD2' => $this->transformGrade($row[9]),
            'mk_SIGL' => $this->transformGrade($row[10]),
            'mk_SPK' => $this->transformGrade($row[11]),
            'mk_ABD' => $this->transformGrade($row[12]),
            'mk_BDT' => $this->transformGrade($row[13]),
            'mk_DBD' => $this->transformGrade($row[14]),
            'mk_DM' => $this->transformGrade($row[15]),
            'mk_DW' => $this->transformGrade($row[16]),
            'mk_KB' => $this->transformGrade($row[17]),
            'mk_PBD' => $this->transformGrade($row[18]),
            'mk_ADSI' => $this->transformGrade($row[19]),
            'mk_DPSI' => $this->transformGrade($row[20]),
            'mk_IPSI' => $this->transformGrade($row[21]),
            'mk_PABW' => $this->transformGrade($row[22]),
            'mk_PBPU' => $this->transformGrade($row[23]),
            'mk_PPP' => $this->transformGrade($row[24]),
            'mk_SE' => $this->transformGrade($row[25]),
            'mk_PL' => $this->transformGrade($row[26]),
            'mk_DDAP' => $this->transformGrade($row[27]),
            'mk_DIAP' => $this->transformGrade($row[28]),
            'mk_EPAP' => $this->transformGrade($row[29]),
            'mk_EASI' => $this->transformGrade($row[30]),
            'mk_MO' => $this->transformGrade($row[31]),
            'mk_MITI' => $this->transformGrade($row[32]),
            'mk_MLTI' => $this->transformGrade($row[33]),
            'mk_MP' => $this->transformGrade($row[34]),
            'mk_MPSI' => $this->transformGrade($row[35]),
            'mk_MRS' => $this->transformGrade($row[36]),
            'mk_MR' => $this->transformGrade($row[37]),
            'mk_PPB' => $this->transformGrade($row[38]),
            'mk_PSSI' => $this->transformGrade($row[39]),
            'mk_TKTI' => $this->transformGrade($row[40]),
            'mk_EA' => $this->transformGrade($row[41]),
            'mk_SBF' => $this->transformGrade($row[42]),
            'mk_MHP' => $this->transformGrade($row[43]),
        ]);
    }

    public function getRowCount(): int
    {
        return $this->rows;
    }

    public function rules(): array
    {
        return [
            '*.0' => ['required', 'unique:datasets,NIM'],
            '*.1' => ['required'],
            '*.2' => ['required'],
            '*.3' => ['required'],
            '*.5' => ['required', 'date'],
            '*.6' => ['required', 'date'],
            '*.7' => ['required', 'max:4', Rule::in(['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'K', NULL, 'NULL', 'null', '?'])],
            '*.8' => ['required', 'max:4', Rule::in(['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'K', NULL, 'NULL', 'null', '?'])],
            '*.9' => ['required', 'max:4', Rule::in(['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'K', NULL, 'NULL', 'null', '?'])],
            '*.10' => ['required', 'max:4', Rule::in(['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'K', NULL, 'NULL', 'null', '?'])],
            '*.11' => ['required', 'max:4', Rule::in(['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'K', NULL, 'NULL', 'null', '?'])],
            '*.12' => ['required', 'max:4', Rule::in(['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'K', NULL, 'NULL', 'null', '?'])],
            '*.13' => ['required', 'max:4', Rule::in(['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'K', NULL, 'NULL', 'null', '?'])],
            '*.14' => ['required', 'max:4', Rule::in(['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'K', NULL, 'NULL', 'null', '?'])],
            '*.15' => ['required', 'max:4', Rule::in(['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'K', NULL, 'NULL', 'null', '?'])],
            '*.16' => ['required', 'max:4', Rule::in(['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'K', NULL, 'NULL', 'null', '?'])],
            '*.17' => ['required', 'max:4', Rule::in(['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'K', NULL, 'NULL', 'null', '?'])],
            '*.18' => ['required', 'max:4', Rule::in(['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'K', NULL, 'NULL', 'null', '?'])],
            '*.19' => ['required', 'max:4', Rule::in(['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'K', NULL, 'NULL', 'null', '?'])],
            '*.20' => ['required', 'max:4', Rule::in(['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'K', NULL, 'NULL', 'null', '?'])],
            '*.21' => ['required', 'max:4', Rule::in(['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'K', NULL, 'NULL', 'null', '?'])],
            '*.22' => ['required', 'max:4', Rule::in(['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'K', NULL, 'NULL', 'null', '?'])],
            '*.23' => ['required', 'max:4', Rule::in(['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'K', NULL, 'NULL', 'null', '?'])],
            '*.24' => ['required', 'max:4', Rule::in(['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'K', NULL, 'NULL', 'null', '?'])],
            '*.25' => ['required', 'max:4', Rule::in(['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'K', NULL, 'NULL', 'null', '?'])],
            '*.26' => ['required', 'max:4', Rule::in(['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'K', NULL, 'NULL', 'null', '?'])],
            '*.27' => ['required', 'max:4', Rule::in(['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'K', NULL, 'NULL', 'null', '?'])],
            '*.28' => ['required', 'max:4', Rule::in(['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'K', NULL, 'NULL', 'null', '?'])],
            '*.29' => ['required', 'max:4', Rule::in(['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'K', NULL, 'NULL', 'null', '?'])],
            '*.31' => ['required', 'max:4', Rule::in(['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'K', NULL, 'NULL', 'null', '?'])],
            '*.32' => ['required', 'max:4', Rule::in(['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'K', NULL, 'NULL', 'null', '?'])],
            '*.33' => ['required', 'max:4', Rule::in(['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'K', NULL, 'NULL', 'null', '?'])],
            '*.34' => ['required', 'max:4', Rule::in(['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'K', NULL, 'NULL', 'null', '?'])],
            '*.35' => ['required', 'max:4', Rule::in(['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'K', NULL, 'NULL', 'null', '?'])],
            '*.36' => ['required', 'max:4', Rule::in(['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'K', NULL, 'NULL', 'null', '?'])],
            '*.37' => ['required', 'max:4', Rule::in(['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'K', NULL, 'NULL', 'null', '?'])],
            '*.38' => ['required', 'max:4', Rule::in(['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'K', NULL, 'NULL', 'null', '?'])],
            '*.39' => ['required', 'max:4', Rule::in(['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'K', NULL, 'NULL', 'null', '?'])],
            '*.40' => ['required', 'max:4', Rule::in(['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'K', NULL, 'NULL', 'null', '?'])],
            '*.41' => ['required', 'max:4', Rule::in(['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'K', NULL, 'NULL', 'null', '?'])],
            '*.42' => ['required', 'max:4', Rule::in(['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'K', NULL, 'NULL', 'null', '?'])],
            '*.43' => ['required', 'max:4', Rule::in(['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E', 'K', NULL, 'NULL', 'null', '?'])],
        ];
    }

    public function customValidationMessages()
{
    return [
        '1.in' => 'Custom message for :attribute.',
    ];
}

    // public function onFailure(Failure ...$failures)
    // {

    // }
}
