<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Donation;

use Orchid\Screen\TD;
use App\Models\News;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;

class DonationListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'news';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('name', 'Nama')
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (News $news) {
                    return Link::make($news->name)
                        ->route('platform.systems.news.edit', $news);
                }),

            TD::make(__('Gambar'))
                ->render(function (News $news) {
                    return '<img src="' . $news->image . '" width="100">';
                }),

            TD::make('is_highlight', __('Donasi Unggulan'))
                ->sort()
                ->render(fn (News $news) => $news->is_highlight ? '<i class="text-success">●</i> True'
                    : '<i class="text-danger">●</i> False'),

            TD::make('viewed', __('Jumlah Dilihat'))
                ->sort()
                ->render(fn (News $news) => $news->viewed),

            TD::make('parent_id', __('Kategori'))
                ->sort()
                ->render(fn (News $news) => $news->parent->name),

            TD::make('author', __('Penulis'))
                ->sort()
                ->render(fn (News $news) => $news->user->name),

            TD::make('updated_at', __('Edit terakhir'))
                ->sort()
                ->render(fn (News $news) => $news->updated_at),

            TD::make('active', __('Status'))
                ->sort()
                ->render(fn (News $news) => $news->active ? '<i class="text-success">●</i> True'
                    : '<i class="text-danger">●</i> False'),

            TD::make(__('Tindakan'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (News $news) => DropDown::make()
                    ->icon('options-vertical')
                    ->list([
                        Button::make(__('Hapus'))
                            ->icon('trash')
                            ->confirm(__('Setelah donasi dihapus, semua sumber daya dan data akan dihapus secara permanen. Sebelum menghapus donasi Anda, harap unduh semua data atau informasi yang ingin Anda simpan.'))
                            ->method('remove', [
                                'id' => $news->id,
                            ]),
                    ])),
        ];
    }
}
