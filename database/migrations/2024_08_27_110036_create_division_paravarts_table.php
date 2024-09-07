<?php

use App\Models\Difficulty;
use App\Models\Level;
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
        Schema::create('division_paravarts', function (Blueprint $table) {
            $table->id();
            $table->integer('number1');
            $table->integer('number2');
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
        Schema::dropIfExists('division_paravarts');
    }
};
