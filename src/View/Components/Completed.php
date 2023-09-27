<?php

namespace ReesMcIvor\Forms\View\Components;


use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use ReesMcIvor\Forms\Service\FormService;

class Completed extends Component
{

    public $formEntry = null;
    public $steps = null;
    private FormService $formService;

    public function __construct( $formEntry )
    {
        $this->formEntry = $formEntry;
        $this->steps = $this->getSteps();
        $this->formService = (new FormService);
    }

    public function getRecursiveQuestionAnswers($step)
    {
        return $this->formService->getRecursiveQuestionAnswers($this->formEntry, $step);
    }

    public function getSteps()
    {
        return $this->formEntry->form->steps;
    }

    public function render(): View|Closure|string
    {
        return view('forms::components.form.completed-form', [
            'formEntry' => $this->formEntry,
            'steps' => $this->formEntry->form->steps
        ]);
    }

    public function renderSteps($step)
    {
        return view('forms::components.form.completed-form-step', [
            'step' => $step,
            'answers' => $this->getRecursiveQuestionAnswers($step)
        ]);
    }
}
