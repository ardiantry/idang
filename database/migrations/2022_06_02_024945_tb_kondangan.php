<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbKondangan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('tb_kondangan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_anggota');  
            $table->char('nama_kondangan',100);
            $table->char('foto',100); 
            $table->text('alamat');  
            $table->enum('status',['aktif','non_aktif']);   
            $table->timestamp('tgl_mulai')->nullable();  
            $table->timestamp('tgl_selesai')->nullable();  
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
        Schema::dropIfExists('tb_kondangan');
    }
}
