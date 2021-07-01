<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->id('training_id');
            $table->string('skripsi_bidang', 50);
            $table->date('skripsi_tanggal_proposal');
            $table->date('skripsi_tanggal_semhas');
            $table->string('mk_PGI', 4);
            $table->string('mk_SIGD1', 4);
            $table->string('mk_SIGD2', 4);
            $table->string('mk_SIGL', 4);
            $table->string('mk_SPK', 4);
            $table->string('mk_ABD', 4);
            $table->string('mk_BDT', 4);
            $table->string('mk_DBD', 4);
            $table->string('mk_DM', 4);
            $table->string('mk_DW', 4);
            $table->string('mk_KB', 4);
            $table->string('mk_PBD', 4);
            $table->string('mk_ADSI', 4);
            $table->string('mk_DPSI', 4);
            $table->string('mk_IPSI', 4);
            $table->string('mk_PABW', 4);
            $table->string('mk_PBPU', 4);
            $table->string('mk_PPP', 4);
            $table->string('mk_SE', 4);
            $table->string('mk_PL', 4);
            $table->string('mk_DDAP', 4);
            $table->string('mk_DIAP', 4);
            $table->string('mk_EPAP', 4);
            $table->string('mk_EASI', 4);
            $table->string('mk_MO', 4);
            $table->string('mk_MITI', 4);
            $table->string('mk_MLTI', 4);
            $table->string('mk_MP', 4);
            $table->string('mk_MPSI', 4);
            $table->string('mk_MRS', 4);
            $table->string('mk_MR', 4);
            $table->string('mk_PPB', 4);
            $table->string('mk_PSSI', 4);
            $table->string('mk_TKTI', 4);
            $table->string('mk_EA', 4);
            $table->string('mk_SBF', 4);
            $table->string('mk_MHP', 4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trainings');
    }
}
