<?php

namespace ReesMcIvor\Forms\Console\Commands;

use Illuminate\Console\Command;
use ReesMcIvor\Forms\Models\Choice;
use ReesMcIvor\Forms\Models\Group;
use ReesMcIvor\Forms\Models\Form;
use ReesMcIvor\Forms\Models\FormEntry;
use ReesMcIvor\Forms\Models\Question;

class SeedForms extends Command
{
    protected $signature = 'accounts:create:form';

    protected $description = 'Create Accounts Form';

    public function handle()
    {
        Form::all()->each(fn($form) => $form->delete());
        FormEntry::all()->each(fn($formEntry) => $formEntry->delete());
        Question::all()->each(fn($question) => $question->delete());

        $form = Form::firstOrCreate([
            'name' => 'New Account Form',
            'description' => 'This is a new account form',
        ]);

        $questions = [];
        $questions[] = Question::factory()->create([ 'question' => 'Company Name', 'slug' => 'company', 'type' => 'varchar', 'required' => 1 ])->id;
        $questions[] = Question::factory()->create([ 'question' => 'Company Registration Number', 'slug' => 'company_registration_number', 'validation' => 'sometimes', 'type' => 'varchar' ])->id;
        $questions[] = Question::factory()->create([ 'question' => 'Registered Office', 'slug' => 'registered_office', 'type' => 'text', 'validation' => 'required', 'class' => 'w-1/2'])->id;
        $questions[] = Question::factory()->create([ 'question' => 'Trading Address', 'slug' => 'trading_address', 'type' => 'text', 'required' => 1, 'class' => 'w-1/2'])->id;
        $questions[] = Question::factory()->create([ 'question' => 'Telephone Number', 'slug' => 'telephone_number', 'type' => 'varchar', 'validation' => 'required', 'required' => 1 ])->id;
        $questions[] = Question::factory()->create([ 'question' => 'Accounts Contact', 'type' => 'varchar', 'validation' => 'required' ])->id;
        $questions[] = Question::factory()->create([ 'question' => 'Accounts Payable Email', 'slug' => 'accounts_payable_email', 'type' => 'varchar', 'validation' => 'required|email', 'required' => 1 ])->id;
        $questions[] = Question::factory()->create([ 'question' => 'VAT Number', 'slug' => 'vat_number', 'type' => 'varchar' ])->id;
        $questions[] = Question::factory()->create([ 'question' => 'Year Business Commenced', 'slug' => 'year_bussiness_commenced', 'type' => 'date', 'required' => true ])->id;

        $typeOfOrgQuestion = Question::factory()->create(['question' => 'Type of Organisation', 'slug' => 'type_of_organisation', 'type' => 'select']);
        Choice::factory()->create(['question_id' => $typeOfOrgQuestion->id, 'choice' => 'Limited Company']);
        Choice::factory()->create(['question_id' => $typeOfOrgQuestion->id, 'choice' => 'Partnership']);
        Choice::factory()->create(['question_id' => $typeOfOrgQuestion->id, 'choice' => 'Sole Trader']);
        $questions[] = $typeOfOrgQuestion->id;

        $questions[] = Question::factory()->create([ 'question' => 'Parent Company', 'type' => 'varchar' ])->id;
        $questions[] = Question::factory()->create([ 'question' => 'Business Other Details', 'show_label' => false, 'description' => 'If your company is not registered as a Limited Company, or is a new Limited Company trading for less than two years, please supply full names and addresses of Proprietors, Partners or Directors: (Please use separate page if there is not enough space)', 'type' => 'text', 'required' => 0 ])->id;

        $form->groups()->create(['name' => 'General'])->questions()->attach($questions);

        /** New Group */
        $questions = [];
        $questions[] = Question::factory()->create([ 'question' => 'Goods In Detail', 'type' => 'text', 'description' => 'Opening times, Booking-in details (if required), Delivery Address (if different from above)' ])->id;
        $questions[] = Question::factory()->create([ 'question' => 'Anticipated monthly spend', 'type' => 'varchar', 'validation' => 'required|numeric' ])->id;
        $questions[] = Question::factory()->create([ 'question' => 'Max Credit Required', 'type' => 'varchar', 'validation' => 'sometimes|numeric' ])->id;
        $questions[] = Question::factory()->create([ 'question' => 'Purchase Order Required', 'type' => 'boolean', 'validation' => 'boolean', 'description' => 'Are Purchase Order No\'s Required' ])->id;
        $questions[] = Question::factory()->create([ 'question' => 'Booking In Telephone', 'slug' => 'booking_in_telephone', 'type' => 'varchar', 'validation' => 'required' ])->id;
        $questions[] = Question::factory()->create([ 'question' => 'Booking In Email Address', 'slug' => 'booking_in_email', 'type' => 'email', 'validation' => 'required' ])->id;
        $form->groups()->create(['name' => 'Delivery Information'])->questions()->attach($questions);

        $groupRepeat = 3;
        $group = $form->groups()->create(['name' => 'Trade References']);
        for($i=1; $i<=$groupRepeat; $i++) {
            $questions = [];
            $questions[] = Question::factory()->create(['question' => 'Name & Address', 'slug' => 'trade_ref_address_' . $i, 'type' => 'varchar', 'validation' => $i < 3 ? 'required' : 'sometimes', 'class' => 'w-full'])->id;
            $questions[] = Question::factory()->create(['question' => 'Email', 'slug' => 'trade_ref_email_' . $i, 'type' => 'varchar', 'validation' => 'sometimes|email', 'cols' => 'w-1/2'])->id;
            $questions[] = Question::factory()->create(['question' => 'Phone', 'slug' => 'trade_ref_phone_' . $i, 'type' => 'varchar', 'validation' => 'sometimes', 'cols' => 'w-1/2'])->id;
            $tradeReference = Group::create(['group_id' => $group->id, 'form_id' => $form->id, 'name' => 'Trade Reference ' . $i]);
            $tradeReference->questions()->attach($questions);
        }

        $questions = [];
        $questions[] = Question::factory()->create(['question' => 'Signed', 'slug' => 'signed', 'type' => 'varchar', 'validation' => 'required', 'description' => 'Please enter your name'])->id;
        $questions[] = Question::factory()->create(['question' => 'On Behalf Of', 'type' => 'varchar', 'validation' => 'sometimes'])->id;
        $questions[] = Question::factory()->create(['question' => 'Position', 'type' => 'varchar', 'validation' => 'required'])->id;
        $questions[] = Question::factory()->create(['question' => 'Date', 'type' => 'date', 'validation' => 'required'])->id;
        $questions[] = Question::factory()->create(['question' => 'Agree to our Terms', 'description' => 'You agree to our <a href="https://www.maxpack.co.uk/terms-conditions/">terms and conditions</a>', 'type' => 'boolean', 'validation' => 'accepted' ])->id;

        $form->groups()->create(['name' => 'Declaration to Sign and Submit'])->questions()->attach($questions);

    }

}
