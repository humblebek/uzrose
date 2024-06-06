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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId("category_id")->constrained()->onDelete('cascade');
            $table->string('name');
            $table->date('year');
            $table->string('breeder');
            $table->string('color');
            $table->string('petal');
            $table->integer('height');
            $table->string('smell');
            $table->integer('price');
            $table->integer('status');
            $table->integer('quantity');
            $table->text('about');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
