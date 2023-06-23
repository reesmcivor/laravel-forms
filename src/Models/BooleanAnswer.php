<?php

namespace ReesMcIvor\Forms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ReesMcIvor\Forms\Database\Factories\BooleanFactory;

class BooleanAnswer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts = [
        'answer' => 'boolean',
    ];

    protected static function newFactory()
    {
        return BooleanFactory::new();
    }

    public function questionAnswer()
    {
        return $this->morphOne(QuestionAnswer::class, 'answerable');
    }
}
