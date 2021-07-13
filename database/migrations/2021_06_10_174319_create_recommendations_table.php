<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecommendationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recommendations', function (Blueprint $table) {
            $table->string('NIM', 16)->primary();
            $table->string('skripsi_bidang_rekomendasi', 50)->nullable();
            $table->string('mk_PGI', 4)->nullable();
            $table->string('mk_SIGD1', 4)->nullable();
            $table->string('mk_SIGD2', 4)->nullable();
            $table->string('mk_SIGL', 4)->nullable();
            $table->string('mk_SPK', 4)->nullable();
            $table->string('mk_ABD', 4)->nullable();
            $table->string('mk_BDT', 4)->nullable();
            $table->string('mk_DBD', 4)->nullable();
            $table->string('mk_DM', 4)->nullable();
            $table->string('mk_DW', 4)->nullable();
            $table->string('mk_KB', 4)->nullable();
            $table->string('mk_PBD', 4)->nullable();
            $table->string('mk_ADSI', 4)->nullable();
            $table->string('mk_DPSI', 4)->nullable();
            $table->string('mk_IPSI', 4)->nullable();
            $table->string('mk_PABW', 4)->nullable();
            $table->string('mk_PBPU', 4)->nullable();
            $table->string('mk_PPP', 4)->nullable();
            $table->string('mk_SE', 4)->nullable();
            $table->string('mk_PL', 4)->nullable();
            $table->string('mk_DDAP', 4)->nullable();
            $table->string('mk_DIAP', 4)->nullable();
            $table->string('mk_EPAP', 4)->nullable();
            $table->string('mk_EASI', 4)->nullable();
            $table->string('mk_MO', 4)->nullable();
            $table->string('mk_MITI', 4)->nullable();
            $table->string('mk_MLTI', 4)->nullable();
            $table->string('mk_MP', 4)->nullable();
            $table->string('mk_MPSI', 4)->nullable();
            $table->string('mk_MRS', 4)->nullable();
            $table->string('mk_MR', 4)->nullable();
            $table->string('mk_PPB', 4)->nullable();
            $table->string('mk_PSSI', 4)->nullable();
            $table->string('mk_TKTI', 4)->nullable();
            $table->string('mk_EA', 4)->nullable();
            $table->string('mk_SBF', 4)->nullable();
            $table->string('mk_MHP', 4)->nullable();
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
        Schema::dropIfExists('recommendations');
    }
}
