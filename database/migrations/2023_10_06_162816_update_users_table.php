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
        Schema::table('users', function (Blueprint $table) {
            $table->date('dob')->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->string('role')->default('user');
            $table->string('gender')->nullable();
            $table->string('avatar')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('dob');
            $table->dropColumn('phone_number');
            $table->dropColumn('role');
            $table->dropColumn('gender');
            $table->dropColumn('avatar');
            $table->dropSoftDeletes();
        });
    }
};
