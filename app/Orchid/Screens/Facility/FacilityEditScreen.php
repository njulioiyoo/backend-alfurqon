<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Facility;

use Orchid\Screen\Action;
use Orchid\Screen\Screen;
use App\Models\ContentType;
use App\Models\Facility;
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

class FacilityEditScreen extends Screen
{
    /**
     * @var Facility
     */
    public $facility;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @param Facility $facility
     *
     * @return array
     */
    public function query(Facility $facility): array
    {
        $facility->load('attachment');

        return [
            'facility' => $facility
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->facility->exists ? 'Mengedit Fasilitas' : 'Membuat Fasilitas Baru';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return "Buat fasilitas dengan mudah menggunakan platform ramah pengguna kami. Buat artikel menarik, unggah media, dan pilih kategori yang relevan. Fasilitas Anda, sesuai keinginan Anda. Tingkatkan kreativitas konten Anda dengan proses pembuatan fasilitas yang intuitif.";
    }

    /**
     * @return iterable|null
     */
    public function permission(): ?iterable
    {
        return [
            'platform.systems.facility',
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
                ->confirm(__('Once the facility is deleted, all of its resources and data will be permanently deleted. Before deleting your facility, please download any data or information that you wish to retain.'))
                ->method('remove')
                ->canSee($this->facility->exists),

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
                Relation::make('facility.parent_id')
                    ->title('Content Categories')
                    ->required()
                    ->horizontal()
                    ->fromModel(ContentType::class, 'name')->applyScope('facilityType'),

                Input::make('facility.name')
                    ->title('Name')
                    ->horizontal()
                    ->required()
                    ->placeholder('Attractive but mysterious name')
                    ->help('Specify a short descriptive name for this facility.'),

                Cropper::make('facility.image')
                    ->title('Image (370x300)')
                    ->maxWidth(370)
                    ->maxHeight(300)
                    ->horizontal(),

                TextArea::make('facility.description')
                    ->title('Description')
                    ->horizontal()
                    ->required()
                    ->rows(3)
                    ->maxlength(200)
                    ->placeholder('Brief description for preview'),

                Quill::make('facility.body')
                    ->horizontal()
                    ->required()
                    ->title('Main text'),


                Group::make([
                    Switcher::make('facility.is_highlight')
                        ->sendTrueOrFalse()
                        ->align(TD::ALIGN_RIGHT)
                        ->help('Slide the switch to on to change it to true.')
                        ->title('Highlight Facility'),

                    Switcher::make('facility.active')
                        ->sendTrueOrFalse()
                        ->align(TD::ALIGN_RIGHT)
                        ->help('Slide the switch to on to change it to true.')
                        ->title('Status'),
                ]),
            ])

        ];
    }

    /**
     * @param Facility    $facility
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Facility $facility, Request $request)
    {
        $data = $request->get('facility');
        $data['slug']   = Str::slug($data['name']);
        $data['image']  = url('' . $data['image']);

        $facility->fill($data)->save();

        Toast::info(__('Facility was saved.'));

        return redirect()->route('platform.systems.facility');
    }

    /**
     * @param Facility $facility
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Facility $facility)
    {
        $facility->delete();

        Toast::info(__('Facility was removed'));

        return redirect()->route('platform.systems.facility');
    }
}
