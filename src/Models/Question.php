<?php

namespace ReesMcIvor\Forms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ReesMcIvor\Forms\Database\Factories\QuestionFactory;
use Tests\Forms\Unit\Tenant\AnswerTest;
use Illuminate\Support\Str;

class Question extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();
        static::saving(function ($question) {
            $question->label = $question->label ?? $question->question;
            $question->slug = $question->slug ?? Str::slug($question->label, '_');
        });
    }

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
        $rules = $this->getAttribute('validation') ?? ($this->required ? 'required' : 'sometimes');
        return ["question.{$this->id}" => $rules];
    }

}
