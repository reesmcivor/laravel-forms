<?php

namespace Tests\Forms\Unit\Tenant;

use PHPUnit\Framework\Attributes\Test;
use ReesMcIvor\Forms\Models\Form;
use Tests\TenantTestCase;

class FormTest extends TenantTestCase {

    #[Test]
    public function a_form_can_be_created()
    {
        Form::factory()->create();
    }

}
