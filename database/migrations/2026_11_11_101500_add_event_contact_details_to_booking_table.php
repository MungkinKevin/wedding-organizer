<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('booking', function (Blueprint $table) {
            $table->string('bride_name', 100)->nullable();
            $table->string('groom_name', 100)->nullable();
            $table->string('contact_phone', 20)->nullable();
            $table->text('contact_address')->nullable();
            $table->time('event_time')->nullable();
            $table->string('event_location', 150)->nullable();
            $table->text('event_address')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('booking', function (Blueprint $table) {
            $table->dropColumn([
                'bride_name',
                'groom_name',
                'contact_phone',
                'contact_address',
                'event_time',
                'event_location',
                'event_address',
            ]);
        });
    }
};
