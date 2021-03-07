<?php

namespace Tests\Feature;

use App\Http\Livewire\ContactForm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    /**
     * @test
     */

    public function main_page_contains_contact_form_livewire_component()
    {
        $this->get('/')
            ->assertSeeLivewire('contact-form');
    }

    /**
     * @test
     */
    public function contact_form_sends_out_an_email()
    {
        Livewire::test(ContactForm::class)
            ->set('name', 'dino')
            ->set('email', 'dino@gmail.com')
            ->set('phone', '12345')
            ->set('message', 'something well')
            ->call('submitForm')
            ->assertSee('We received your message successfully and will get back to you shortly');
    }

    /**
     *
     * @test
     */
    public function contact_form_name_field_is_required()
    {
        Livewire::test(ContactForm::class)
        ->set('email', 'dino@gmail.com')
        ->set('phone', '12345')
        ->set('message', 'something well')
        ->call('submitForm')
        ->assertHasErrors(['name' => 'required']);

    }

    /**
     *
     * @test
     */
    public function contact_form_message_field_has_minimum_characters()
    {
        Livewire::test(ContactForm::class)
        ->set('message', 'abc')
        ->call('submitForm')
        ->assertHasErrors(['message' => 'min']);

    }
}
