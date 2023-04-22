<?php

namespace ReesMcIvor\Forms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ReesMcIvor\Forms\Database\Factories\QuestionFactory;
use Tests\Forms\Unit\Tenant\AnswerTest;

class Question extends Model
{
    use HasFactory;

    const TYPE_TEXT = 'text';
    const TYPE_CHOICE = 'choice';

    protected static function newFactory()
    {
        return QuestionFactory::new();
    }

    public function forms()
    {
        return $this->belongsToMany(Form::class);
    }

    public function answeable()
    {
        return $this->morptTo();
    }
}
