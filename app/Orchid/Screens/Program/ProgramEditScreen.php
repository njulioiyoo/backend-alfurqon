<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Program;

use Orchid\Screen\Action;
use Orchid\Screen\Screen;
use App\Models\ContentType;
use App\Models\User;
use App\Models\Program;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Fields\Cropper;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\TD;
use Google_Service_YouTube;
use Google_Client;

class ProgramEditScreen extends Screen
{
    /**
     * @var Program
     */
    public $program;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @param Program $program
     *
     * @return array
     */
    public function query(Program $program): array
    {
        $program->load('attachment');

        return [
            'program' => $program
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->program->exists ? 'Edit Program' : 'Creating a New Program';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return "Create program effortlessly with our user-friendly platform. Craft engaging articles, upload media, and choose relevant categories. Your program, your way. Empower your content creation with our intuitive program creation process.";
    }

    /**
     * @return iterable|null
     */
    public function permission(): ?iterable
    {
        return [
            'platform.systems.program',
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
                ->confirm(__('Once the program is deleted, all of its resources and data will be permanently deleted. Before deleting your Program, please download any data or information that you wish to retain.'))
                ->method('remove')
                ->canSee($this->program->exists),

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
                Relation::make('program.parent_id')
                    ->title('Content Categories')
                    ->required()
                    ->horizontal()
                    ->fromModel(ContentType::class, 'name')->applyScope('programType'),

                Input::make('program.name')
                    ->title('Name')
                    ->horizontal()
                    ->placeholder('Attractive but mysterious name')
                    ->help('Specify a short descriptive name for this program.'),

                Input::make('program.source')
                    ->title('Youtube URL')
                    ->horizontal()
                    ->type('url')
                    ->placeholder('Share youtube id video on your Video')
                    ->help('Specify a short descriptive title for this video.'),

                Cropper::make('program.image')
                    ->title('Image (370x300)')
                    ->maxWidth(370)
                    ->maxHeight(300)
                    ->horizontal(),

                TextArea::make('program.body')
                    ->title('Description')
                    ->horizontal()
                    ->rows(3)
                    ->placeholder('Brief description for preview'),

                Group::make([
                    Switcher::make('program.is_highlight')
                        ->sendTrueOrFalse()
                        ->align(TD::ALIGN_RIGHT)
                        ->help('Slide the switch to on to change it to true.')
                        ->title('Highlight Program'),

                    Switcher::make('program.active')
                        ->sendTrueOrFalse()
                        ->align(TD::ALIGN_RIGHT)
                        ->help('Slide the switch to on to change it to true.')
                        ->title('Status'),
                ]),
            ])

        ];
    }

    /**
     * @param Program    $program
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Program $program, Request $request)
    {
        $data = $request->get('program');

        if (!empty($data['source']) && ($resultVideo = $this->getYoutubeVideoDetails($this->extractYoutubeId($data['source'])))) {
            $formattedDuration = $this->formatDuration($resultVideo->getContentDetails()->getDuration());
            $image = $this->getVideoThumbnail($resultVideo);
        }

        $create = [
            'parent_id' => $data['parent_id'],
            'source' => $data['source'] ?? null,
            'name' => $data['name'] ?? $resultVideo->getSnippet()->getTitle(),
            'slug' => $data['source'] ? Str::slug($resultVideo->getSnippet()->getTitle()) : Str::slug($data['name']),
            'body' => $data['source'] ? $resultVideo->getSnippet()->getDescription() : $data['body'],
            'attr_1' => $data['source'] ? $formattedDuration : null,
            'image' => $data['image'] ? url($data['image']) : $image,
            'is_highlight' => $data['is_highlight'],
            'active' => $data['active'],
        ];

        $program->fill($create)->save();

        Toast::info(__('Program was saved.'));

        return redirect()->route('platform.systems.program');
    }

    /**
     * @param Program $program
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Program $program)
    {
        $program->delete();

        Toast::info(__('Program was removed'));

        return redirect()->route('platform.systems.program');
    }

    private function extractYoutubeId($url)
    {
        preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
        return $matches[1];
    }

    private function getYoutubeVideoDetails($youtubeId)
    {
        $client = new Google_Client();
        $client->setDeveloperKey(env('YOUTUBE_API_KEY'));
        $youtube = new Google_Service_YouTube($client);

        $videoResponse = $youtube->videos->listVideos('snippet, contentDetails', ['id' => $youtubeId]);
        return $videoResponse[0];
    }

    private function formatDuration($duration)
    {
        preg_match('/PT(\d+H)?(\d+M)?(\d+S)?/', $duration, $matches);
        $hours = isset($matches[1]) ? intval(str_replace('H', '', $matches[1])) : 0;
        $minutes = isset($matches[2]) ? intval(str_replace('M', '', $matches[2])) : 0;
        $seconds = isset($matches[3]) ? intval(str_replace('S', '', $matches[3])) : 0;
        $totalSeconds = $hours * 3600 + $minutes * 60 + $seconds;
        return gmdate('i:s', $totalSeconds);
    }

    private function getVideoThumbnail($video)
    {
        $thumbnails = $video->getSnippet()->getThumbnails();
        $thumbnail = $thumbnails->maxres ? $thumbnails->maxres->getUrl() : ($thumbnails->standard ? $thumbnails->standard->getUrl() : null);

        return $thumbnail ?? $thumbnails->default->getUrl();
    }
}
