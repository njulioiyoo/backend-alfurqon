<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\MasterData\ContentType;

use Orchid\Screen\TD;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\Group;

class ContentTypeEditLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Select::make('contentType.type')
                ->options([
                    'news_type' => 'News',
                    'program_type' => 'Program',
                    'facility_type' => 'Facility',
                ])
                ->title('Select type')
                ->help('Allow search bots to index'),

            Input::make('contentType.name')
                ->type('text')
                ->max(50)
                ->required()
                ->title(__('Name'))
                ->placeholder(__('Name')),

            Group::make([
                Input::make('contentType.attr_2')
                    ->title('Order Position')
                    ->type('number')
                    ->placeholder('Enter Order Position')
                    ->help('The number of the Order Position to be created.'),

                Switcher::make('contentType.active')
                    ->sendTrueOrFalse()
                    ->align(TD::ALIGN_RIGHT)
                    ->help('Slide the switch to on to change it to true.')
                    ->title('Status Active'),
            ]),
        ];
    }
}
