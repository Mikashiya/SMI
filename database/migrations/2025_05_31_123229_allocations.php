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
        Schema::create('allocations', function(Blueprint $table){
            $table->char('id_alct', 9)->primary();
            $table->string('usage', 50);
            $table->integer('f_stock');
            $table->integer('e_stock')->default(0);
            $table->integer('s_stock')->default(3);
            $table->string('note', 50)->nullable();
            $table->string('reminder', 2);
            $table->unsignedBigInteger('id_part');
            $table->unsignedBigInteger('id_wh');
            $table->foreign('id_part')->references('id_part')->on('spareparts')->onDelete('cascade');
            $table->foreign('id_wh')->references('id_wh')->on('warehouses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allocations');
    }
};
