<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CreateConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $current_date_time = Carbon::now()->toDateTimeString();
        Schema::create('configurations', function (Blueprint $table) {
            $table->id();
            $table->string('OS');
            $table->boolean('configured');
            $table->timestamps();
        });

        DB::table('configurations')->insert(
            array(
                'OS' => '',
                'configured' => FALSE,
                'created_at' => $current_date_time,
                'updated_at' => $current_date_time
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configurations');
    }
}
