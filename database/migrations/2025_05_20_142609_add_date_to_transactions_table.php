<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // Hanya tambahkan kolom jika belum ada
        if (!Schema::hasColumn('transactions', 'date')) {
            Schema::table('transactions', function (Blueprint $table) {
                $table->date('date')->after('id')->useCurrent();
            });
        }
    }

    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('date');
        });
    }
};