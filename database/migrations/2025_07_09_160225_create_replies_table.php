<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('replies', static function (Blueprint $table) {
            $table->id();
            $table->text('body');
            $table->timestamps();
            $table->foreignId('thread_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('parent_id')->nullable()->constrained('replies')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('replies');
    }
};
