<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('forms_questions', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('form_questions');
    }
};

