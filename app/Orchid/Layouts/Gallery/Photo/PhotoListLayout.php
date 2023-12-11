<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Gallery\Photo;

use Orchid\Screen\TD;
use App\Models\Photo;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Illuminate\Support\Str;

class PhotoListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'photo';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('body', 'Description')
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (Photo $photo) {
                    return Link::make(Str::limit($photo->body, 40))
                        ->route('platform.systems.gallery.photo.edit', $photo);
                }),

            TD::make(__('Image'))
                ->render(function (Photo $photo) {
                    return '<img src="' . $photo->image . '" width="100">';
                }),

            TD::make('active', __('Status'))
                ->sort()
                ->render(fn (Photo $photo) => $photo->active ? '<i class="text-success">●</i> True'
                    : '<i class="text-danger">●</i> False'),

            TD::make('updated_at', __('Last edit'))
                ->sort()
                ->render(fn (Photo $photo) => $photo->updated_at),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Photo $photo) => DropDown::make()
                    ->icon('options-vertical')
                    ->list([

                        Link::make(__('Edit'))
                            ->route('platform.systems.gallery.photo.edit', $photo->id)
                            ->icon('pencil'),

                        Button::make(__('Delete'))
                            ->icon('trash')
                            ->confirm(__('Once the partnership is deleted, all of its resources and data will be permanently deleted. Before deleting your partnership, please download any data or information that you wish to retain.'))
                            ->method('remove', [
                                'id' => $photo->id,
                            ]),
                    ])),
        ];
    }
}
