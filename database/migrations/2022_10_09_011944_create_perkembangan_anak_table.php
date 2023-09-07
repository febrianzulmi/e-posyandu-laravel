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
            $table->date('tgl_penimbangan');
            $table->double('berat_badan');
            $table->double('tinggi_badan');
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
