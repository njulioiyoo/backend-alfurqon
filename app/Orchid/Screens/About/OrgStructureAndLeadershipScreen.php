<?php

namespace App\Orchid\Screens\About;

use App\Models\About;
use Orchid\Screen\Action;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use App\Models\Configuration;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Cropper;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Switcher;

class OrgStructureAndLeadershipScreen extends Screen
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
        return 'Organizational Structure and Leadership';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'Explore the organizational structure and leadership of the mosque';
    }

    /**
     * @return iterable|null
     */
    public function permission(): ?iterable
    {
        return [
            'platform.systems.about.organizational-structure-and-leadership',
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
        $about = About::select('type', 'slug', 'name', 'image', 'attr_1', 'attr_2', 'body', 'active')->where([
            'type' => 'about',
            'slug' => 'organizational-structure-and-leadership',
        ])->first();

        return [
            Layout::rows([
                Input::make('name')
                    ->horizontal()
                    ->title('Name')
                    ->placeholder('Enter name')
                    ->value($about['name'] ?? ''),

                Cropper::make('image')
                    ->title('Main Banner (1920×350)')
                    ->maxWidth(1920)
                    ->maxHeight(350)
                    ->value($about['image'] ?? '')
                    ->keepAspectRatio()
                    ->horizontal(),

                Cropper::make('attr_2')
                    ->title('Banner (570×420)')
                    ->maxWidth(570)
                    ->maxHeight(420)
                    ->value($about['attr_2'] ?? '')
                    ->keepAspectRatio()
                    ->horizontal(),

                Quill::make('body')
                    ->horizontal()
                    ->title('Description')
                    ->value($about['body'] ?? '')
                    ->options([
                        'theme' => 'bubble',
                    ]),

                Input::make('attr_1')
                    ->horizontal()
                    ->title('Youtube URL')
                    ->value($about['attr_1'] ?? '')
                    ->placeholder('Enter Youtube URL')
                    ->type('url'),

                Switcher::make('active')
                    ->sendTrueOrFalse()
                    ->title('Status Active')
                    ->value($about['active'] ?? '')
                    ->horizontal()
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
        $request->validate([
            'body' => 'sometimes|string'
        ]);

        $slug = 'organizational-structure-and-leadership';

        About::updateOrCreate(
            ['type' => 'about', 'slug' => $slug],
            [
                'name' => $request->input('name'),
                'image' => $request->file('image') ? $request->file('image')->store('images') : null,
                'attr_2' => $request->file('attr_2') ? $request->file('attr_2')->store('images') : null,
                'body' => $request->input('body'),
                'attr_1' => $request->input('attr_1'),
                'active' => $request->input('active', false),
            ]
        );

        Toast::info(__('Organizational Structure and Leadership was saved.'));

        return redirect()->route('platform.systems.about.organizational-structure-and-leadership');
    }
}
