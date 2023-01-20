<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbMProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_m_projects', function (Blueprint $table) {
            $table->bigIncrements('project_id');
            $table->string('project_name', 100);
            $table->bigInteger('client_id');
            $table->date('project_start');
            $table->date('project_end');
            $table->string('project_status', 15);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_m_projects');
    }
}
