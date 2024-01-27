<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Gallery\Video;

use App\Models\Video;
use App\Orchid\Layouts\Gallery\Video\VideoEditLayout;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Switcher;
use Illuminate\Support\Str;
use Google_Service_YouTube;
use Google_Client;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\TD;

class EventVideoScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'video' => Video::latest()->get(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Galeri Kegiatan DKM';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'Dokumentasi kegiatan DKM Masjid Besar Al Furqon Bekasi Barat dan aktifitas social kemasyarakatan dalam rangka kegiatan rutin ataupun kegaiatan dengan melibatkan pihak pihak lainnya.';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Add')
                ->modal('VideoModal')
                ->method('createOrUpdate')
                ->icon('plus'),
        ];
    }

    /**
     * @return iterable|null
     */
    public function permission(): ?iterable
    {
        return [
            'platform.systems.gallery.video',
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return string[]|\Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('video', [
                TD::make('name', __('Name'))
                    ->sort()
                    ->cantHide()
                    ->filter(Input::make())
                    ->render(fn (Video $video) => ModalToggle::make($video->name)
                        ->modal('asyncEditVideoModal')
                        ->modalTitle($video->presenter()->title())
                        ->method('createOrUpdate')
                        ->asyncParameters([
                            'video' => $video->id,
                        ])),

                TD::make(__('Image'))
                    ->render(function (Video $video) {
                        return '<img src="' . $video->image . '" width="100">';
                    }),

                TD::make('attr_1', __('Duration'))
                    ->sort()
                    ->render(fn (Video $video) => $video->attr_1),
                TD::make('updated_at', __('Last edit'))
                    ->sort()
                    ->render(fn (Video $video) => $video->updated_at),

                TD::make('Actions')
                    ->render(function (Video $video) {
                        return Button::make('Delete')
                            ->confirm('After deleting, the Video will be gone forever.')
                            ->method('delete', ['video' => $video->id]);
                    }),
            ]),
            Layout::modal('VideoModal', Layout::rows([
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
            ]))
                ->title('Create Video')
                ->applyButton('Add Video'),

            Layout::modal('asyncEditVideoModal', VideoEditLayout::class)
                ->async('asyncGetVideo'),
        ];
    }

    /**
     * @param Video $video
     *
     * @return array
     */
    public function asyncGetVideo(Video $video): iterable
    {
        return [
            'source'   => $video['source'],
            'active'   => $video['active'],
        ];
    }

    /**
     * @param Request $request
     * @param Video    $video
     */
    public function createOrUpdate(Request $request, Video $video): void
    {
        $request->validate([
            'source' => [
                'required'
            ],
        ]);

        $client = new Google_Client();
        $client->setDeveloperKey(env('YOUTUBE_API_KEY'));
        $youtube = new Google_Service_YouTube($client);

        $data = $request->except('_token');
        preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $data['source'], $matches);
        $youtubeId = $matches[1];

        $videoResponse = $youtube->videos->listVideos('snippet, contentDetails', array(
            'id' => $youtubeId
        ));
        $resultVideo = $videoResponse[0];
        $duration = $resultVideo->getContentDetails()->getDuration(); //durasi dalam format ISO 8601

        preg_match('/PT(\d+H)?(\d+M)?(\d+S)?/', $duration, $matches);
        $hours = isset($matches[1]) ? intval(str_replace('H', '', $matches[1])) : 0;
        $minutes = isset($matches[2]) ? intval(str_replace('M', '', $matches[2])) : 0;
        $seconds = isset($matches[3]) ? intval(str_replace('S', '', $matches[3])) : 0;
        $totalSeconds = $hours * 3600 + $minutes * 60 + $seconds;
        $formattedDuration = gmdate("i:s", $totalSeconds); // format to "mm:ss"

        $thumbnail = isset($resultVideo['snippet']['thumbnails']['maxres']['url']) ? $resultVideo['snippet']['thumbnails']['maxres']['url'] : null;
        if (!$thumbnail) {
            $thumbnail = isset($resultVideo['snippet']['thumbnails']['standard']['url']) ? $resultVideo['snippet']['thumbnails']['standard']['url'] : null;
        }

        $image = $thumbnail ?? $resultVideo['snippet']['thumbnails']['default']['url'];
        $create = array(
            'source' => $data['source'],
            'name' => $resultVideo['snippet']['title'],
            'slug' => Str::slug($resultVideo['snippet']['title']),
            'body' => $resultVideo['snippet']['description'],
            'attr_1' => $formattedDuration,
            'image' => $image,
            'active' => $data['active'],
        );

        $video->fill($create)->save();

        Toast::info(__('Video was saved.'));
    }

    /**
     * @param Video $video
     *
     * @return void
     */
    public function delete(Video $video)
    {
        $video->delete();
    }
}
