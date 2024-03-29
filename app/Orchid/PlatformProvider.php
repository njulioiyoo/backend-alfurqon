<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param Dashboard $dashboard
     *
     * @return void
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * Register the application menu.
     *
     * @return Menu[]
     */
    public function menu(): array
    {
        return [
            Menu::make('Tentang Kami')
                ->icon('bs.puzzle')
                ->title(__('Pages'))
                ->list([
                    Menu::make('Sejarah dan Latar Belakang Masjid')
                        ->icon('bs.building')
                        ->permission('platform.systems.about.history_and_background')
                        ->route('platform.systems.about.history_and_background'),
                    Menu::make('Visi dan Misi Masjid')
                        ->icon('bs.eye')
                        ->permission('platform.systems.about.vision_and_mission')
                        ->route('platform.systems.about.vision_and_mission'),
                    Menu::make('Struktur Organisasi dan Pimpinan')
                        ->icon('bs.organization')
                        ->permission('platform.systems.about.organizational-structure-and-leadership')
                        ->route('platform.systems.about.organizational-structure-and-leadership'),
                    Menu::make('Aksi Sosial')
                        ->icon('bs.heart')
                        ->permission('platform.systems.donation')
                        ->route('platform.systems.donation'),
                ]),

            Menu::make(__('Program'))
                ->icon('bs.monitor')
                ->route('platform.systems.program')
                ->permission('platform.systems.program'),

            Menu::make(__('Fasilitas'))
                ->icon('bs.modules')
                ->route('platform.systems.facility')
                ->permission('platform.systems.facility'),

            Menu::make(__('Informasi'))
                ->icon('bs.notebook')
                ->route('platform.systems.news')
                ->permission('platform.systems.news'),

            Menu::make(__('Galeri'))
                ->icon('bs.photo')
                ->list([
                    Menu::make('Foto-foto masjid, acara dan kegiatan')
                        ->icon('bs.picture')
                        ->permission('platform.systems.gallery.photo')
                        ->route('platform.systems.gallery.photo'),
                    Menu::make('Video rekaman acara-acara penting')
                        ->icon('bs.video')
                        ->permission('platform.systems.gallery.video')
                        ->route('platform.systems.gallery.video')
                ]),

            Menu::make(__('Hubungi Kami'))
                ->icon('bs.phone')
                ->route('platform.systems.contact')
                ->permission('platform.systems.contact')->divider(),

            Menu::make(__('Kemitraan'))
                ->icon('bs.server')
                ->title(__('Master Data'))
                ->route('platform.systems.partnerships')
                ->permission('platform.systems.partnerships'),

            Menu::make(__('Jenis Konten'))
                ->icon('new-doc')
                ->route('platform.systems.content_type')
                ->permission('platform.systems.content_type')->divider(),

            Menu::make(__('Users'))
                ->icon('bs.people')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access Controls')),

            Menu::make(__('Roles'))
                ->icon('bs.shield')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles')
                ->divider(),

            Menu::make(__('Konfigurasi'))
                ->icon('settings')
                ->route('platform.systems.configurations')
                ->permission('platform.systems.configurations')
                ->title(__('Settings')),
        ];
    }

    /**
     * Register permissions for the application.
     *
     * @return ItemPermission[]
     */
    public function permissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users'))
                ->addPermission('platform.systems.facility', __('Fasilitas'))
                ->addPermission('platform.systems.program', __('Program'))
                ->addPermission('platform.systems.news', __('Informasi'))
                ->addPermission('platform.systems.contact', __('Hubungi Kami')),

            ItemPermission::group(__('Settings'))
                ->addPermission('platform.systems.configurations', __('Konfigurasi')),

            ItemPermission::group(__('Master Data'))
                ->addPermission('platform.systems.content_type', __('Jenis Konten'))
                ->addPermission('platform.systems.partnerships', __('Kemitraan')),

            ItemPermission::group(__('About Us'))
                ->addPermission('platform.systems.about.history_and_background', __('Sejarah dan Latar Belakang'))
                ->addPermission('platform.systems.about.vision_and_mission', __('Visi dan Misi'))
                ->addPermission('platform.systems.about.organizational-structure-and-leadership', __('Struktur Organisasi dan Pimpinan'))
                ->addPermission('platform.systems.donation', __('Aksi Sosial')),

            ItemPermission::group(__('Gallery'))
                ->addPermission('platform.systems.gallery.photo', __('Foto-foto masjid, acara dan kegiatan'))
                ->addPermission('platform.systems.gallery.video', __('Video rekaman acara-acara penting'))

        ];
    }
}
