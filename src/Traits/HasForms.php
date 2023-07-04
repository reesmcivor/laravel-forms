<?php

namespace ReesMcIvor\Forms\Traits;

use ReesMcIvor\Forms\Models\FormEntry;

trait HasForms {

    public function formEntries()
    {
        return $this->hasMany(FormEntry::class);
    }

}
