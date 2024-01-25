<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Facility;

use Orchid\Screen\TD;
use App\Models\Facility;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;

class FacilityListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'facility';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('name', 'Name')
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (Facility $facility) {
                    return Link::make($facility->name)
                        ->route('platform.systems.facility.edit', $facility);
                }),

            TD::make(__('Image'))
                ->render(function (Facility $facility) {
                    return '<img src="' . $facility->image . '" width="100">';
                }),

            TD::make('is_highlight', __('Highlight Article'))
                ->sort()
                ->render(fn (Facility $facility) => $facility->is_highlight ? '<i class="text-success">●</i> True'
                    : '<i class="text-danger">●</i> False'),

            TD::make('viewed', __('Total Viewed'))
                ->sort()
                ->render(fn (Facility $facility) => $facility->viewed),

            TD::make('parent_id', __('Categories'))
                ->sort()
                ->render(fn (Facility $facility) => $facility->parent->name ?? null),

            TD::make('author', __('Author'))
                ->sort()
                ->render(fn (Facility $facility) => $facility->user->name),

            TD::make('updated_at', __('Last edit'))
                ->sort()
                ->render(fn (Facility $facility) => $facility->updated_at),

            TD::make('active', __('Status'))
                ->sort()
                ->render(fn (Facility $facility) => $facility->active ? '<i class="text-success">●</i> True'
                    : '<i class="text-danger">●</i> False'),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Facility $facility) => DropDown::make()
                    ->icon('options-vertical')
                    ->list([

                        // Link::make(__('Edit'))
                        //     ->route('platform.systems.article.edit', $facility->id)
                        //     ->icon('pencil'),

                        Button::make(__('Delete'))
                            ->icon('trash')
                            ->confirm(__('Once the article is deleted, all of its resources and data will be permanently deleted. Before deleting your article, please download any data or information that you wish to retain.'))
                            ->method('remove', [
                                'id' => $facility->id,
                            ]),
                    ])),
        ];
    }
}
