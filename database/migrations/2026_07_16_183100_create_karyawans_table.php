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
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('posisi_id')->constrained('posisis')->onDelete('cascade');
            $table->foreignId('divisi_id')->constrained('divisis')->onDelete('cascade');
            $table->string('kode_karyawan')->unique();
            $table->string('nik')->unique();
            $table->string('nama_karyawan');
            $table->string('jenis_kelamin');
            $table->date('tanggal_lahir');
            $table->string('no_telepon')->nullable();
            $table->string('email')->unique();
            $table->text('alamat')->nullable();
            $table->date('tanggal_masuk');
            $table->decimal('gaji_pokok', 15, 2);
            $table->string('foto')->nullable();
            $table->string('status')->default('Aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawans');
    }
};
