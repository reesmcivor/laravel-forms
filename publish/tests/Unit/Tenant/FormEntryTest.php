<?php

namespace Tests\Forms\Unit\Tenant;

use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use ReesMcIvor\Forms\Models\Choice;
use ReesMcIvor\Forms\Models\ChoiceAnswer;
use ReesMcIvor\Forms\Models\Form;
use ReesMcIvor\Forms\Models\FormEntry;
use ReesMcIvor\Forms\Models\Question;
use ReesMcIvor\Forms\Models\QuestionAnswer;
use ReesMcIvor\Forms\Models\TextAnswer;
use Tests\TenantTestCase;

class FormEntryTest extends TenantTestCase {

    #[Test]
    public function a_form_entry_can_be_created()
    {
        $form = Form::create(['name' => 'Consultation']);
        $formEntry = FormEntry::create(['user_id' => User::factory()->create()->id, 'form_id' => $form->id]);

        $this->assertDatabaseHas('form_entries', [
            'user_id' => $formEntry->user_id,
            'form_id' => $formEntry->form_id,
        ]);
    }

    #[Test]
    public function retrive_only_my_entries()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $this->actingAs($user);

        $form = Form::create(['name' => 'Consultation']);

        FormEntry::create(['user_id' => $user->id, 'form_id' => $form->id]);
        FormEntry::create(['user_id' => $otherUser->id, 'form_id' => $form->id]);

        $this->assertEquals(2, FormEntry::mine->count());
    }

}
