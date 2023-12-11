<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Gallery\Video;

use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\TD;

class VideoEditLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {

        return [
            Input::make('source')
                ->title('Youtube URL')
                ->placeholder('Share youtube id video on your Video')
                ->help('Specify a short descriptive title for this video.'),

            Group::make([
                Switcher::make('active')
                    ->sendTrueOrFalse()
                    ->align(TD::ALIGN_RIGHT)
                    ->help('Slide the switch to on to change it to true.')
                    ->title('Status'),
            ]),
        ];
    }
}
