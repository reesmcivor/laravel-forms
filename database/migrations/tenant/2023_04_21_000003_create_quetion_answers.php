<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use ReesMcIvor\Forms\Models\Form;
use ReesMcIvor\Forms\Models\Question;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('text_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Question::class);
            $table->bigInteger('answerable_id');
            $table->string('answerable_type');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('text_answers');
    }
};

