<ul class="navbar-nav bg-white shadow sidebar sidebar-dark accordion position-fixed top-0  {{ app()->getLocale() == 'ar' ? 'end-0 sidebar-rtl' : 'start-0' }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : '' }}" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <div class="sidebar-brand d-flex align-items-center justify-content-between" >
        <a class="d-flex align-items-center text-black" href="{{ route('home') }}">
            <div class="sidebar-brand-icon">
                <i class="mdi mdi-home-outline"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Form</div>
        </a>
        <button type="button" class="border-0 bg-transparent" id="mySidebarToggle">
            <span class="mdi mdi-radiobox-marked"></span>
        </button>
    </div>

    <div class="scrollable-content">
        @foreach($menu['sections'] as $section)
        
            @if (isset($section['type']) && $section['type'] == 'hr')
                <div class="{{ app()->isLocale('ar') ? 'text-end' : 'text-start' }} nav-hr pt-2">
                    <hr class="text-center border-1 border-secondary">
                    <div class="{{ app()->isLocale('ar') ? 'text-end' : 'text-start' }} position-relative" style="margin-top: -32px;">
                        <span class="bg-white text-secondary px-3 py-1">{{ __($section['title']) }}</span>
                    </div>
                </div>
            @else
                @if (Auth::user()->hasRole('user') && ($section['name'] == 'users' || $section['name'] == 'transactions' || $section['name'] == 'languages') )
                    @continue
                @endif
                @php
                    $isActiveSection = Route::currentRouteName() == $section['name'];
                    $isActiveSubmenu = false;

                    if(isset($section['submenu'])) {
                        foreach ($section['submenu'] as $item) {
                            if (isset($item['name']) && Route::currentRouteName() == $item['name']) {
                                $isActiveSubmenu = true;
                                break;
                            }
                            if (isset($item['submenu'])) {
                                foreach ($item['submenu'] as $subItem) {
                                    if (isset($subItem['name']) && Route::currentRouteName() == $subItem['name']) {
                                        $isActiveSubmenu = true;
                                        break;
                                    }
                                }
                            }
                        }
                    } else {
                        $isActiveSubmenu = false;
                    }
                @endphp

                <li class="nav-item my-1 {{ $isActiveSection || $isActiveSubmenu ? 'active' : '' }}">
                    <a class="nav-link d-flex align-items-center rounded {{ isset($section['submenu']) ? (($isActiveSection || $isActiveSubmenu) ? '' : 'collapsed') : '' }} mx-1"
                    href="{{ route($section['name']) }}"
                    @if(isset($section['submenu'])) data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index }}" aria-expanded="{{ $isActiveSection || $isActiveSubmenu ? 'true' : 'false' }}" aria-controls="collapse{{ $loop->index }}" @endif>
                        <i class="{{ $section['icon'] }}"></i>
                        <span>{{ __($section['title']) }}</span>
                        @isset($section['badge'])
                            <span class="{{ $section['badge']['class'] }} {{ app()->getLocale() == 'ar' ? 'me-auto' : 'ms-auto' }} my-fs-7">{{ $section['badge']['value'] }}</span>
                        @endisset
                    </a>

                    @if (isset($section['submenu']) && is_array($section['submenu']))
                        @include('layouts.app.menu.submenu', ['submenu' => $section['submenu']])
                    @endif
                </li>
            @endif
        @endforeach

    </div>

</ul>
