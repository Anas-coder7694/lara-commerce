<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::table('products', function (Blueprint $table) {
            // Use after() to place it logically in the table
            // Use nullable() so existing rows don't break the constraint
            if (!Schema::hasColumn('products', 'vendor_id')) {
                    $table->foreignId('vendor_id')->after('id')->nullable()->constrained()->onDelete('cascade');
                } else {
                    // If the column exists but the foreign key doesn't
                    $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
                }
        });
    }

    public function down(): void{
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['vendor_id']);
            $table->dropColumn('vendor_id');
        });
    }
};
