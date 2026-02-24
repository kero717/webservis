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
    Schema::create('books', function (Blueprint $table) {
        $table->id();
        $table->string('title');               // Название
        $table->string('author');               // Автор
        $table->string('genre')->nullable();    // Жанр
        $table->string('publisher')->nullable();// Издатель
        $table->integer('year')->nullable();    // Год издания
        $table->string('isbn')->nullable();     // ISBN
        $table->integer('copies')->default(1);  // Всего экземпляров
        $table->integer('available_copies')->default(1); // Доступно для выдачи
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
