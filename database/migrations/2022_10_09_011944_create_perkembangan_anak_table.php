<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerkembanganAnakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perkembangan_anak', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('anak_id')->unsigned();
            $table->string('uid');
            $table->date('tgl_pemeriksaan');
            $table->double('bb');
            $table->double('tb');
            $table->double('suhu');
            $table->timestamps();
            $table->foreign('anak_id')
                ->references('id')
                ->on('anak')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perkembangan_anak');
    }
}
