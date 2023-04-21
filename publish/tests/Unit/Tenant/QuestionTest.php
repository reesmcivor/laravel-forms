<?php

namespace Tests\Forms\Unit\Tenant;

use PHPUnit\Framework\Attributes\Test;
use ReesMcIvor\Forms\Models\Form;
use ReesMcIvor\Forms\Models\Question;
use Tests\TenantTestCase;

class QuestionTest extends TenantTestCase {

    #[Test]
    public function a_form_can_have_a_given_question()
    {
        $form = Form::factory()->create();

        $question = Question::factory()->create([
            'form_id' => $form->id
        ]);

        $this->assertDatabaseHas('forms', $form->toArray());
    }

}
