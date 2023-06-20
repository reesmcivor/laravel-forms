<?php

namespace ReesMcIvor\Forms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuestionGroup extends Model
{
    protected $guarded = ['id'];

    public function group() : BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
}
