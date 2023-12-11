<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Gallery\Photo;

use Orchid\Screen\Action;
use Orchid\Screen\Screen;
use Illuminate\Support\Str;
use App\Models\Photo;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Fields\Cropper;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Switcher;

class EventPhotoEditScreen extends Screen
{
    /**
     * @var Photo
     */
    public $photo;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @param Photo $photo
     *
     * @return array
     */
    public function query(Photo $photo): array
    {
        $photo->load('attachment');

        return [
            'photo' => $photo
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->photo->exists ? 'Edit Photo' : 'Creating a New Photo';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return "Blog Photo";
    }

    /**
     * @return iterable|null
     */
    public function permission(): ?iterable
    {
        return [
            'platform.systems.gallery.photo',
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
                ->confirm(__('Once the photo is deleted, all of its resources and data will be permanently deleted. Before deleting your photo, please download any data or information that you wish to retain.'))
                ->method('remove')
                ->canSee($this->photo->exists),

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
                Input::make('photo.body')
                    ->title('Description')
                    ->horizontal()
                    ->required()
                    ->placeholder('Attractive but mysterious description')
                    ->help('Specify a short descriptive name for this photo.'),

                Cropper::make('photo.image')
                    ->title('Image')
                    ->required()
                    ->width(1000)
                    ->height(476)
                    ->keepAspectRatio()
                    ->horizontal(),

                Switcher::make('photo.active')
                    ->sendTrueOrFalse()
                    ->title('Status')
                    ->horizontal(),
            ])

        ];
    }

    /**
     * @param Photo    $photo
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Photo $photo, Request $request)
    {
        $data = $request->get('photo');
        $data['image']  = url('' . $data['image']);
        $photo->fill($data)->save();

        Toast::info(__('Photo was saved.'));

        return redirect()->route('platform.systems.gallery.photo');
    }

    /**
     * @param Photo $photo
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Photo $photo)
    {
        $photo->delete();

        Toast::info(__('Photo was removed'));

        return redirect()->route('platform.systems.gallery.photo');
    }
}
