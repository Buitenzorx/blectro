<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{

    public function up(): void
    {
        Schema ::create('devices', function (Blueprint $table) {
        $table->id();
        $table->string('nama_device');
        $table->integer('nilai_min');
        $table->integer('nilai_max');
        $table->integer('nilai');
        $table->timestamps();
    });
}

    public function down(): void
    {
    Schema::dropIfExists('devices');
    }
};
