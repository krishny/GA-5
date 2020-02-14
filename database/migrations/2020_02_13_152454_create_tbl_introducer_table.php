<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblIntroducerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_introducer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('int_id')->unique();
            $table->string('introducer_ref')->unique();
            $table->string('contact_name');
            $table->string('comp_name');
            $table->text('address');
            $table->string('phone_no');
            $table->string('fax_no');
            $table->string('email')->nullabel();
            $table->string('url');
            $table->string('status');
            $table->boolean('isDeleted')->default(0);
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
        Schema::dropIfExists('tbl_introducer');
    }
}
