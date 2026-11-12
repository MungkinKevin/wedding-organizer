<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Lepaskan foreign key booking ke paket
        Schema::table('booking', function (Blueprint $table) {
            $table->dropForeign('fk_booking_paket');
        });

        // Ubah nama kolom paket
        Schema::table('paket', function (Blueprint $table) {
            $table->renameColumn('id_paket', 'id');
            $table->renameColumn('nama_paket', 'name');
            $table->renameColumn('harga', 'price');
            $table->renameColumn('deskripsi', 'description');
        });

        // Hubungkan kembali booking ke primary key paket yang baru
        Schema::table('booking', function (Blueprint $table) {
            $table->foreign('id_paket', 'fk_booking_paket')
                ->references('id')
                ->on('paket')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::table('booking', function (Blueprint $table) {
            $table->dropForeign('fk_booking_paket');
        });

        Schema::table('paket', function (Blueprint $table) {
            $table->renameColumn('id', 'id_paket');
            $table->renameColumn('name', 'nama_paket');
            $table->renameColumn('price', 'harga');
            $table->renameColumn('description', 'deskripsi');
        });

        Schema::table('booking', function (Blueprint $table) {
            $table->foreign('id_paket', 'fk_booking_paket')
                ->references('id_paket')
                ->on('paket')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }
};