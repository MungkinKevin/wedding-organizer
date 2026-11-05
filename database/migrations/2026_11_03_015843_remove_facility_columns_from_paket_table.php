<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('paket', function (Blueprint $table) {
            $table->dropColumn([
                'facility1',
                'facility2',
                'facility3',
                'facility4',
                'facility5',
                'facility6',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('paket', function (Blueprint $table) {
            $table->string('facility1')->nullable();
            $table->string('facility2')->nullable();
            $table->string('facility3')->nullable();
            $table->string('facility4')->nullable();
            $table->string('facility5')->nullable();
            $table->string('facility6')->nullable();
        });
    }
};