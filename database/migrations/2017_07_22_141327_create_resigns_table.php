<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resigns', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('user_id');
            $table->string('user_em_id')->nullable();
            $table->date('time_str')->commemt('Start Job');
            $table->date('time_agn')->nullable()->comment('Assign Job');
            $table->date('time_end')->nullable()->comment('End Job');
            $table->string('code');
            $table->date('last_date');
            $table->date('effect_date');
            $table->char('status',2);
            $table->text('reason')->nullable();
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
        Schema::dropIfExists('resigns');
    }
}
