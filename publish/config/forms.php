<?php

return [
    'field' => [
        'types' => [
            'varchar' => ReesMcIvor\Forms\Models\AnswerTypes\VarcharAnswer::class,
            'text' => ReesMcIvor\Forms\Models\AnswerTypes\TextAnswer::class,
            'boolean' => ReesMcIvor\Forms\Models\AnswerTypes\BooleanAnswer::class,
            'select' => ReesMcIvor\Forms\Models\AnswerTypes\ChoiceAnswer::class,
            'date' => ReesMcIvor\Forms\Models\AnswerTypes\VarcharAnswer::class
        ]
    ]
];
