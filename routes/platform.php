<?php

declare(strict_types=1);

use App\Orchid\Screens\About\HistoryAndBackgroundScreen;
use App\Orchid\Screens\About\OrgStructureAndLeadershipScreen;
use App\Orchid\Screens\About\VisionAndMissionScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;
use App\Orchid\Screens\ConfigurationScreen;
use App\Orchid\Screens\Facility\FacilityEditScreen;
use App\Orchid\Screens\Facility\FacilityListScreen;
use App\Orchid\Screens\Gallery\Photo\EventPhotoEditScreen;
use App\Orchid\Screens\Gallery\Photo\EventPhotoListScreen;
use App\Orchid\Screens\Gallery\Video\EventVideoScreen;
use App\Orchid\Screens\MasterData\ContentType\ContentTypeScreen;
use App\Orchid\Screens\MasterData\Partnership\PartnershipEditScreen;
use App\Orchid\Screens\MasterData\Partnership\PartnershipListScreen;
use App\Orchid\Screens\News\NewsEditScreen;
use App\Orchid\Screens\News\NewsListScreen;
use App\Orchid\Screens\Program\ProgramListScreen;
use App\Orchid\Screens\Program\ProgramEditScreen;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Profile'), route('platform.profile')));

// Platform > System > Users > User
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(fn (Trail $trail, $user) => $trail
        ->parent('platform.systems.users')
        ->push($user->name, route('platform.systems.users.edit', $user)));

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.users')
        ->push(__('Create'), route('platform.systems.users.create')));

// Platform > System > Users
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Users'), route('platform.systems.users')));

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(fn (Trail $trail, $role) => $trail
        ->parent('platform.systems.roles')
        ->push($role->name, route('platform.systems.roles.edit', $role)));

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.roles')
        ->push(__('Create'), route('platform.systems.roles.create')));

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Roles'), route('platform.systems.roles')));

// Platform > System > Settings > Configurations
Route::screen('configurations', ConfigurationScreen::class)
    ->name('platform.systems.configurations')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push('Configurations');
    });

// Platform > System > Master Data > Content Type
Route::screen('content-type', ContentTypeScreen::class)
    ->name('platform.systems.content_type')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push('Content Type');
    });

// Platform > System > Master Data > Partnership
Route::screen('partnership', PartnershipListScreen::class)
    ->name('platform.systems.partnerships')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Partnership'), route('platform.systems.partnerships')));

// Platform > System > Master Data > Partnership > Create
Route::screen('partnership/create', PartnershipEditScreen::class)
    ->name('platform.systems.partnerships.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.partnerships')
        ->push(__('Create'), route('platform.systems.partnerships.create')));

// Platform > System > Master Data > Partnership > Edit
Route::screen('partnership/{partnership}/edit', PartnershipEditScreen::class)
    ->name('platform.systems.partnerships.edit')
    ->breadcrumbs(fn (Trail $trail, $partnership) => $trail
        ->parent('platform.systems.partnerships')
        ->push($partnership->name, route('platform.systems.partnerships.edit', $partnership)));


// Platform > System > About > History and Background
Route::screen('history_and_background', HistoryAndBackgroundScreen::class)
    ->name('platform.systems.about.history_and_background')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push('History and Background');
    });

// Platform > System > About > History and Background
Route::screen('vision_and_mission', VisionAndMissionScreen::class)
    ->name('platform.systems.about.vision_and_mission')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push('Vision and Mission');
    });

// Platform > System > About > History and Background
Route::screen('organizational-structure-and-leadership', OrgStructureAndLeadershipScreen::class)
    ->name('platform.systems.about.organizational-structure-and-leadership')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push('Organizational Structure and Leadership');
    });

// Platform > System > Gallery > Photo
Route::screen('photo', EventPhotoListScreen::class)
    ->name('platform.systems.gallery.photo')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Photo'), route('platform.systems.gallery.photo')));

// Platform > System > Gallery > Photo > Create
Route::screen('photo/create', EventPhotoEditScreen::class)
    ->name('platform.systems.gallery.photo.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.gallery.photo')
        ->push(__('Create'), route('platform.systems.gallery.photo.create')));

// Platform > System > Gallery > Photo > Edit
Route::screen('photo/{photo}/edit', EventPhotoEditScreen::class)
    ->name('platform.systems.gallery.photo.edit')
    ->breadcrumbs(fn (Trail $trail, $photo) => $trail
        ->parent('platform.systems.gallery.photo')
        ->push($photo->name, route('platform.systems.gallery.photo.edit', $photo)));

// Platform > System > Gallery > Video
Route::screen('video', EventVideoScreen::class)
    ->name('platform.systems.gallery.video')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push('Video');
    });

// Platform > System > News
Route::screen('news', NewsListScreen::class)
    ->name('platform.systems.news')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('News'), route('platform.systems.news')));

// Platform > System > News > Create
Route::screen('news/create', NewsEditScreen::class)
    ->name('platform.systems.news.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.news')
        ->push(__('Create'), route('platform.systems.news.create')));

// Platform > System > News > Edit
Route::screen('news/{news}/edit', NewsEditScreen::class)
    ->name('platform.systems.news.edit')
    ->breadcrumbs(fn (Trail $trail, $news) => $trail
        ->parent('platform.systems.news')
        ->push($news->name, route('platform.systems.news.edit', $news)));


// Platform > System > Program
Route::screen('program', ProgramListScreen::class)
    ->name('platform.systems.program')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Program'), route('platform.systems.program')));

// Platform > System > Program > Create
Route::screen('program/create', ProgramEditScreen::class)
    ->name('platform.systems.program.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.program')
        ->push(__('Create'), route('platform.systems.program.create')));

// Platform > System > Program > Edit
Route::screen('program/{program}/edit', ProgramEditScreen::class)
    ->name('platform.systems.program.edit')
    ->breadcrumbs(fn (Trail $trail, $program) => $trail
        ->parent('platform.systems.program')
        ->push($program->name, route('platform.systems.program.edit', $program)));

// Platform > System > Facility
Route::screen('facility', FacilityListScreen::class)
    ->name('platform.systems.facility')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Facility'), route('platform.systems.facility')));

// Platform > System > Facility > Create
Route::screen('facility/create', FacilityEditScreen::class)
    ->name('platform.systems.facility.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.facility')
        ->push(__('Create'), route('platform.systems.facility.create')));

// // Platform > System > Facility > Edit
Route::screen('facility/{facility}/edit', FacilityEditScreen::class)
    ->name('platform.systems.facility.edit')
    ->breadcrumbs(fn (Trail $trail, $facility) => $trail
        ->parent('platform.systems.facility')
        ->push($facility->name, route('platform.systems.facility.edit', $facility)));
