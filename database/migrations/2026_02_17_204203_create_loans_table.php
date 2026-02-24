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
        Schema::create('loans', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade'); // кто взял
    $table->foreignId('book_id')->constrained()->onDelete('cascade'); // какая книга
    $table->dateTime('loaned_at'); // когда выдана
    $table->dateTime('due_at'); // когда должна быть возвращена (например, +14 дней)
    $table->dateTime('returned_at')->nullable(); // когда фактически вернули
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
