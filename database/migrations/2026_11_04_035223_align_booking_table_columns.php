<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Lepaskan foreign key booking
        Schema::table('booking', function (Blueprint $table) {
            $table->dropForeign('fk_booking_paket');
            $table->dropForeign('fk_booking_users');
        });

        // Ubah nama kolom booking
        Schema::table('booking', function (Blueprint $table) {
            $table->renameColumn('id_booking', 'id');
            $table->renameColumn('id_user', 'user_id');
            $table->renameColumn('id_paket', 'paket_id');
            $table->renameColumn('tanggal_acara', 'event_date');
            $table->renameColumn('catatan', 'notes');
        });

        // Buat kembali foreign key dengan nama kolom baru
        Schema::table('booking', function (Blueprint $table) {
            $table->foreign('user_id', 'booking_user_id_foreign')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('paket_id', 'booking_paket_id_foreign')
                ->references('id')
                ->on('paket')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::table('booking', function (Blueprint $table) {
            $table->dropForeign('booking_user_id_foreign');
            $table->dropForeign('booking_paket_id_foreign');
        });

        Schema::table('booking', function (Blueprint $table) {
            $table->renameColumn('id', 'id_booking');
            $table->renameColumn('user_id', 'id_user');
            $table->renameColumn('paket_id', 'id_paket');
            $table->renameColumn('event_date', 'tanggal_acara');
            $table->renameColumn('notes', 'catatan');
        });

        Schema::table('booking', function (Blueprint $table) {
            $table->foreign('id_user', 'fk_booking_users')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('id_paket', 'fk_booking_paket')
                ->references('id')
                ->on('paket')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }
};