<?php

namespace ReesMcIvor\Forms\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    protected $guarded = ['id'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function answerable()
    {
        return $this->morphTo();
    }
}
