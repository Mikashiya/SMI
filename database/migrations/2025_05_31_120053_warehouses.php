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
        Schema::create('warehouses', function(Blueprint $table){
            $table->id('id_wh');
            $table->enum('wh_type', ['Mechanic', 'Electric']);
            $table->integer('shelf_count');
            $table->string('shelf_ids', 3);
            $table->integer('cabs_count');
            $table->string('cabs_ids', 3);
            $table->integer('capacity');
            $table->string('temp_ctrl', 20);
            $table->unsignedBigInteger('id_whlocs');
            $table->foreign('id_whlocs')->references('id_whlocs')->on('whlocs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouses');
    }
};
