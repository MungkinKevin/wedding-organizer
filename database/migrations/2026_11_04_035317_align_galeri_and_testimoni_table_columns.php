<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('galeri', function (Blueprint $table) {
            $table->renameColumn('id_galeri', 'id');
            $table->renameColumn('judul', 'title');
            $table->renameColumn('foto', 'photo');
        });

        Schema::table('testimoni', function (Blueprint $table) {
            $table->renameColumn('id_testimoni', 'id');
            $table->renameColumn('nama_client', 'client_name');
            $table->renameColumn('isi_testimoni', 'content');
            $table->renameColumn('foto', 'photo');
        });
    }

    public function down(): void
    {
        Schema::table('galeri', function (Blueprint $table) {
            $table->renameColumn('id', 'id_galeri');
            $table->renameColumn('title', 'judul');
            $table->renameColumn('photo', 'foto');
        });

        Schema::table('testimoni', function (Blueprint $table) {
            $table->renameColumn('id', 'id_testimoni');
            $table->renameColumn('client_name', 'nama_client');
            $table->renameColumn('content', 'isi_testimoni');
            $table->renameColumn('photo', 'foto');
        });
    }
};