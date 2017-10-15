<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEformHisJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eform_his_jobs', function (Blueprint $table) {
            $table->integer('form_id')->unsigned()->index();
            $table->foreign('form_id')->references('id')->on('eform_forms')->onDelete('cascade');
              $table->integer('no');
              $table->integer('type');
              $table->string('name')->nullable();
              $table->text('address')->nullable();
              $table->date('strdate')->nullable();
              $table->date('enddate')->nullable();
              $table->text('posit')->nullable();
              $table->text('respon')->nullable();
              $table->text('ref')->nullable();
              $table->text('rel')->nullable();
              $table->text('tel')->nullable();
              $table->text('resign')->nullable();
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
        Schema::dropIfExists('eform_his_jobs');
    }
}
