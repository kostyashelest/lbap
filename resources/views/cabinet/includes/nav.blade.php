<nav class="sidebar">
    <div class="simplebar-content-wrapper">
        <div class="simplebar-content">
            <a class="sidebar-brand" href="/">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     width="20px" height="20px" viewBox="0 0 20 20" enable-background="new 0 0 20 20"
                     xml:space="preserve" fill="#2871e7">
                <path fill="#84aef2"
                      d="M19.4,4.1l-9-4C10.1,0,9.9,0,9.6,0.1l-9,4C0.2,4.2,0,4.6,0,5s0.2,0.8,0.6,0.9l9,4C9.7,10,9.9,10,10,10s0.3,0,0.4-0.1l9-4     C19.8,5.8,20,5.4,20,5S19.8,4.2,19.4,4.1z"></path>
                    <path
                        d="M10,15c-0.1,0-0.3,0-0.4-0.1l-9-4c-0.5-0.2-0.7-0.8-0.5-1.3c0.2-0.5,0.8-0.7,1.3-0.5l8.6,3.8l8.6-3.8c0.5-0.2,1.1,0,1.3,0.5     c0.2,0.5,0,1.1-0.5,1.3l-9,4C10.3,15,10.1,15,10,15z"></path>
                    <path
                        d="M10,20c-0.1,0-0.3,0-0.4-0.1l-9-4c-0.5-0.2-0.7-0.8-0.5-1.3c0.2-0.5,0.8-0.7,1.3-0.5l8.6,3.8l8.6-3.8c0.5-0.2,1.1,0,1.3,0.5     c0.2,0.5,0,1.1-0.5,1.3l-9,4C10.3,20,10.1,20,10,20z"></path>
            </svg>
                <span class="align-middle">{{ $settings->site_name }}</span>
            </a>
            <ul class="sidebar-nav">
                <li class="sidebar-item" id="hamburger">
                    <a depth="0" activeclassname="active" class="sidebar-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-menu align-middle me-2">
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                        <span class="align-middle" depth="0">{{ __('title.menu.collapse_menu') }}</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('cabinet.user.*') ? 'active' : '' }}">
                    <a class="sidebar-link collapsed" data-bs-toggle="collapse" aria-expanded="true" depth="0"
                       href="#user">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather align-middle me-2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <span class="align-middle" depth="0">{{ __('title.menu.users') }}</span>
                        <div></div>
                    </a>

                    <ul id="user" class="sidebar-dropdown list-unstyled collapse">
                        <li class="sidebar-item">
                            <a depth="1" activeclassname="active"
                               class="sidebar-link {{ request()->routeIs('cabinet.user.profile') ? 'active' : '' }}"
                               href="{{ Route('cabinet.user.profile') }}">
                                <span class="align-middle" depth="1">{{ __('cabinet.menu.profile') }}</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a depth="1" activeclassname="active"
                               class="sidebar-link {{ request()->routeIs('cabinet.user.log') ? 'active' : '' }}"
                               href="{{ Route('cabinet.user.log') }}">
                                <span class="align-middle" depth="1">{{ __('title.menu.user_logs') }}</span>
                            </a>
                        </li>
                    </ul>

                </li>

            </ul>
        </div>
    </div>
</nav>
