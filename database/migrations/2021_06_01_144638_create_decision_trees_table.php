<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDecisionTreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('decision_trees', function (Blueprint $table) {
            $table->id('tree_id');
            $table->string('node_id')->nullable();
            $table->string('tree_name')->nullable();
            $table->integer('tree_training_data')->nullable();
            $table->integer('tree_testing_data')->nullable();
            $table->float('tree_accuracy', 7, 6)->nullable();
            $table->string('tree_precision')->nullable();
            $table->string('tree_recall')->nullable();
            $table->integer('tree_size');
            $table->integer('tree_leaves');
            $table->integer('tree_instances')->nullable();
            $table->mediumText('tree_graph')->nullable();
            $table->mediumText('tree_rules');
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
        Schema::dropIfExists('decision_trees');
    }
}
