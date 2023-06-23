<?php

namespace ReesMcIvor\Forms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    protected $guarded = ['id'];

    public function form() : BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function questions() : BelongsToMany
    {
        return $this->belongsToMany(Question::class, 'question_groups');
    }

    public function children() : HasMany
    {
        return $this->hasMany(Group::class, 'group_id')->with('children');
    }
}
