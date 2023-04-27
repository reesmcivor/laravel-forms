<?php

namespace ReesMcIvor\Forms\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use ReesMcIvor\Forms\Models\FormEntry;
use ReesMcIvor\Forms\Models\Question;

class FormEntryRequest extends FormRequest
{

    protected FormEntry $formEntry;

    public function authorize(): bool
    {
        $this->formEntry = FormEntry::find( $this->request->get('form_entry_id') );
        return auth()?->user()?->id == $this->formEntry->user_id ? true : false;
    }

    public function rules(): array
    {
        $validationRules =  $this->formEntry->form->questions->mapWithKeys(fn(Question $question) => $question->getValidationRules())->toArray();
        return $validationRules;
    }
}
