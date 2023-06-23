<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use ReesMcIvor\Forms\Models\VarcharAnswer;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('label');
            $table->string('slug')->unique();
            $table->string('description')->nullable();
            $table->integer('min_required')->default(1);
            $table->integer('max_required')->default(1);
            $table->boolean('required')->default(false);
            $table->boolean('show_label')->default(true);
            $table->boolean('allow_multiple')->default(false);
            $table->string('validation')->nullable();
            $table->enum('type', ['varchar', 'text', 'select', 'date', 'number', 'boolean']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};

