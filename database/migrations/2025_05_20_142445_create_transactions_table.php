<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // Cek jika tabel sudah ada
        if (Schema::hasTable('transactions')) {
            // Tambahkan kolom yang belum ada
            Schema::table('transactions', function (Blueprint $table) {
                if (!Schema::hasColumn('transactions', 'date')) {
                    $table->date('date')->after('id');
                }
                if (!Schema::hasColumn('transactions', 'amount')) {
                    $table->decimal('amount', 10, 2);
                }
                // Lanjutkan untuk kolom lainnya...
            });
        }
    }

    public function down()
    {
        // Optional: rollback changes
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['date', 'amount']);
        });
    }
};