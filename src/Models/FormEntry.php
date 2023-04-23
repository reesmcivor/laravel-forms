<?php

namespace ReesMcIvor\Forms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ReesMcIvor\Forms\Database\Factories\FormEntryFactory;

class FormEntry extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function newFactory()
    {
        return FormEntryFactory::new();
    }

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function mineScope($query)
    {
        return $query->where('user_id', auth()->id());
    }
}
