<?php

namespace Tests\Forms\Unit\Tenant;

use PHPUnit\Framework\Attributes\Test;
use ReesMcIvor\Forms\Models\Form;
use Tests\TenantTestCase;

class FormQuestionTest extends TenantTestCase {

    #[Test]
    public function a_form_can_be_created()
    {
        $form = Form::factory()->create();
        $this->assertDatabaseHas('forms', $form->toArray());
    }

}
