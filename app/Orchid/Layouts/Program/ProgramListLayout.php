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
            TD::make('name', 'Name')
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (Program $program) {
                    return Link::make($program->name)
                        ->route('platform.systems.program.edit', $program);
                }),

            TD::make(__('Image'))
                ->render(function (Program $program) {
                    return '<img src="' . $program->image . '" width="100">';
                }),

            TD::make('is_highlight', __('Highlight Article'))
                ->sort()
                ->render(fn (Program $program) => $program->is_highlight ? '<i class="text-success">●</i> True'
                    : '<i class="text-danger">●</i> False'),

            TD::make('viewed', __('Total Viewed'))
                ->sort()
                ->render(fn (Program $program) => $program->viewed),

            TD::make('parent_id', __('Categories'))
                ->sort()
                ->render(fn (Program $program) => $program->parent->name ?? null),

            TD::make('author', __('Author'))
                ->sort()
                ->render(fn (Program $program) => $program->user->name),

            TD::make('updated_at', __('Last edit'))
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

                        // Link::make(__('Edit'))
                        //     ->route('platform.systems.article.edit', $program->id)
                        //     ->icon('pencil'),

                        Button::make(__('Delete'))
                            ->icon('trash')
                            ->confirm(__('Once the article is deleted, all of its resources and data will be permanently deleted. Before deleting your article, please download any data or information that you wish to retain.'))
                            ->method('remove', [
                                'id' => $program->id,
                            ]),
                    ])),
        ];
    }
}
