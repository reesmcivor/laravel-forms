<?php

namespace ReesMcIvor\Forms\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
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
        $rules = [];
        foreach($this->formEntry->form->groups as $group) {
            foreach($group->questions as $question) {
                array_merge($rules, $question->getValidationRules());
            }
        }
        return $rules;
    }

    public function attributes(): array
    {
        return [
            'question' => [
                141 => 'Test ksdhfkjhsdfsf'
            ]
        ];
    }
}

