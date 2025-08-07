<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'featured')) {
                $table->tinyInteger('featured')->default(0)->after('is_recommended');
            }
            
            if (!Schema::hasColumn('products', 'category')) {
                $table->string('category')->after('description');
            }
            
            if (!Schema::hasColumn('products', 'price')) {
                $table->decimal('price', 10, 2)->after('category')->default(0);
            }
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $columnsToDrop = ['featured', 'category', 'price'];
            
            foreach ($columnsToDrop as $column) {
                if (Schema::hasColumn('products', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};