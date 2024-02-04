<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Program;

use Orchid\Screen\Action;
use Orchid\Screen\Screen;
use App\Models\ContentType;
use App\Models\Donation;
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
use Orchid\Screen\Fields\Select;

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
        return $this->program->exists ? 'Mengedit Program' : 'Membuat Program Baru';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return "Buat program dengan mudah menggunakan platform yang ramah pengguna kami. Buat artikel menarik, unggah media, dan pilih kategori yang relevan. Program Anda, sesuai keinginan Anda. Tingkatkan kreativitas konten Anda dengan proses pembuatan program yang intuitif.";
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
                    ->title('Kategori Konten')
                    ->required()
                    ->horizontal()
                    ->fromModel(ContentType::class, 'name')->applyScope('programType'),

                Relation::make('program.donation_id')
                    ->title('Hubungkan Donasi Konten')
                    ->required()
                    ->horizontal()
                    ->fromModel(Donation::class, 'name'),

                Input::make('program.name')
                    ->title('Nama')
                    ->horizontal()
                    ->placeholder('Attractive but mysterious name')
                    ->help('Tentukan nama deskriptif singkat untuk program ini.'),

                Input::make('program.source')
                    ->title('Youtube URL')
                    ->horizontal()
                    ->type('url')
                    ->placeholder('Share youtube id video on your Video')
                    ->help('Tentukan nama deskriptif singkat untuk video ini.'),

                Select::make('program.source_type')
                    ->options([
                        'video' => 'Video',
                        'photo' => 'Photo',
                    ])
                    ->title('Tipe Program')
                    ->horizontal(),

                Cropper::make('program.image')
                    ->title('Gambar (370x300)')
                    ->maxWidth(370)
                    ->maxHeight(300)
                    ->horizontal(),

                TextArea::make('program.body')
                    ->title('Deskripsi')
                    ->horizontal()
                    ->rows(3)
                    ->placeholder('Deskripsi singkat untuk pratinjau'),

                Group::make([
                    Switcher::make('program.is_highlight')
                        ->sendTrueOrFalse()
                        ->align(TD::ALIGN_RIGHT)
                        ->help('Geser tombol ke aktif untuk mengubahnya menjadi true.')
                        ->title('Program Unggulan'),

                    Switcher::make('program.active')
                        ->sendTrueOrFalse()
                        ->align(TD::ALIGN_RIGHT)
                        ->help('Geser tombol ke aktif untuk mengubahnya menjadi true.')
                        ->title('Status'),

                    Switcher::make('program.is_banner_donation')
                        ->sendTrueOrFalse()
                        ->align(TD::ALIGN_RIGHT)
                        ->help('Geser tombol ke aktif untuk mengubahnya menjadi true.')
                        ->title('Tampilkan Banner Donation'),
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
            'donation_id' => $data['donation_id'],
            'source' => $data['source'] ?? null,
            'source_type' => $data['source_type'] ?? null,
            'name' => $data['name'] ?? $resultVideo->getSnippet()->getTitle(),
            'slug' => $data['source'] ? Str::slug($resultVideo->getSnippet()->getTitle()) : Str::slug($data['name']),
            'body' => $data['source'] ? $resultVideo->getSnippet()->getDescription() : $data['body'],
            'attr_1' => $data['source'] ? $formattedDuration : null,
            'image' => $data['image'] ? url($data['image']) : $image,
            'is_highlight' => $data['is_highlight'],
            'active' => $data['active'],
            'is_banner_donation' => $data['is_banner_donation'],
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
