<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use ReesMcIvor\Forms\Models\BooleanAnswer;
use ReesMcIvor\Forms\Models\Form;
use ReesMcIvor\Forms\Models\FormEntry;
use ReesMcIvor\Forms\Models\Question;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('form_entries', function (Blueprint $table) {
            $table->dateTime('completed_at')->after('complete')->nullable();
            $table->dropColumn('complete');
        });
    }

    public function down(): void
    {
        Schema::table('form_entries', function (Blueprint $table) {
            $table->dropColumn('completed_at');
            $table->boolean('complete')->default(false);
        });
    }
};

