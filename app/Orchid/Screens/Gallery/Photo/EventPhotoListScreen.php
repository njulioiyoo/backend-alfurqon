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
        return 'Galeri Kegiatan DKM';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'Dokumentasi kegiatan DKM Masjid Besar Al Furqon Bekasi Barat dan aktifitas social kemasyarakatan dalam rangka kegiatan rutin ataupun kegaiatan dengan melibatkan pihak pihak lainnya.';
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
