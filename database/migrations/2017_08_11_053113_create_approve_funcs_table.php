<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApproveFuncsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approve_funcs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('function_id');
            $table->string('party_id');
            $table->string('department_id');
            $table->string('party_th')->nullable();
            $table->string('party_en')->nullable();
            $table->string('dep_th')->nullable();
            $table->string('dep_en')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('approve_funcs');
    }
}
