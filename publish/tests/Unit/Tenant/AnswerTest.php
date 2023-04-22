<?php

namespace Tests\Forms\Unit\Tenant;

use App\Models\User;
use Faker\Provider\Text;
use PHPUnit\Framework\Attributes\Test;
use ReesMcIvor\Forms\Models\Form;
use ReesMcIvor\Forms\Models\FormEntry;
use ReesMcIvor\Forms\Models\Question;
use ReesMcIvor\Forms\Models\QuestionAnswer;
use ReesMcIvor\Forms\Models\TextAnswer;
use Tests\TenantTestCase;

class AnswerTest extends TenantTestCase {

    protected function setUp(): void
    {
        parent::setUp();
    }

    #[Test]
    public function a_form_can_have_a_given_text_question()
    {

        $form = Form::create(['name' => 'Consultation']);
        $formEntry = FormEntry::create(['user_id' => User::factory()->create()->id, 'form_id' => $form->id]);

        $question = Question::factory()->create(['type' => 'text']);
        $question->forms()->attach($form);

        $answer = TextAnswer::create([ "question_id" => $question->id,  "answer" => "Test Answer"]);

        if($question->type == "text") {
            QuestionAnswer::create([
                'form_entry_id' => $formEntry->id,
                'question_id' => $question->id,
                'answerable_id' => $answer->id,
                'answerable_type' => TextAnswer::class,
            ]);
        }

        $this->assertEquals('Test Answer', Question::get()->first()->questionAnswers->first()->answerable->answer);
    }

    #[Test]
    public function a_question_with_a_choice()
    {
        $form = Form::create(['name' => 'Consultation']);
        $formEntry = FormEntry::create(['user_id' => User::factory()->create()->id, 'form_id' => $form->id]);

        $question = Question::factory()->create(['type' => 'select']);
        $question->forms()->attach($form);

        $answer = TextAnswer::create([ "question_id" => $question->id,  "answer" => "Test Answer"]);

        if($question->type == "select") {
            QuestionAnswer::create([
                'form_entry_id' => $formEntry->id,
                'question_id' => $question->id,
                'answerable_id' => $answer->id,
                'answerable_type' => TextAnswer::class,
            ]);
        }

        $this->assertEquals('Test Answer', Question::get()->first()->questionAnswers->()->answerable->answer);
    }

}
