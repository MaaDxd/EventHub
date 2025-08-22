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
        Schema::table('events', function (Blueprint $table) {
            // Drop the foreign key constraint if it exists
            try {
                $table->dropForeign(['category_id']);
            } catch (Exception $e) {
                // Foreign key might not exist, continue
            }

            // Modify the column to allow nullable and add category_type if not exists
            $table->unsignedBigInteger('category_id')->nullable()->change();

            if (!Schema::hasColumn('events', 'category_type')) {
                $table->string('category_type')->nullable()->after('category_id');
            }

            // Add a new foreign key constraint that allows null
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            if (Schema::hasColumn('events', 'category_type')) {
                $table->dropColumn('category_type');
            }
            $table->unsignedBigInteger('category_id')->nullable(false)->change();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }
};
