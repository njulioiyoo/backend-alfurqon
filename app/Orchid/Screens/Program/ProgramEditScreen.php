<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Program;

use App\Models\User;
use Orchid\Screen\Action;
use Orchid\Screen\Screen;
use App\Models\ContentType;
use App\Models\News;
use App\Models\Program;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Fields\Cropper;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\TD;

class ProgramEditScreen extends Screen
{
    /**
     * @var Program
     */
    public $program;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @param Program $program
     *
     * @return array
     */
    public function query(Program $program): array
    {
        $program->load('attachment');

        return [
            'program' => $program
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->program->exists ? 'Edit Program' : 'Creating a New Program';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return "Create program effortlessly with our user-friendly platform. Craft engaging articles, upload media, and choose relevant categories. Your program, your way. Empower your content creation with our intuitive program creation process.";
    }

    /**
     * @return iterable|null
     */
    public function permission(): ?iterable
    {
        return [
            'platform.systems.program',
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
            Button::make(__('Remove'))
                ->icon('trash')
                ->confirm(__('Once the program is deleted, all of its resources and data will be permanently deleted. Before deleting your Program, please download any data or information that you wish to retain.'))
                ->method('remove')
                ->canSee($this->program->exists),

            Button::make(__('Save'))
                ->icon('check')
                ->method('save'),
        ];
    }

    /**
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [

            Layout::rows([
                Relation::make('program.author')
                    ->title('Author')
                    ->required()
                    ->horizontal()
                    ->fromModel(User::class, 'name'),

                Relation::make('program.parent_id')
                    ->title('Content Categories')
                    ->required()
                    ->horizontal()
                    ->fromModel(ContentType::class, 'name')->applyScope('programType'),

                Input::make('program.name')
                    ->title('Name')
                    ->horizontal()
                    ->required()
                    ->placeholder('Attractive but mysterious name')
                    ->help('Specify a short descriptive name for this program.'),

                Cropper::make('program.image')
                    ->title('Image')
                    ->width(1000)
                    ->height(476)
                    ->keepAspectRatio()
                    ->horizontal(),

                TextArea::make('program.description')
                    ->title('Description')
                    ->horizontal()
                    ->required()
                    ->rows(3)
                    ->maxlength(200)
                    ->placeholder('Brief description for preview'),

                Quill::make('program.body')
                    ->horizontal()
                    ->required()
                    ->title('Main text'),


                Group::make([
                    Switcher::make('program.is_highlight')
                        ->sendTrueOrFalse()
                        ->align(TD::ALIGN_RIGHT)
                        ->help('Slide the switch to on to change it to true.')
                        ->title('Highlight News'),

                    Switcher::make('program.active')
                        ->sendTrueOrFalse()
                        ->align(TD::ALIGN_RIGHT)
                        ->help('Slide the switch to on to change it to true.')
                        ->title('Status'),
                ]),
            ])

        ];
    }

    /**
     * @param Program    $program
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Program $program, Request $request)
    {
        $data = $request->get('program');
        $data['slug']   = Str::slug($data['name']);
        $data['image']  = url('' . $data['image']);

        $program->fill($data)->save();

        Toast::info(__('Program was saved.'));

        return redirect()->route('platform.systems.program');
    }

    /**
     * @param Program $program
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Program $program)
    {
        $program->delete();

        Toast::info(__('Program was removed'));

        return redirect()->route('platform.systems.program');
    }
}
