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
            $table->string('from_loc', 9)->nullable();
            $table->string('to_loc', 9)->nullable();
            $table->text('description')->nullable();
            $table->string('pic_wh', 30);
            $table->string('pic_item', 30);
            $table->decimal('price', 12, 2)->nullable();
            $table->string('supplier', 30)->nullable();
            $table->string('part_use', 50)->nullable();
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
