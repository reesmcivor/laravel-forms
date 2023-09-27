@inject('service', '\ReesMcIvor\Forms\Service\FormService')

@if($steps = $steps ?? null)
    @foreach($steps as $step)

        @include('forms::components.form.completed-form-step', [
            'step' => $step,
            'answers' => $service->getRecursiveQuestionAnswers($formEntry, $step)
        ])

    @endforeach
@endif




