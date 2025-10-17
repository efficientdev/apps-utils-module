<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** allows the same email to be used for signup on different domains
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->after('id');
            $table->dropUnique(['email']); // if it was already unique
            $table->softDeletes();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //$table->string('username')->unique()->after('id');
            $table->dropUnique(['username']); // if it was already unique
            $table->dropSoftDeletes();
        }); 
        //Schema::dropIfExists('products');
    }
};
