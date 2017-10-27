<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEformFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eform_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->text("etc_posit")->nullable();
            $table->integer("titlename");
            $table->string("name");
            $table->string("nameeng");
            $table->decimal("weight")->nullable();
            $table->decimal("height")->nullable();
            $table->text("address_mas");
            $table->text("address");
            $table->string("telephone")->nullable();
            $table->string("mobile");
            $table->string("email");
            $table->string("provb_id");
            $table->date("birthdate");
            $table->integer("age");
            $table->string("natc_id");
            $table->string("race_id");
            $table->string("reli_id");
            $table->string("code_card",20)->unique();
            $table->string("issued_at")->nullable();
            $table->date("issuedate");
            $table->integer("status");
            $table->boolean("married")->nullable();
            $table->string("fam_name")->nullable();
            $table->integer("fam_age")->nullable();
            $table->text("fam_posit")->nullable();
            $table->string("f_name")->nullable();
            $table->integer("f_age")->nullable();
            $table->text("f_posit")->nullable();
            $table->text("f_address")->nullable();
            $table->string("f_phone")->nullable();
            $table->string("m_name")->nullable();
            $table->integer("m_age")->nullable();
            $table->text("m_posit")->nullable();
            $table->text("m_address")->nullable();
            $table->string("m_phone")->nullable();
            $table->integer("national_format");
            $table->date("national_format_due")->nullable();
            $table->text("national_format_ref")->nullable();
            $table->text("lang_etc")->nullable();
            $table->text("abi_com")->nullable();
            $table->text("abi_any")->nullable();
            $table->boolean("drivli")->nullable();
            $table->boolean("moto")->nullable();
            $table->boolean("caru")->nullable();
            $table->boolean("motou")->nullable();
            $table->text("freetm")->nullable();
            $table->text("frncm")->nullable();
            $table->boolean("contagious_format")->nullable();
            $table->text("contagious_format_explain")->nullable();
            $table->boolean("law_format")->nullable();
            $table->text("law_format_explain")->nullable();
            $table->boolean("law2_format")->nullable();
            $table->text("law2_format_explain")->nullable();
            $table->boolean("agb")->nullable();
            $table->integer("intv_format")->nullable();
            $table->string("intv_format_when")->nullable();
            $table->string("emrcon_name");
            $table->text("emrcon_address");
            $table->string("emrcon_tel");
            $table->text("emrcon_rel");
            $table->boolean("friends_format")->nullable();
            $table->text("fcn")->nullable();
            $table->text("fcn2")->nullable();
            $table->date("startwk");
            $table->text("intf")->nullable();
            $table->boolean("agg_data");
            $table->boolean("job_status")->nullable();
            $table->integer("eq")->nullable();
            $table->integer("iq")->nullable();
            $table->string("mbti")->nullable();
            $table->date("pub_enddate")->nullable();
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
        Schema::dropIfExists('eform_forms');
    }
}
