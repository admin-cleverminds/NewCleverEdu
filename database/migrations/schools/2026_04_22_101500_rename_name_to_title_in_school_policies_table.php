<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (
            Schema::hasColumn('school_policies', 'name') &&
            !Schema::hasColumn('school_policies', 'title')
        ) {

            try {
                Schema::table('school_policies', function (Blueprint $table) {
                    $table->renameColumn('name', 'title');
                });
            } catch (\Throwable $e) {
                DB::statement("
                    ALTER TABLE `school_policies`
                    CHANGE COLUMN `name` `title` VARCHAR(191) NOT NULL
                ");
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (
            Schema::hasColumn('school_policies', 'title') &&
            !Schema::hasColumn('school_policies', 'name')
        ) {

            try {
                Schema::table('school_policies', function (Blueprint $table) {
                    $table->renameColumn('title', 'name');
                });
            } catch (\Throwable $e) {
                DB::statement("
                    ALTER TABLE `school_policies`
                    CHANGE COLUMN `title` `name` VARCHAR(191) NOT NULL
                ");
            }
        }
    }
};