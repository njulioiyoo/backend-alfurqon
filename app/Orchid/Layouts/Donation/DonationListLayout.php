<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Donation;

use App\Models\Donation;
use Orchid\Screen\TD;
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
    public $target = 'donation';

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
                ->render(function (Donation $donation) {
                    return Link::make($donation->name)
                        ->route('platform.systems.donation.edit', $donation);
                }),

            TD::make(__('Gambar'))
                ->render(function (Donation $donation) {
                    return '<img src="' . $donation->image . '" width="100">';
                }),

            TD::make('is_highlight', __('Donasi Unggulan'))
                ->sort()
                ->render(fn (Donation $donation) => $donation->is_highlight ? '<i class="text-success">●</i> True'
                    : '<i class="text-danger">●</i> False'),

            TD::make('viewed', __('Jumlah Dilihat'))
                ->sort()
                ->render(fn (Donation $donation) => $donation->viewed),

            TD::make('start_date', __('Tanggal Dimulai'))
                ->sort()
                ->render(fn (Donation $donation) => $donation->start_date),

            TD::make('end_date', __('Tanggal Berakhir'))
                ->sort()
                ->render(fn (Donation $donation) => $donation->end_date),

            TD::make('author', __('Penulis'))
                ->sort()
                ->render(fn (Donation $donation) => $donation->user->name),

            TD::make('updated_at', __('Edit terakhir'))
                ->sort()
                ->render(fn (Donation $donation) => $donation->updated_at),

            TD::make('active', __('Status'))
                ->sort()
                ->render(fn (Donation $donation) => $donation->active ? '<i class="text-success">●</i> True'
                    : '<i class="text-danger">●</i> False'),

            TD::make(__('Tindakan'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Donation $donation) => DropDown::make()
                    ->icon('options-vertical')
                    ->list([
                        Button::make(__('Hapus'))
                            ->icon('trash')
                            ->confirm(__('Setelah donasi dihapus, semua sumber daya dan data akan dihapus secara permanen. Sebelum menghapus donasi Anda, harap unduh semua data atau informasi yang ingin Anda simpan.'))
                            ->method('remove', [
                                'id' => $donation->id,
                            ]),
                    ])),
        ];
    }
}
