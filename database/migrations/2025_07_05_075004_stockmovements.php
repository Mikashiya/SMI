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
            $table->text('description')->nullable();
            $table->string('pic_wh')->nullable();
            $table->string('pic_item')->nullable();
            $table->string('price')->nullable();
            $table->string('supplier')->nullable();
            $table->string('part_use')->nullable();
            $table->date('date_in')->nullable();
            $table->date('date_out')->nullable();
            $table->date('date_transfer')->nullable();
            $table->char('id_alct', 9);
            $table->foreign('id_alct')->references('id_alct')->on('allocations');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('custom_users');
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
