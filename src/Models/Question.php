<?php

namespace ReesMcIvor\Forms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ReesMcIvor\Forms\Database\Factories\QuestionFactory;
use Tests\Forms\Unit\Tenant\AnswerTest;

class Question extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    const TYPE_TEXT = AnswerTest::class;
    const TYPE_CHOICE = 'choice';

    protected static function newFactory()
    {
        return QuestionFactory::new();
    }

    public function forms()
    {
        return $this->belongsToMany(Form::class);
    }

    public function choices()
    {
        return $this->hasMany(Choice::class);
    }

    public function questionAnswers()
    {
        return $this->hasMany(QuestionAnswer::class);
    }

    public function getValidationRules(): array
    {
        if ($this->required) {
            $rules['question.' . $this->id] = 'required';
        }
        if($this->validation) {
            $rules['question.' . $this->id] .= '|' . $this->validation;
        }
        return $rules ?? ['question.' . $this->id => 'sometimes'];
    }
}
