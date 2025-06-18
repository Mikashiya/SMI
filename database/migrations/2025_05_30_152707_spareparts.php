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
        Schema::create('spareparts', function(Blueprint $table){
            $table->id('id_part');
            $table->string('part_name', 30);
            $table->string('part_type', 50);
            $table->string('mfg', 30);
            $table->decimal('price', 12, 2);
            $table->unsignedBigInteger('id_spl');
            $table->foreign('id_spl')->references('id_spl')->on('supplier');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spareparts');
    }
};
