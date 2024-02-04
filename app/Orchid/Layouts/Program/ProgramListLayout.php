<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Program;

use Orchid\Screen\TD;
use App\Models\Program;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;

class ProgramListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'program';

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
                ->render(function (Program $program) {
                    return Link::make($program->name)
                        ->route('platform.systems.program.edit', $program);
                }),

            TD::make(__('Gambar'))
                ->render(function (Program $program) {
                    return '<img src="' . $program->image . '" width="100">';
                }),

            TD::make('is_highlight', __('Program Unggulan'))
                ->sort()
                ->render(fn (Program $program) => $program->is_highlight ? '<i class="text-success">●</i> True'
                    : '<i class="text-danger">●</i> False'),

            TD::make('is_banner_donation', __('Tampilkan Banner Donation'))
                ->sort()
                ->render(fn (Program $program) => $program->is_banner_donation ? '<i class="text-success">●</i> True'
                    : '<i class="text-danger">●</i> False'),

            TD::make('source_type', __('Tipe Program'))
                ->sort()
                ->render(fn (Program $program) => $program->source_type),

            TD::make('viewed', __('Total Dilihat'))
                ->sort()
                ->render(fn (Program $program) => $program->viewed),

            TD::make('source_type', __('Tipe Program'))
                ->sort()
                ->render(fn (Program $program) => $program->source_type),

            TD::make('parent_id', __('Konten Kategori'))
                ->sort()
                ->render(fn (Program $program) => $program->parent->name ?? null),

            TD::make('author', __('Penulis'))
                ->sort()
                ->render(fn (Program $program) => $program->user->name),

            TD::make('updated_at', __('Edit terakhir'))
                ->sort()
                ->render(fn (Program $program) => $program->updated_at),

            TD::make('active', __('Status'))
                ->sort()
                ->render(fn (Program $program) => $program->active ? '<i class="text-success">●</i> True'
                    : '<i class="text-danger">●</i> False'),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Program $program) => DropDown::make()
                    ->icon('options-vertical')
                    ->list([
                        Button::make(__('Hapus'))
                            ->icon('trash')
                            ->confirm(__('Setelah program dihapus, semua sumber daya dan data akan dihapus secara permanen. Sebelum menghapus program Anda, harap unduh semua data atau informasi yang ingin Anda simpan.'))
                            ->method('remove', [
                                'id' => $program->id,
                            ]),
                    ])),
        ];
    }
}
