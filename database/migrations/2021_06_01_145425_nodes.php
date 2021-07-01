<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Nodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nodes', function (Blueprint $table) {
            $table->string('node_id');
            $table->integer('tree_id');
            $table->string('node_parent');
            $table->string('node_name', 20);
            $table->string('node_value', 50);
            // $table->string('node_rule', 100)->nullable();
            // $table->integer('node_level')->nullable();
            // $table->string('node_leaf_class', 50)->nullable();
            $table->string('node_leaf_purity', 50)->nullable();
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
        //
    }
}
