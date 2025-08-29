<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('steps');
            $table->string('etype');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('pro_category_id')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();

            $table->foreign('category_id')
                  ->references('id')->on('categories')
                  ->onDelete('cascade');

            $table->foreign('pro_category_id')
                  ->references('id')->on('pro_categories')
                  ->onDelete('set null');
        });
    }

    public function down(): void {
        Schema::dropIfExists('exercises');
    }
};
