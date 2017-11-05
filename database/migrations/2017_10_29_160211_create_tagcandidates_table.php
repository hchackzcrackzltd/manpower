<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagcandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tagcandidates', function (Blueprint $table) {
            $table->integer('form_id');
            $table->foreign('form_id')->references('id')->on('eform_forms')->onDelete('cascade');
            $table->string('posit');
            $table->integer('exp');
            $table->string('edu');
            $table->integer('sex');
            $table->integer('eq');
            $table->integer('iq');
            $table->integer('age');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tagcandidates');
    }
}
