<?php

namespace App\Orchid\Screens\Contact;

use App\Models\Contact;
use Orchid\Screen\TD;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;


class ContactScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'contact' => Contact::latest()->paginate(10),
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return 'Contact Us';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return 'We are here to assist you! Reach out through our contact form, send us an email at [our email address], visit the Help Center for FAQs, follow us on [social media platform] for updates, or call us at [our phone number] for immediate assistance. Your questions and feedback are important to us!';
    }


    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * @return iterable|null
     */
    public function permission(): ?iterable
    {
        return [
            'platform.systems.contact',
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('contact', [
                TD::make('name', __('Name'))
                    ->sort()
                    ->render(fn (Contact $contact) => $contact->name),

                TD::make('email', __('Email'))
                    ->sort()
                    ->render(fn (Contact $contact) => $contact->email),

                TD::make('message', __('Message'))
                    ->sort()
                    ->render(fn (Contact $contact) => $contact->message),

                TD::make('created_at', __('Last edit'))
                    ->sort()
                    ->render(fn (Contact $contact) => $contact->created_at),
            ])
        ];
    }
}
