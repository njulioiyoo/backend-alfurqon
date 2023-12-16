@php
    $breadcrumbKey = $breadcrumbKey ?? 'gallery'; // Default key
    @endphp

@if (isset($menuData[$breadcrumbKey]['submenu']))
@php
        $routeParams = request()->route()->parameters;
        $breadcrumbDisplayed = false;
    @endphp

    @foreach ($menuData[$breadcrumbKey]['submenu'] as $submenuItem)
        @php
            $selectedSlug = Str::afterLast($submenuItem['url'], '/');
        @endphp

        @if (!$breadcrumbDisplayed && $routeParams['type'] === $selectedSlug)
            <li class="breadcrumb-item active">{{ $submenuItem['label'] }}</li>
            @php $breadcrumbDisplayed = true; @endphp
        @endif
    @endforeach

    @if (!$breadcrumbDisplayed)
        <li class="breadcrumb-item active">{{ $submenuItem['label'] }}</li>
    @endif
@endif
