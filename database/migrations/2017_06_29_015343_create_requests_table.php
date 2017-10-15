<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('user_id');
            $table->string('user_em_id')->nullable();
            $table->date('time_str')->commemt('Start Job');
            $table->date('time_agn')->nullable()->comment('Assign Job');
            $table->date('time_end')->nullable()->comment('End Job');
            $table->date('effect_date');
            $table->integer('company');
            $table->integer('location');
            $table->integer('em_type');
            $table->integer('position_id');
            $table->string('imd_id');
            $table->integer('rfm_id')->comment('Reason for employment');
            $table->string('ren_name')->nullable()->comment('Reason for employment name');
            $table->text('rfm_nfb')->nullable()->comment('Reason for without budget');
            $table->string('rfm_emp_id')->nullable()->comment('Reason for Transfer name');
            $table->integer('jt_id')->comment('Job type');
            $table->integer('tw_lead')->nullable()->comment('Job type leadtime');
            $table->integer('tw_lead_type')->nullable()->comment('Job type');
            $table->text('jd')->comment('Job Description');
            $table->text('qua')->comment('Qualifications');
            $table->integer('sex');
            $table->integer('count');
            $table->string('age');
            $table->json('edu_id');
            $table->json('fac_id');
            $table->integer('exp')->comment('Experience');
            $table->integer('exp_year')->nullable();
            $table->string('com_id');
            $table->json('sw')->nullable();
            $table->string('sw_etc_spc')->nullable();
            $table->json('ac')->nullable();
            $table->string('ac_etc_spc')->nullable();
            $table->integer('fedc')->nullable();
            $table->integer('car')->nullable();
            $table->string('car_lp')->nullable();
            $table->json('nmc')->nullable();
            $table->text('ofa')->nullable();
            $table->char('status',2);
            $table->text('remark')->nullable();
            $table->integer('rate')->nullable();
            $table->text('comment')->nullable();
            $table->text('em_remark')->nullable();
            $table->boolean('approve');
            $table->timestamps();
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
        Schema::dropIfExists('requests');
    }
}
