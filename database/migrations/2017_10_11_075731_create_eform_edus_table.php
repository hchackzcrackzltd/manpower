<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEformEdusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eform_edus', function (Blueprint $table) {
            $table->integer('form_id')->unsigned()->index();
            $table->foreign('form_id')->references('id')->on('eform_forms')->onDelete('cascade');
              $table->integer('no');
              $table->integer('edu_id');
              $table->string('name')->nullable();
              $table->text('locat')->nullable();
              $table->date('startdate')->nullable();
              $table->date('enddate')->nullable();
              $table->text('ccd')->nullable();
              $table->text('ms')->nullable();
              $table->decimal('gpa',4,2)->nullable();
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
        Schema::dropIfExists('eform_edus');
    }
}
