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
        Schema::table('form_question', function (Blueprint $table) {
            $table->integer('class')->nullable()->default(0)->before('sort_order');
        });
    }

    public function down(): void
    {
        Schema::table('form_question', function (Blueprint $table) {
            $table->dropColumn('class');
        });
    }
};

