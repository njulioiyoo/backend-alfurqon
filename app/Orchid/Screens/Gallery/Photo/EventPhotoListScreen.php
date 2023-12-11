<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Gallery\Photo;

use Orchid\Screen\Screen;
use App\Models\Photo;
use App\Orchid\Layouts\Gallery\Photo\PhotoListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Toast;

class EventPhotoListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'photo' => Photo::latest()->paginate(10),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Mosque Moments';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'Explore the soul of our mosque through a visual journey of prayer, community events, and diverse activities. From serene prayer scenes to joyous celebrations, our curated photos encapsulate the spiritual ambiance and vibrancy of our sacred space.';
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
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Add'))
                ->icon('plus')
                ->route('platform.systems.gallery.photo.create'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return string[]|\Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            PhotoListLayout::class
        ];
    }

    /**
     * @param Request $request
     */
    public function remove(Request $request): void
    {
        Photo::findOrFail($request->get('id'))->delete();

        Toast::info(__('Photo was removed'));
    }
}
