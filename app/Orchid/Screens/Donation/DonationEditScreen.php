<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Donation;

use Orchid\Screen\Action;
use Orchid\Screen\Screen;
use App\Models\Donation;
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
use Orchid\Screen\Fields\Group;
use Orchid\Screen\TD;
use Orchid\Screen\Fields\DateRange;

class DonationEditScreen extends Screen
{
    /**
     * @var Donation
     */
    public $donation;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @param News $donation
     *
     * @return array
     */
    public function query(Donation $donation): array
    {
        $donation->load('attachment');

        return [
            'donation' => $donation
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->donation->exists ? 'Mengedit Donasi' : 'Membuat Donasi Baru';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return "Membuat mekanisme untuk menerima dan mengelola donasi baru dari pengguna. Donasi akan disimpan dalam sistem dan dialokasikan ke proyek-proyek kemanusiaan yang sesuai. Fitur ini memungkinkan pengguna untuk berpartisipasi dalam upaya kemanusiaan kami dengan mudah dan efisien.";
    }

    /**
     * @return iterable|null
     */
    public function permission(): ?iterable
    {
        return [
            'platform.systems.donation',
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
            Button::make(__('Hapus'))
                ->icon('trash')
                ->confirm(__('Setelah donasi dihapus, semua sumber daya dan data akan dihapus secara permanen. Sebelum menghapus donasi Anda, harap unduh semua data atau informasi yang ingin Anda simpan.'))
                ->method('remove')
                ->canSee($this->donation->exists),

            Button::make(__('Simpan'))
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
                Input::make('donation.name')
                    ->title('Nama')
                    ->horizontal()
                    ->required()
                    ->placeholder('Nama yang menarik namun misterius')
                    ->help('Spesifikasikan nama pendek dan deskriptif untuk donasi ini.'),

                Cropper::make('donation.image')
                    ->title('Gambar (370x300)')
                    ->maxWidth(370)
                    ->maxHeight(300)
                    ->horizontal(),

                Cropper::make('donation.banner')
                    ->title('Spanduk Donasi (1920x350)')
                    ->maxWidth(1920)
                    ->maxHeight(350)
                    ->targetUrl()
                    ->horizontal(),

                TextArea::make('donation.description')
                    ->title('Deskripsi')
                    ->horizontal()
                    ->required()
                    ->rows(3)
                    ->maxlength(200)
                    ->placeholder('Deskripsi singkat untuk pratinjau.'),

                Input::make('donation.attr_2')
                    ->title('Target Donasi')
                    ->horizontal()
                    ->required()
                    ->type('number')
                    ->title('Target Donasi')
                    ->placeholder('Target donasi yang diharapkan'),

                DateRange::make('donation.donation_period')
                    ->horizontal()
                    ->required()
                    ->title('Periode Donasi')
                    ->help('Spesifikasikan tanggal mulai dan tanggal selesai untuk periode donasi ini.'),

                Quill::make('donation.body')
                    ->horizontal()
                    ->required()
                    ->title('Text utama'),

                Group::make([
                    Switcher::make('donation.is_highlight')
                        ->sendTrueOrFalse()
                        ->align(TD::ALIGN_RIGHT)
                        ->help('Geser tombol ke posisi on untuk mengubahnya menjadi benar.')
                        ->title('Donasi Terkini'),

                    Switcher::make('donation.active')
                        ->sendTrueOrFalse()
                        ->align(TD::ALIGN_RIGHT)
                        ->help('Geser tombol ke posisi on untuk mengubahnya menjadi benar.')
                        ->title('Status'),
                ]),
            ])

        ];
    }

    /**
     * @param Donation    $donation
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Donation $donation, Request $request)
    {
        $data = $request->get('donation');
        $create = [
            'name'      => $data['name'],
            'slug'      => Str::slug($data['name']),
            'image'     => $data['image'],
            'banner'    => $data['banner'],
            'description'   => $data['description'],
            'attr_2'    => $data['attr_2'],
            'body'      => $data['body'],
            'is_highlight' => $data['is_highlight'],
            'active' => $data['active'],
            'start_date'    => $data['donation_period']['start'],
            'end_date'      => $data['donation_period']['end'],
        ];

        $donation->fill($create)->save();

        Toast::info(__('Donasi telah disimpan.'));

        return redirect()->route('platform.systems.donation');
    }

    /**
     * @param Donation $donation
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Donation $donation)
    {
        $donation->delete();

        Toast::info(__('Donasi telah dihapus'));

        return redirect()->route('platform.systems.donation');
    }
}
