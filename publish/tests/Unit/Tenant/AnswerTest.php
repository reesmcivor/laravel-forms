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
        Question::factory()->create()->forms()->attach(
            Form::factory()->create()
        );

        $this->assertCount(1, Form::get() );
        $this->assertCount(1, Question::get()->first()->forms );
    }

}
