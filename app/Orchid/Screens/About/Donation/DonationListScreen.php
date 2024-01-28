<?php

declare(strict_types=1);

namespace App\Orchid\Screens\About\Donation;

use App\Models\News;
use App\Orchid\Layouts\News\NewsListLayout;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Toast;

class DonationListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'news' => News::latest()->paginate(10),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Donasi untuk membuat perbedaan';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'Bergabunglah dalam misi kami untuk membantu mereka yang membutuhkan. Dengan menyumbang, Anda memainkan peran penting dalam mengubah hidup orang-orang di sekitar kita. Setiap sumbangan, besar atau kecil, membantu menyediakan makanan, pendidikan, layanan kesehatan, dan harapan bagi mereka yang kurang beruntung.';
    }

    /**
     * @return iterable|null
     */
    public function permission(): ?iterable
    {
        return [
            'platform.systems.news',
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
                ->route('platform.systems.news.create'),
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
            NewsListLayout::class,
        ];
    }

    /**
     * @param Request $request
     */
    public function remove(Request $request): void
    {
        News::findOrFail($request->get('id'))->delete();

        Toast::info(__('News was removed'));
    }
}
