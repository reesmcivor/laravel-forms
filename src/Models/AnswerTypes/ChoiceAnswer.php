<?php

namespace ReesMcIvor\Forms\Models\AnswerTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ReesMcIvor\Forms\Database\Factories\ChoiceAnswerFactory;
use ReesMcIvor\Forms\Database\Factories\VarcharAnswerFactory;

class ChoiceAnswer extends Answer
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function newFactory()
    {
        return ChoiceAnswerFactory::new();
    }

    public function choice()
    {
        return $this->hasOne(Choice::class, 'id', 'choice_id');
    }
}
