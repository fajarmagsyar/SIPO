<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Obat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
        Schema::create('obat', function (Blueprint $table) {
            $table->uuid('obat_id')->primary();
            $table->string('kode_obat')->nullable();
            $table->string('nama_obat')->nullable();
            $table->string('kemasan')->nullable();
            $table->integer('stok_awal')->nullable();
            $table->integer('stok_saat_ini')->nullable();
            $table->integer('hjd')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        DB::statement('ALTER TABLE obat ALTER COLUMN obat_id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('obat');
    }
}
