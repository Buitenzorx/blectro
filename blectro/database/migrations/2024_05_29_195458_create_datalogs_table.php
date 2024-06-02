<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('datalog', function (Blueprint $table) {
            $table ->integer('device_id');
            $table ->string('device_name');
            $table ->string('devicetype');
            $table ->integer('useraction');
            $table ->integer('valuelog');
            $table ->string('statuslog');
            $table ->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datalog');
    }
};
