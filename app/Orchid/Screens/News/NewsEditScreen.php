<?php

declare(strict_types=1);

namespace App\Orchid\Screens\News;

use App\Models\User;
use Orchid\Screen\Action;
use Orchid\Screen\Screen;
use App\Models\ContentType;
use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Fields\Cropper;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\TD;

class NewsEditScreen extends Screen
{
    /**
     * @var News
     */
    public $news;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @param News $news
     *
     * @return array
     */
    public function query(News $news): array
    {
        $news->load('attachment');

        return [
            'news' => $news
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->news->exists ? 'Mengedit Berita' : 'Membuat Berita Baru';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return "Buat berita dengan mudah menggunakan platform ramah pengguna kami. Buat artikel menarik, unggah media, dan pilih kategori yang relevan. Berita Anda, sesuai keinginan Anda. Tingkatkan kreativitas pembuatan konten Anda dengan proses pembuatan berita yang intuitif.";
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
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Remove'))
                ->icon('trash')
                ->confirm(__('Once the news is deleted, all of its resources and data will be permanently deleted. Before deleting your News, please download any data or information that you wish to retain.'))
                ->method('remove')
                ->canSee($this->news->exists),

            Button::make(__('Save'))
                ->icon('check')
                ->method('save'),
        ];
    }

    /**
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [

            Layout::rows([
                Relation::make('news.parent_id')
                    ->title('Content Categories')
                    ->required()
                    ->horizontal()
                    ->fromModel(ContentType::class, 'name')->applyScope('newsType'),

                Input::make('news.name')
                    ->title('Name')
                    ->horizontal()
                    ->required()
                    ->placeholder('Attractive but mysterious name')
                    ->help('Specify a short descriptive name for this news.'),

                Cropper::make('news.image')
                    ->title('Image (370x300)')
                    ->maxWidth(370)
                    ->maxHeight(300)
                    ->horizontal(),

                TextArea::make('news.description')
                    ->title('Description')
                    ->horizontal()
                    ->required()
                    ->rows(3)
                    ->maxlength(200)
                    ->placeholder('Brief description for preview'),

                Quill::make('news.body')
                    ->horizontal()
                    ->required()
                    ->title('Main text'),


                Group::make([
                    Switcher::make('news.is_highlight')
                        ->sendTrueOrFalse()
                        ->align(TD::ALIGN_RIGHT)
                        ->help('Slide the switch to on to change it to true.')
                        ->title('Highlight News'),

                    Switcher::make('news.active')
                        ->sendTrueOrFalse()
                        ->align(TD::ALIGN_RIGHT)
                        ->help('Slide the switch to on to change it to true.')
                        ->title('Status'),
                ]),
            ])

        ];
    }

    /**
     * @param News    $news
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(News $news, Request $request)
    {
        $data = $request->get('news');
        $data['slug']   = Str::slug($data['name']);
        $data['image']  = url('' . $data['image']);

        $news->fill($data)->save();

        Toast::info(__('News was saved.'));

        return redirect()->route('platform.systems.news');
    }

    /**
     * @param News $news
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(News $news)
    {
        $news->delete();

        Toast::info(__('News was removed'));

        return redirect()->route('platform.systems.news');
    }
}
