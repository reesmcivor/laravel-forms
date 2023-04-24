<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use ReesMcIvor\Forms\Models\Form;
use ReesMcIvor\Forms\Models\FormEntry;
use ReesMcIvor\Forms\Models\Question;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('text_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(FormEntry::class);
            $table->foreignIdFor(Question::class);
            $table->text('answer');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('choice_answers');
    }
};

