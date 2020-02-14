<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_agents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            //$table->string('code');
            $table->string('name');
            $table->text('addressI');
            $table->text('addressII');
            $table->text('addressIII');
            $table->text('addressIV');
            $table->string('postcode');
            $table->string('website');
            $table->string('telephone_no');
            $table->string('fax_no');
            $table->string('letter_head');
            $table->string('logo_header_file');
            $table->string('blank_lines');
            $table->string('status');
            $table->string('type');
            $table->string('belongs_to');
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
        Schema::dropIfExists('tbl_agents');
    }
}
