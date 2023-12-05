<?php

return [
    'logo' => 'https://www.maxpack.co.uk/wp-content/themes/maxpack-retail/public/images/maxpack-logo.svg',
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
