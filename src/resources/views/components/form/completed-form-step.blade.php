@inject('service', '\ReesMcIvor\Forms\Service\FormService')

@if($step)

        <div style="padding-left:10px;">
            <h2 style="font-weight:bold">{{ $step->name }}</h2>
            @foreach($step->questions as $question)
                <div><strong>{{ $question->label }}:</strong> {{ $answers[$question->id] ?? null }}</div>
            @endforeach
        </div>

        @if($step->children)
            @foreach($step->children as $group)
                @include('forms::components.form.completed-form-step', [
                    'step' => $group,
                    'answers' => $service->getRecursiveQuestionAnswers($formEntry, $step)
                ])
            @endforeach
        @endif
    </div>
@endif




