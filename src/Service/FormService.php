<?php

namespace ReesMcIvor\Forms\Service;

use Illuminate\Support\Collection;
use ReesMcIvor\Forms\Models\FormEntry;
use ReesMcIvor\Forms\Models\Group;
use ReesMcIvor\Forms\Models\Question;
use ReesMcIvor\Forms\Models\QuestionAnswer;

class FormService {

    public function getRecursiveQuestionAnswers( FormEntry $formEntry, Group $group, &$answers = [] ) : array
    {
        $answers += $this->getQuestionAnswers($formEntry, $group->questions)->toArray();

        if($group->children->count()) {
            foreach($group->children as $childGroup) {
                $answers += $this->getRecursiveQuestionAnswers($formEntry, $childGroup, $answers);
            }
        }
        return $answers;
    }

    protected function getQuestionAnswers( FormEntry $formEntry, Collection $questions ) : Collection
    {
        return $questions->mapWithKeys(function(Question $question) use ($formEntry) {
            switch($question->type) {
                case "select":
                    $answer = QuestionAnswer::where('form_entry_id', $formEntry->id)->where('question_id', $question->id)->first();
                    return [$question->id => $answer?->answerable?->choice?->id];
                default:
                    $answer = QuestionAnswer::where('form_entry_id', $formEntry->id)->where('question_id', $question->id)->first();
                    return [$question->id => $answer?->answerable?->answer];
            }
        })->reject(function($answer) {
            return $answer == null;
        });
    }

}
