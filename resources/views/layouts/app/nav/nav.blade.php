
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white shadow rounded mx-4 mt-3 topbar mb-4" dir="{{ app()->isLocale("ar") ? 'rtl' : '' }}">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-icon btn-light d-md-none border rounded me-3 ms-1">
                <i class="mdi mdi-menu"></i>
            </button>

            <!-- Topbar Search -->
            <form
                class="d-none d-sm-inline-block form-inline {{ app()->isLocale("ar") ? 'ms-auto me-md-3' : 'me-auto ms-md-3' }} my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group {{ app()->isLocale("ar") ? 'input-rtl' : '' }}">
                    <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <button class="btn btn-outline-primary" type="button"><i class="mdi mdi-magnify"></i></button>
                </div>
            </form>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav {{ app()->isLocale("ar") ? 'me-auto' : 'ms-auto' }}">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-magnify"></i>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                        aria-labelledby="searchDropdown">
                        <form class="form-inline me-auto w-100 navbar-search">
                            <div class="input-group {{ app()->isLocale("ar") ? 'input-rtl' : '' }}">
                                <input type="text" class="form-control" placeholder="{{ __("Search for...") }}" aria-label="Search" aria-describedby="basic-addon2">
                                <button class="btn btn-outline-primary" type="button"><i class="mdi mdi-magnify"></i></button>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Nav Item - Alerts -->
                {{-- <li class="nav-item dropdown no-arrow mx-1 d-flex align-items-center">
                    <a class="btn btn-outline-primary rounded-circle p-2 lh-1 position-relative overflow-visible" href="#" id="alertsDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mdi mdi-bell-outline"></span>
                            <span class="position-absolute top-25 start-100 translate-middle p-1 bg-primary border border-light rounded-circle">
                            <span class="visually-hidden">New alerts</span>
                        </span>
                    </a>
                    <!-- Dropdown - Alerts -->
                    <div class="dropdown-list dropdown-menu shadow animated--grow-in {{ app()->isLocale("ar") ? "text-end dropdown-menu-start" : "dropdown-menu-end" }}" dir="{{ app()->isLocale("ar") ? "rtl" : "" }}" aria-labelledby="alertsDropdown" data-bs-popper="none">
                        <h6 class="dropdown-header">
                            {{ __('Notfications') }}
                        </h6>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="{{ app()->isLocale("ar") ? "ms-3" : "me-3" }}">
                                <div class="icon-circle bg-secondary">
                                    <i class="mdi mdi-file-document-outline text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">December 12, 2019</div>
                                <span class="font-weight-bold">A new monthly report is ready to download!</span>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="{{ app()->isLocale("ar") ? "ms-3" : "me-3" }}">
                                <div class="icon-circle bg-success">
                                    <i class="mdi mdi-cash-multiple text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">December 7, 2019</div>
                                $290.29 has been deposited into your account!
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="{{ app()->isLocale("ar") ? "ms-3" : "me-3" }}">
                                <div class="icon-circle bg-warning">
                                    <i class="mdi mdi-alert-circle text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">December 2, 2019</div>
                                Spending Alert: We've noticed unusually high spending for your account.
                            </div>
                        </a>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                    </div>
                </li> --}}


                <!-- Nav Item - Messages -->
                {{-- <li class="nav-item dropdown no-arrow mx-1 d-flex align-items-center">
                    <a class="btn btn-outline-primary rounded-circle p-2 lh-1" href="#" id="messagesDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mdi mdi-email-outline"></span>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-list dropdown-menu shadow animated--grow-in {{ app()->isLocale("ar") ? "text-end dropdown-menu-start" : "dropdown-menu-end" }}" dir="{{ app()->isLocale("ar") ? "rtl" : "" }}" aria-labelledby="messagesDropdown">
                        <h6 class="dropdown-header">
                            {{ __('Messages') }}
                        </h6>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image {{ app()->isLocale("ar") ? "ms-3" : "me-3" }}">
                                <img class="rounded-circle" src="{{ asset('assets/img/undraw_profile_1.svg') }}" alt="...">
                                <div class="status-indicator bg-success"></div>
                            </div>
                            <div class="font-weight-bold">
                                <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                    problem I've been having.</div>
                                <div class="small text-gray-500">Emily Fowler · 58m</div>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image {{ app()->isLocale("ar") ? "ms-3" : "me-3" }}">
                                <img class="rounded-circle" src="{{ asset('assets/img/undraw_profile_2.svg') }}" alt="...">
                                <div class="status-indicator"></div>
                            </div>
                            <div>
                                <div class="text-truncate">I have the photos that you ordered last month, how
                                    would you like them sent to you?</div>
                                <div class="small text-gray-500">Jae Chun · 1d</div>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image {{ app()->isLocale("ar") ? "ms-3" : "me-3" }}">
                                <img class="rounded-circle" src="{{ asset('assets/img/undraw_profile_3.svg') }}" alt="...">
                                <div class="status-indicator bg-warning"></div>
                            </div>
                            <div>
                                <div class="text-truncate">Last month's report looks great, I am very happy with
                                    the progress so far, keep up the good work!</div>
                                <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image {{ app()->isLocale("ar") ? "ms-3" : "me-3" }}">
                                <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="...">
                                <div class="status-indicator bg-success"></div>
                            </div>
                            <div>
                                <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                    told me that people say this to all dogs, even if they aren't good...</div>
                                <div class="small text-gray-500">Chicken the Dog · 2w</div>
                            </div>
                        </a>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                    </div>
                </li> --}}

                <!-- Nav Item - language -->
                <li class="nav-item dropdown no-arrow mx-1 d-flex align-items-center">
                    <a class="btn btn-outline-primary rounded p-2 lh-1 fw-bold text-uppercase" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ app()->getLocale() }}
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu shadow animated--grow-in {{ app()->isLocale("ar") ? "text-end dropdown-menu-start" : "dropdown-menu-end" }} px-1" dir="{{ app()->isLocale("ar") ? "rtl" : "" }}" aria-labelledby="userDropdown">
                        {{-- <select onchange="window.location.href = this.value;"> --}}
                            @foreach (config('language') as $locale => $language)
                            <a class="dropdown-item rounded my-1 {{ app()->isLocale($locale) ? 'active' : '' }}" href="{{ route("change.language", $locale) }}">
                                <span class="{{ app()->isLocale("ar") ? "ms-2" : "me-2" }} px-1 text-uppercase rounded border">{{ $locale }}</span>
                                {{ __($language) }}
                            </a>
                            @endforeach
                        </select>
                    </div>
                </li>

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="img-profile rounded-circle border border-secondary" src="{{ Auth::user()->photoUrl }}">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu shadow animated--grow-in px-1 {{ app()->isLocale("ar") ? "text-end dropdown-menu-start" : "dropdown-menu-end" }}" dir="{{ app()->isLocale("ar") ? "rtl" : "" }}" aria-labelledby="userDropdown">
                        <a class="dropdown-item rounded" href="{{ route('settings.account.get') }}">
                            <i class="mdi mdi-cog-outline mdi-sm mdi-fw {{ app()->isLocale("ar") ? "ms-2" : "me-2" }} text-gray-400"></i>
                            {{ __('Settings') }}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item rounded d-flex" href="{{ route('auth.logout') }}">
                            <i class="mdi mdi-logout mdi-sm mdi-fw {{ app()->isLocale("ar") ? "ms-2 my-transform-180" : "me-2" }} text-gray-400"></i>
                            {{ __('Logout') }}
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->


