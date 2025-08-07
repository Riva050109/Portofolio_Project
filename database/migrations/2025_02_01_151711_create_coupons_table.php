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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Kode kupon (unik)
            $table->enum('type', ['fixed', 'percentage', 'food', 'drink']); // Jenis diskon: tetap atau persentase
            $table->decimal('value', 8, 2); // Nilai diskon
            $table->date('valid_until')->nullable(); // Tanggal kedaluwarsa
            $table->integer('usage_limit')->nullable(); // Batas penggunaan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
