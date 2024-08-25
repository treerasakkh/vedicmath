<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Level;
use App\Models\Difficulty;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('addition_books', function (Blueprint $table) {
            $table->id();
            $table->string('numbers')->unique();
            $table->foreignIdFor(Level::class)->constrained();
            $table->foreignIdFor(Difficulty::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addition_books');
    }
};
