<?php

namespace ReesMcIvor\Forms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ReesMcIvor\Forms\Database\Factories\FormEntryFactory;
use ReesMcIvor\Forms\Database\Factories\FormFactory;

class FormEntry extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return FormEntryFactory::new();
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }
}
