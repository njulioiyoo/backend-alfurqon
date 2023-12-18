<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\TD;
use Illuminate\Support\Str;
use App\Models\Content;
use App\Models\Program;

class PlatformScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $totalContent = Content::where([
            ['active', '=', 1],
            ['parent_id', '!=', null]
        ])->count();

        return [
            'news' => Content::where([
                ['active', '=', 1],
                ['parent_id', '!=', null]
            ])->orderBy('viewed', 'desc')->paginate(5),
            'metrics' => [
                // 'program'   => ['value' => $programTotalViewedToday, 'diff' => $programPercentChange],
                // 'program'   => ['value' => $programTotalViewedToday, 'diff' => $programPercentChange],
                // 'news'      => ['value' => $newsTotalViewedToday, 'diff' => $newsPercentChange],
                'content'    => ['value' => number_format($totalContent)],
            ],
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Get Started';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'Welcome to your ' . env('APP_NAME') . ' application.';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            // Layout::view('platform::partials.update-assets'),
            // Layout::view('platform::partials.welcome'),
            Layout::metrics([
                // 'Total Program Visitors Today'    => 'metrics.program',
                // 'Total News Visitors Today' => 'metrics.news',
                'Total Contents & VOD' => 'metrics.content',
            ]),
            Layout::table('news', [
                TD::make('image', 'Image')
                    ->width('150')
                    ->render(fn (Content $model) => // Please use view('path')
                    "<img src='{$model->image}'
                              alt='sample'
                              class='mw-100 d-block img-fluid rounded-1 w-100'>
                            <span class='small text-muted mt-1 mb-0'># {$model->type}</span>"),
                TD::make('body', 'Body')
                    ->width('450')
                    ->render(fn (Content $model) => Str::limit($model->body, 200)),
                TD::make('viewed', 'Viewed')
                    ->render(fn (Content $model) => $model->viewed),
                TD::make('author', __('Author'))
                    ->sort()
                    ->render(fn (Content $article) => $article->user->name),
                TD::make('created_at', __('Created'))
                    ->sort()
                    ->render(fn (Content $news) => $news->created_at),
            ]),
        ];
    }
}
