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
        Schema::create('custom_roles', function (Blueprint $table) {
            $table->id(); // Primary key for the roles table
            $table->string('role_name', 10)->unique(); // Unique role name
            $table->text('description')->nullable(); // Optional description of the role
            $table->boolean('is_active')->default(true); // Active status of the role
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_roles');
    }
};
