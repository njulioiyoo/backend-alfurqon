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
        return 'Facility';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'Our venue offers a range of carefully designed facilities to cater to diverse needs. From the serene Prayer Room on the 2nd floor to the elegant VIP Room for special guests, each area is crafted with special attention. The multipurpose hall on the 1st floor provides flexibility for large events, while the TPQ Learning Room on the 2nd floor is dedicated to Quranic education. The Administration Room ensures efficient administrative operations. Additional amenities include ample parking space for visitor convenience, equipped with CCTV surveillance for security. All of these make our venue an ideal choice for various activities, from religious gatherings to business and social events.';
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
