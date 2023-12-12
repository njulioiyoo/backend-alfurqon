<div class="mobile-menu-overlay__inner">
    <div class="mobile-menu-overlay__header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6 col-8">
                    <div class="logo">
                        <a href="index.html">
                            <img src="{{ asset('assets/images/logo/logo.png') }}" class="img-fluid" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-4">
                    <div class="mobile-menu-content text-right">
                        <span class="mobile-navigation-close-icon" id="mobile-menu-close-trigger"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mobile-menu-overlay__body">
        <nav class="offcanvas-navigation">
            <ul>
                @foreach($menuData as $key => $menuItem)
                <li class="{{ Request::is($menuItem['url']) ? 'active' : '' }} has-children{{ isset($menuItem['submenu']) ? '' : '' }}">
                    <a href="{{ $menuItem['url'] }}">{{ $menuItem['label'] }}</a>
                    @if(isset($menuItem['submenu']))
                    <ul class="sub-menu">
                        @foreach($menuItem['submenu'] as $submenuItem)
                        <li class="{{ Request::is($submenuItem['url']) ? 'active' : '' }}">
                            <a href="{{ $submenuItem['url'] }}"><span>{{ $submenuItem['label'] }}</span></a>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </li>
                @endforeach
            </ul>
        </nav>
    </div>
</div>