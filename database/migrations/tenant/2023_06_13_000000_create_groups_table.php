<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use ReesMcIvor\Forms\Models\Form;
use ReesMcIvor\Forms\Models\FormEntry;
use ReesMcIvor\Forms\Models\Group;
use ReesMcIvor\Forms\Models\Question;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Group::class)->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignIdFor(Form::class);
            $table->unsignedInteger('sort_order')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }
};

