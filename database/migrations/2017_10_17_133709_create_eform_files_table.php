<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEformFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eform_files', function (Blueprint $table) {
          $table->integer('form_id')->unsigned()->index();
          $table->foreign('form_id')->references('id')->on('eform_forms')->onDelete('cascade');
          $table->integer('type');
          $table->integer('no');
          $table->text('name');
          $table->text('temp');
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
        Schema::dropIfExists('eform_files');
    }
}
