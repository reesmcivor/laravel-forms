<?php

namespace ReesMcIvor\Forms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use ReesMcIvor\Forms\Database\Factories\FormFactory;

class Form extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function newFactory()
    {
        return FormFactory::new();
    }

    public function steps() : HasMany
    {
        return $this->hasMany(Group::class)
            ->where('group_id', null);
    }

    public function groups() : HasMany
    {
        return $this->hasMany(Group::class);
    }

    public function getValidationRules() : array
    {
        $rules = [];
        foreach($this->groups as $group) {
            foreach($group->questions as $question) {
                $rules += $question->getValidationRules();
            }
        }
        return $rules;
    }
}
