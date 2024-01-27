<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Facility;

use App\Models\Facility;
use App\Orchid\Layouts\Facility\FacilityListLayout;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Toast;

class FacilityListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'facility' => Facility::latest()->paginate(10),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Fasilitas';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'Berbagai fasilitas dan layanan yang tersedia di Masjid besar Al-Furqon Bekasi Barat, yang meliputi fasilitas tempat Ibadah yang luas dan nyaman beserta sarana tempat wudhu baik di dalam ataupun diluar Gedung tersedia juga tempat kamar kecil (restroom). Selain tempat ibadah terdapat Aula serbaguna “Graha Subagdja” yang dapat di gunakan untuk pertemuan dan acara resepsi pernikahan dan sebagainya. Area Parkir yang luas yang di lengkapi camera pengawas CCTV. Ruang Belajar TPQ di lantai 2 didedikasikan untuk pendidikan Alquran. Ruang Administrasi Kesekretariatan.';
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
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Add'))
                ->icon('plus')
                ->route('platform.systems.facility.create'),
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
            FacilityListLayout::class,
        ];
    }

    /**
     * @param Request $request
     */
    public function remove(Request $request): void
    {
        Facility::findOrFail($request->get('id'))->delete();

        Toast::info(__('Facility was removed'));
    }
}
