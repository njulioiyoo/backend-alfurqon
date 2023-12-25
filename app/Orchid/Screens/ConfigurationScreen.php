<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Action;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use App\Models\Configuration;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Cropper;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Fields\TextArea;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Switcher;

class ConfigurationScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Site Configurations';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'Components for laying out your project';
    }

    /**
     * @return iterable|null
     */
    public function permission(): ?iterable
    {
        return [
            'platform.systems.configurations',
        ];
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Save'))
                ->icon('check')
                ->method('save'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @throws \Throwable
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        $configurations = Configuration::pluck('value', 'key')->all();
        $websiteLogoHeader = $configurations['website_logo_header'] ?? '';
        $websiteLogoFooter = $configurations['website_logo_footer'] ?? '';

        return [
            Layout::tabs([
                'General' =>
                Layout::rows([
                    Input::make('website_name')
                        ->horizontal()
                        ->title('Website Name')
                        ->placeholder('Enter website name')
                        ->value($configurations['website_name'] ?? ''),
                    TextArea::make('website_description')
                        ->horizontal()
                        ->title('Website Description')
                        ->placeholder('Enter website description')
                        ->value($configurations['website_description'] ?? ''),
                    TextArea::make('website_contact_info')
                        ->horizontal()
                        ->title('Website Contact Information')
                        ->placeholder('Enter website contact information')
                        ->rows(5)
                        ->value($configurations['website_contact_info'] ?? ''),
                    Input::make('website_phone_number')
                        ->horizontal()
                        ->title('Website Phone Number')
                        ->placeholder('Enter website phone number')
                        ->type('number')
                        ->value($configurations['website_phone_number'] ?? ''),
                    Input::make('website_mail')
                        ->horizontal()
                        ->title('Website Email')
                        ->placeholder('Enter website email')
                        ->type('email')
                        ->value($configurations['website_mail'] ?? ''),
                    Cropper::make('website_logo_header')
                        ->title('Website Logo Header')
                        ->keepAspectRatio()
                        ->value($websiteLogoHeader)
                        ->targetUrl()
                        ->horizontal(),
                    Cropper::make('website_logo_footer')
                        ->title('Website Logo Footer')
                        ->keepAspectRatio()
                        ->value($websiteLogoFooter)
                        ->targetUrl()
                        ->horizontal(),
                    Cropper::make('main_picture_about')
                        ->title('Main Picture (595x629)')
                        ->maxWidth(595)
                        ->maxHeight(629)
                        ->value($configurations['main_picture_about'] ?? '')
                        ->horizontal(),
                    Switcher::make('is_maintenance')
                        ->sendTrueOrFalse()
                        ->title('Maintenance')
                        ->value($configurations['is_maintenance'] ?? '')
                        ->horizontal()
                ]),
                'Social Media' => Layout::rows([
                    Input::make('facebook')
                        ->horizontal()
                        ->title('Facebook')
                        ->placeholder('Enter facebook url')
                        ->type('url')
                        ->value($configurations['facebook'] ?? ''),
                    Input::make('twitter')
                        ->horizontal()
                        ->title('Twitter')
                        ->placeholder('Enter twitter url')
                        ->type('url')
                        ->value($configurations['facebook'] ?? ''),
                    Input::make('instagram')
                        ->horizontal()
                        ->title('Instagram')
                        ->placeholder('Enter instagram url')
                        ->type('url')
                        ->value($configurations['instagram'] ?? ''),
                ]),
                'Policies' =>
                Layout::rows([
                    Quill::make('terms_conditions')
                        ->horizontal()
                        ->value($configurations['terms_conditions'] ?? '')
                        ->title('Terms and Conditions'),
                    Quill::make('privacy_policy')
                        ->horizontal()
                        ->value($configurations['privacy_policy'] ?? '')
                        ->title('Privacy Policy'),
                ]),
                'Banner' =>
                Layout::rows([
                    Cropper::make('banner_menu_about')
                        ->title('Banner Menu About Us (1920x350)')
                        ->maxWidth(1920)
                        ->maxHeight(350)
                        ->value($configurations['banner_menu_about'] ?? '')
                        ->targetUrl()
                        ->horizontal(),
                    Cropper::make('banner_menu_program')
                        ->title('Banner Menu Program (1920x350)')
                        ->maxWidth(1920)
                        ->maxHeight(350)
                        ->value($configurations['banner_menu_program'] ?? '')
                        ->targetUrl()
                        ->horizontal(),
                    Cropper::make('banner_menu_facility')
                        ->title('Banner Menu Fasilitas (1920x350)')
                        ->maxWidth(1920)
                        ->maxHeight(350)
                        ->value($configurations['banner_menu_facility'] ?? '')
                        ->targetUrl()
                        ->horizontal(),
                    Cropper::make('banner_menu_news')
                        ->title('Banner Menu News (1920x350)')
                        ->maxWidth(1920)
                        ->maxHeight(350)
                        ->value($configurations['banner_menu_news'] ?? '')
                        ->targetUrl()
                        ->horizontal(),
                    Cropper::make('banner_menu_gallery')
                        ->title('Banner Menu Gallery (1920x350)')
                        ->maxWidth(1920)
                        ->maxHeight(350)
                        ->value($configurations['banner_menu_gallery'] ?? '')
                        ->targetUrl()
                        ->horizontal(),
                    Cropper::make('banner_menu_contact')
                        ->title('Banner Menu Contact Us(1920x350)')
                        ->maxWidth(1920)
                        ->maxHeight(350)
                        ->value($configurations['banner_menu_contact'] ?? '')
                        ->targetUrl()
                        ->horizontal(),
                    Cropper::make('main_banner')
                        ->title('Main Banner (1920×790)')
                        ->maxWidth(1920)
                        ->maxHeight(790)
                        ->value($configurations['main_banner'] ?? '')
                        ->targetUrl()
                        ->horizontal(),
                ]),
            ]),
        ];
    }

    /**
     * @param Configuration    $configuration
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request)
    {
        $configurations = $request->except('_token');

        foreach ($configurations as $key => $value) {
            $configuration = Configuration::where('key', $key)->first();
            if (!$configuration) {
                $configuration = new Configuration();
                $configuration->key = $key;
            }
            if ($value !== null) {
                $configuration->value = $value;
                $configuration->save();
            } else {
                $configuration->delete();
            }
        }

        Toast::info(__('Configuration was saved.'));

        return redirect()->route('platform.systems.configurations');
    }
}
