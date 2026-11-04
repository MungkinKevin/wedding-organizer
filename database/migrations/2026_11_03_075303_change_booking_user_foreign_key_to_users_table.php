
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('booking', function (Blueprint $table) {
            // Hapus foreign key lama yang mengarah ke tabel user
            $table->dropForeign('fk_booking_user');

            // Buat foreign key baru yang mengarah ke users.id
            $table->foreign('id_user', 'fk_booking_users')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::table('booking', function (Blueprint $table) {
            // Kembalikan foreign key ke tabel user
            $table->dropForeign('fk_booking_users');

            $table->foreign('id_user', 'fk_booking_user')
                ->references('id_user')
                ->on('user')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }
};
