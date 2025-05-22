<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trashes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('building_id')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            // $table->integer('weight');
            $table->decimal('weight', 8, 2);
            $table->date('collection_date')->nullable();
            $table->string('create_by')->nullable();
            $table->string('update_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')->references('id')->on('categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('building_id')->references('id')->on('buildings')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trashes', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
