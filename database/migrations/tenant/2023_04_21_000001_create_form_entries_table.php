<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('form_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class);
            $table->foreignIdFor(\ReesMcIvor\Forms\Models\Form::class);
            $table->float('percentage_complete')->default(0);
            $table->boolean('complete')->default(false);
            $table->timestamps();
        });

        Schema::table('form_entries', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('form_id')->references('id')->on('forms');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('form_entries');
    }
};

