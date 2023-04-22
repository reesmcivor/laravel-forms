<?php

namespace ReesMcIvor\Forms\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    protected $table = 'question_answers';

    protected $fillable = ['question_id', 'answerable_id', 'answerable_type'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function answerable()
    {
        return $this->morphTo();
    }
}
