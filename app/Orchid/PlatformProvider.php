<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

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
            Menu::make('About Us')
                ->icon('bs.puzzle')
                ->title(__('Pages'))
                ->list([
                    Menu::make('History and Background')
                        ->icon('bs.building')
                        ->permission('platform.systems.about.history_and_background')
                        ->route('platform.systems.about.history_and_background'),
                    Menu::make('Vision and Mission')
                        ->icon('bs.eye')
                        ->permission('platform.systems.about.vision_and_mission')
                        ->route('platform.systems.about.vision_and_mission'),
                    Menu::make('Organizational Structure & Leadership')
                        ->icon('bs.organization')
                        ->permission('platform.systems.about.organizational-structure-and-leadership')
                        ->route('platform.systems.about.organizational-structure-and-leadership'),
                ]),

            Menu::make(__('Gallery'))
                ->icon('bs.photo')
                ->list([
                    Menu::make('Mosque photos, events, and activities')
                        ->icon('bs.picture')
                        ->permission('platform.systems.gallery.photo')
                        ->route('platform.systems.gallery.photo'),
                    Menu::make('Video recordings of important events')
                        ->icon('bs.video')
                        ->permission('platform.systems.gallery.video')
                        ->route('platform.systems.gallery.video')
                ]),

            Menu::make(__('Program'))
                ->icon('bs.monitor')
                ->route('platform.systems.program')
                ->permission('platform.systems.program'),

            Menu::make(__('Facility'))
                ->icon('bs.modules')
                ->route('platform.systems.program')
                ->permission('platform.systems.program'),

            Menu::make(__('News & Announcements'))
                ->icon('bs.notebook')
                ->route('platform.systems.news')
                ->permission('platform.systems.news')
                ->divider(),

            Menu::make(__('Partnerships'))
                ->icon('bs.server')
                ->title(__('Master Data'))
                ->route('platform.systems.partnerships')
                ->permission('platform.systems.partnerships'),

            Menu::make(__('Content Type'))
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

            Menu::make(__('Configurations'))
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
                ->addPermission('platform.systems.program', __('Program'))
                ->addPermission('platform.systems.news', __('News & Announcements')),

            ItemPermission::group(__('Settings'))
                ->addPermission('platform.systems.configurations', __('Configurations')),

            ItemPermission::group(__('Master Data'))
                ->addPermission('platform.systems.content_type', __('Content Type'))
                ->addPermission('platform.systems.partnerships', __('Partnerships')),

            ItemPermission::group(__('About Us'))
                ->addPermission('platform.systems.about.history_and_background', __('History and Background'))
                ->addPermission('platform.systems.about.vision_and_mission', __('Vision and Mission'))
                ->addPermission('platform.systems.about.organizational-structure-and-leadership', __('Organizational Structure and Leadership')),

            ItemPermission::group(__('Gallery'))
                ->addPermission('platform.systems.gallery.photo', __('Mosque photos, events, and activities'))
                ->addPermission('platform.systems.gallery.video', __('Video recordings of important events'))

        ];
    }
}
