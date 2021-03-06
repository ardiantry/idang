<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbTamu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_tamu', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->integer('id_undangan');   
            $table->integer('id_user');   
            $table->char('nama',50);
            $table->char('nomor_hp',13);
            $table->text('alamat');  
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
         Schema::dropIfExists('tb_tamu');
    }
}
