<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Admin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
        Schema::create('admin', function (Blueprint $table) {
            $table->uuid('admin_id')->primary();
            $table->uuid('pelaku_id')->nullable();
            $table->string('nama_admin')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable();
            $table->text('password')->nullable();
            $table->datetime('first_login')->nullable();
            $table->datetime('last_login')->nullable();
            $table->text('last_login_detail')->nullable();
            $table->integer('role')->nullable();
            $table->text('token')->nullable();
            $table->text('img')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        DB::statement('ALTER TABLE admin ALTER COLUMN admin_id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin');
    }
}
