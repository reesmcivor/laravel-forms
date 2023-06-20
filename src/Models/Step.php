<?php

namespace ReesMcIvor\Forms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Step extends Model
{
    protected $guarded = ['id'];

    public function form() : BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function fieldsets() : BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'fieldset_steps');
    }

}
