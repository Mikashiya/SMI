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
        Schema::create('stc_mvt', function (Blueprint $table) {
            $table->id('id_smvt');
            $table->enum('mvt_type', ['in', 'out', 'transfer']);
            $table->integer('qty');
            $table->string('from_loc')->nullable();
            $table->string('to_loc')->nullable();
            $table->text('desc')->nullable();
            $table->char('id_alct', 9);
            $table->foreign('id_alct')->references('id_alct')->on('allocations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stc_mvt');
    }
};
