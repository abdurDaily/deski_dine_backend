<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('categories', 'branch_id')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->unsignedBigInteger('branch_id')->nullable()->after('id');
                $table->foreign('branch_id')->references('id')->on('branches')->onDelete('set null');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('categories', 'branch_id')) {
            try {
                Schema::table('categories', function (Blueprint $table) {
                    $table->dropForeign(['branch_id']);
                    $table->dropColumn('branch_id');
                });
            } catch (\Exception $e) {
                // If dropping the foreign fails (constraint missing), attempt to drop the column only
                try {
                    Schema::table('categories', function (Blueprint $table) {
                        $table->dropColumn('branch_id');
                    });
                } catch (\Exception $e) {
                    // ignore: best-effort rollback
                }
            }
        }
    }
};
