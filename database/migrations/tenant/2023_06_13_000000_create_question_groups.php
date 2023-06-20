<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use ReesMcIvor\Forms\Models\Group;
use ReesMcIvor\Forms\Models\Form;
use ReesMcIvor\Forms\Models\FormEntry;
use ReesMcIvor\Forms\Models\Question;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('question_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Question::class);
            $table->foreignIdFor(Group::class);
            $table->softDeletes();
            $table->timestamps();
        });
    }
};

