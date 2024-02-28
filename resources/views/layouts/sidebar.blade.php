<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box" style="background-color: #14213d">
        <a href="/" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-sm-dark.png') }}" alt="logo-sm-dark" height="24">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="logo-dark" height="22">
            </span>
        </a>

        <a href="/" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ url('fav-reblate.png') }}" alt="logo-sm-light" height="40">
            </span>
            <span class="logo-lg">
                <img src="{{ url('fav-reblate.png') }}" alt="logo-light" height="40">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn"
        id="vertical-menu-btn">
        <i class="ri-menu-2-line align-middle"></i>
    </button>

    <div data-simplebar class="vertical-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <div class="dropdown mx-3 sidebar-user user-dropdown select-dropdown">
                {{-- <button type="button" class="btn btn-light w-100 waves-effect waves-light border-0"
                    id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avatar-xs rounded-circle flex-shrink-0">
                                <div
                                    class="avatar-title border bg-light text-primary rounded-circle text-uppercase user-sort-name">
                                    R</div>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-2 text-start">
                            <h6 class="mb-1 fw-medium user-name-text"> Reporting </h6>
                            <p class="font-size-13 text-muted user-name-sub-text mb-0"> Team Reporting </p>
                        </div>
                        <div class="flex-shrink-0 text-end">
                            <i class="mdi mdi-chevron-down font-size-16"></i>
                        </div>
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu-end w-100">
                    <!-- item-->
                    <a class="dropdown-item d-flex align-items-center px-3" href="#">
                        <div class="flex-shrink-0 me-2">
                            <div class="avatar-xs rounded-circle flex-shrink-0">
                                <div class="avatar-title border rounded-circle text-uppercase dropdown-sort-name">C
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0 dropdown-name">CRM</h6>
                            <p class="text-muted font-size-13 mb-0 dropdown-sub-desc">Designer Team</p>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center px-3" href="#">
                        <div class="flex-shrink-0 me-2">
                            <div class="avatar-xs rounded-circle flex-shrink-0">
                                <div class="avatar-title border rounded-circle text-uppercase dropdown-sort-name">A
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0 dropdown-name">Application Design</h6>
                            <p class="text-muted font-size-13 mb-0 dropdown-sub-desc">Flutter Devs</p>
                        </div>
                    </a>

                    <a class="dropdown-item d-flex align-items-center px-3" href="#">
                        <div class="flex-shrink-0 me-2">
                            <div class="avatar-xs rounded-circle flex-shrink-0">
                                <div class="avatar-title border rounded-circle text-uppercase dropdown-sort-name">E
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0 dropdown-name">Ecommerce</h6>
                            <p class="text-muted font-size-13 mb-0 dropdown-sub-desc">Developer Team</p>
                        </div>
                    </a>

                    <a class="dropdown-item d-flex align-items-center px-3" href="#">
                        <div class="flex-shrink-0 me-2">
                            <div class="avatar-xs rounded-circle flex-shrink-0">
                                <div class="avatar-title border rounded-circle text-uppercase dropdown-sort-name">R
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0 dropdown-name">Reporting</h6>
                            <p class="text-muted font-size-13 mb-0 dropdown-sub-desc">Team Reporting</p>
                        </div>
                    </a>

                    <a class="btn btn-sm btn-link font-size-14 text-center w-100" href="javascript:void(0)">
                        View More..
                    </a>
                </div> --}}
            </div>
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="/" class="waves-effect">
                        <i class="uim uim-airplay"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                {{-- users routes  --}}

                {{-- @if (auth()->user()->user_type == 'super_admin')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M16 17v2H2v-2s0-4 7-4s7 4 7 4m-3.5-9.5A3.5 3.5 0 1 0 9 11a3.5 3.5 0 0 0 3.5-3.5m3.44 5.5A5.32 5.32 0 0 1 18 17v2h4v-2s0-3.63-6.06-4M15 4a3.39 3.39 0 0 0-1.93.59a5 5 0 0 1 0 5.82A3.39 3.39 0 0 0 15 11a3.5 3.5 0 0 0 0-7Z" />
                            </svg>
                            <span>Users</span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="/view-users/{{ auth()->user()->id }}">View Users</a></li>
                            <li><a href="{{ Route('auth.register') }}">Add new user</a></li>

                        </ul>
                    </li>
                @endif --}}
                {{-- Employees --}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36">
                            <path fill="currentColor"
                                d="M12 16.14h-.87a8.67 8.67 0 0 0-6.43 2.52l-.24.28v8.28h4.08v-4.7l.55-.62l.25-.29a11 11 0 0 1 4.71-2.86A6.59 6.59 0 0 1 12 16.14Z"
                                class="clr-i-solid clr-i-solid-path-1" />
                            <path fill="currentColor"
                                d="M31.34 18.63a8.67 8.67 0 0 0-6.43-2.52a10.47 10.47 0 0 0-1.09.06a6.59 6.59 0 0 1-2 2.45a10.91 10.91 0 0 1 5 3l.25.28l.54.62v4.71h3.94v-8.32Z"
                                class="clr-i-solid clr-i-solid-path-2" />
                            <path fill="currentColor"
                                d="M11.1 14.19h.31a6.45 6.45 0 0 1 3.11-6.29a4.09 4.09 0 1 0-3.42 6.33Z"
                                class="clr-i-solid clr-i-solid-path-3" />
                            <path fill="currentColor"
                                d="M24.43 13.44a6.54 6.54 0 0 1 0 .69a4.09 4.09 0 0 0 .58.05h.19A4.09 4.09 0 1 0 21.47 8a6.53 6.53 0 0 1 2.96 5.44Z"
                                class="clr-i-solid clr-i-solid-path-4" />
                            <circle cx="17.87" cy="13.45" r="4.47" fill="currentColor"
                                class="clr-i-solid clr-i-solid-path-5" />
                            <path fill="currentColor"
                                d="M18.11 20.3A9.69 9.69 0 0 0 11 23l-.25.28v6.33a1.57 1.57 0 0 0 1.6 1.54h11.49a1.57 1.57 0 0 0 1.6-1.54V23.3l-.24-.3a9.58 9.58 0 0 0-7.09-2.7Z"
                                class="clr-i-solid clr-i-solid-path-6" />
                            <path fill="none" d="M0 0h36v36H0z" />
                        </svg>
                        <span>Employees</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="/manage-employees">View</a></li>
                        <li><a href="/add-new">Add New</a></li>
                    </ul>

                </li>
                {{-- Expenses --}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                            <path fill="currentColor"
                                d="M12.32 8a3 3 0 0 0-2-.7H5.63A1.59 1.59 0 0 1 4 5.69a2 2 0 0 1 0-.25a1.59 1.59 0 0 1 1.63-1.33h4.62a1.59 1.59 0 0 1 1.57 1.33h1.5a3.08 3.08 0 0 0-3.07-2.83H8.67V.31H7.42v2.3H5.63a3.08 3.08 0 0 0-3.07 2.83a2.09 2.09 0 0 0 0 .25a3.07 3.07 0 0 0 3.07 3.07h4.74A1.59 1.59 0 0 1 12 10.35a1.86 1.86 0 0 1 0 .34a1.59 1.59 0 0 1-1.55 1.24h-4.7a1.59 1.59 0 0 1-1.55-1.24H2.69a3.08 3.08 0 0 0 3.06 2.73h1.67v2.27h1.25v-2.27h1.7a3.08 3.08 0 0 0 3.06-2.73v-.34A3.06 3.06 0 0 0 12.32 8z" />
                        </svg>
                        <path fill="currentColor"
                            d="M12 16.14h-.87a8.67 8.67 0 0 0-6.43 2.52l-.24.28v8.28h4.08v-4.7l.55-.62l.25-.29a11 11 0 0 1 4.71-2.86A6.59 6.59 0 0 1 12 16.14Z"
                            class="clr-i-solid clr-i-solid-path-1" />
                        <path fill="currentColor"
                            d="M31.34 18.63a8.67 8.67 0 0 0-6.43-2.52a10.47 10.47 0 0 0-1.09.06a6.59 6.59 0 0 1-2 2.45a10.91 10.91 0 0 1 5 3l.25.28l.54.62v4.71h3.94v-8.32Z"
                            class="clr-i-solid clr-i-solid-path-2" />
                        <path fill="currentColor"
                            d="M11.1 14.19h.31a6.45 6.45 0 0 1 3.11-6.29a4.09 4.09 0 1 0-3.42 6.33Z"
                            class="clr-i-solid clr-i-solid-path-3" />
                        <path fill="currentColor"
                            d="M24.43 13.44a6.54 6.54 0 0 1 0 .69a4.09 4.09 0 0 0 .58.05h.19A4.09 4.09 0 1 0 21.47 8a6.53 6.53 0 0 1 2.96 5.44Z"
                            class="clr-i-solid clr-i-solid-path-4" />
                        <circle cx="17.87" cy="13.45" r="4.47" fill="currentColor"
                            class="clr-i-solid clr-i-solid-path-5" />
                        <path fill="currentColor"
                            d="M18.11 20.3A9.69 9.69 0 0 0 11 23l-.25.28v6.33a1.57 1.57 0 0 0 1.6 1.54h11.49a1.57 1.57 0 0 0 1.6-1.54V23.3l-.24-.3a9.58 9.58 0 0 0-7.09-2.7Z"
                            class="clr-i-solid clr-i-solid-path-6" />
                        <path fill="none" d="M0 0h36v36H0z" />
                        </svg>
                        <span>Expenses</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="/view-expenses">View</a></li>
                        <li><a href="/add-new-expense">Add New</a></li>
                    </ul>

                </li>
                {{-- Clients --}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1920" height="1792"
                            viewBox="0 0 1920 1792">
                            <path fill="currentColor"
                                d="M593 896q-162 5-265 128H194q-82 0-138-40.5T0 865q0-353 124-353q6 0 43.5 21t97.5 42.5T384 597q67 0 133-23q-5 37-5 66q0 139 81 256zm1071 637q0 120-73 189.5t-194 69.5H523q-121 0-194-69.5T256 1533q0-53 3.5-103.5t14-109T300 1212t43-97.5t62-81t85.5-53.5T602 960q10 0 43 21.5t73 48t107 48t135 21.5t135-21.5t107-48t73-48t43-21.5q61 0 111.5 20t85.5 53.5t62 81t43 97.5t26.5 108.5t14 109t3.5 103.5zM640 256q0 106-75 181t-181 75t-181-75t-75-181t75-181T384 0t181 75t75 181zm704 384q0 159-112.5 271.5T960 1024T688.5 911.5T576 640t112.5-271.5T960 256t271.5 112.5T1344 640zm576 225q0 78-56 118.5t-138 40.5h-134q-103-123-265-128q81-117 81-256q0-29-5-66q66 23 133 23q59 0 119-21.5t97.5-42.5t43.5-21q124 0 124 353zm-128-609q0 106-75 181t-181 75t-181-75t-75-181t75-181t181-75t181 75t75 181z" />
                        </svg>
                        <span>Clients</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="/view-clients">View</a></li>
                        <li><a href="/add-new-client">Add New</a></li>
                    </ul>

                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16"><path fill="#fff" d="M12.32 8a3 3 0 0 0-2-.7H5.63A1.59 1.59 0 0 1 4 5.69a2 2 0 0 1 0-.25a1.59 1.59 0 0 1 1.63-1.33h4.62a1.59 1.59 0 0 1 1.57 1.33h1.5a3.08 3.08 0 0 0-3.07-2.83H8.67V.31H7.42v2.3H5.63a3.08 3.08 0 0 0-3.07 2.83a2.09 2.09 0 0 0 0 .25a3.07 3.07 0 0 0 3.07 3.07h4.74A1.59 1.59 0 0 1 12 10.35a1.86 1.86 0 0 1 0 .34a1.59 1.59 0 0 1-1.55 1.24h-4.7a1.59 1.59 0 0 1-1.55-1.24H2.69a3.08 3.08 0 0 0 3.06 2.73h1.67v2.27h1.25v-2.27h1.7a3.08 3.08 0 0 0 3.06-2.73v-.34A3.06 3.06 0 0 0 12.32 8"/></svg>
                        <span> Salary Slip</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="/view-slips">View</a></li>
                        <li><a href="/generate-new-salary-slip">Add New</a></li>
                    </ul>

                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <svg xmlns="http://www.w3.org/2000/svg" width="384" height="512" viewBox="0 0 384 512">
                            <path fill="currentColor"
                                d="M64 0C28.7 0 0 28.7 0 64v384c0 35.3 28.7 64 64 64h256c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zm192 0v128h128L256 0zM64 80c0-8.8 7.2-16 16-16h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16zm0 64c0-8.8 7.2-16 16-16h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16zm128 72c8.8 0 16 7.2 16 16v17.3c8.5 1.2 16.7 3.1 24.1 5.1c8.5 2.3 13.6 11 11.3 19.6s-11 13.6-19.6 11.3c-11.1-3-22-5.2-32.1-5.3c-8.4-.1-17.4 1.8-23.6 5.5c-5.7 3.4-8.1 7.3-8.1 12.8c0 3.7 1.3 6.5 7.3 10.1c6.9 4.1 16.6 7.1 29.2 10.9l.5.1c11.3 3.4 25.3 7.6 36.3 14.6c12.1 7.6 22.4 19.7 22.7 38.2c.3 19.3-9.6 33.3-22.9 41.6c-7.7 4.8-16.4 7.6-25.1 9.1V440c0 8.8-7.2 16-16 16s-16-7.2-16-16v-17.8c-11.2-2.1-21.7-5.7-30.9-8.9c-2.1-.7-4.2-1.4-6.2-2.1c-8.4-2.8-12.9-11.9-10.1-20.2s11.9-12.9 20.2-10.1c2.5.8 4.8 1.6 7.1 2.4c13.6 4.6 24.6 8.4 36.3 8.7c9.1.3 17.9-1.7 23.7-5.3c5.1-3.2 7.9-7.3 7.8-14c-.1-4.6-1.8-7.8-7.7-11.6c-6.8-4.3-16.5-7.4-29-11.2l-1.6-.5c-11-3.3-24.3-7.3-34.8-13.7c-12-7.2-22.6-18.9-22.7-37.3c-.1-19.4 10.8-32.8 23.8-40.5c7.5-4.4 15.8-7.2 24.1-8.7V232c0-8.8 7.2-16 16-16z" />
                        </svg>
                        <span> Invoices </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="/view-invoices">View</a></li>
                        <li><a href="/create-new-invoice">Add New</a></li>
                    </ul>
                </li>

                {{-- login  --}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M6 22q-.825 0-1.412-.587T4 20V10q0-.825.588-1.412T6 8h1V6q0-2.075 1.463-3.537T12 1q2.075 0 3.538 1.463T17 6v2h1q.825 0 1.413.588T20 10v10q0 .825-.587 1.413T18 22zm6-5q.825 0 1.413-.587T14 15q0-.825-.587-1.412T12 13q-.825 0-1.412.588T10 15q0 .825.588 1.413T12 17M9 8h6V6q0-1.25-.875-2.125T12 3q-1.25 0-2.125.875T9 6z" />
                        </svg>
                        <span> Employee Logins </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="/view-login">View</a></li>
                        <li><a href="/create-new-login">Create</a></li>
                    </ul>
                </li>

                {{-- login  --}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd"><path d="M24 0v24H0V0zM12.594 23.258l-.012.002l-.071.035l-.02.004l-.014-.004l-.071-.036c-.01-.003-.019 0-.024.006l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.016-.018m.264-.113l-.014.002l-.184.093l-.01.01l-.003.011l.018.43l.005.012l.008.008l.201.092c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022m-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.003-.011l.018-.43l-.003-.012l-.01-.01z"/><path fill="#fff" d="M11 13c.447 0 .887.024 1.316.07a1 1 0 0 1 .72 1.557A5.968 5.968 0 0 0 12 18c0 .92.207 1.79.575 2.567a1 1 0 0 1-.89 1.428L11 22c-2.229 0-4.335-.14-5.913-.558c-.785-.208-1.524-.506-2.084-.956C2.41 20.01 2 19.345 2 18.5c0-.787.358-1.523.844-2.139c.494-.625 1.177-1.2 1.978-1.69C6.425 13.695 8.605 13 11 13m7.5 0a2.5 2.5 0 0 1 2.5 2.5v.585a1.5 1.5 0 0 1 1 1.415v3a1.5 1.5 0 0 1-1.5 1.5h-4a1.5 1.5 0 0 1-1.5-1.5v-3a1.5 1.5 0 0 1 1-1.415V15.5a2.5 2.5 0 0 1 2.5-2.5m0 2a.5.5 0 0 0-.492.41L18 15.5v.5h1v-.5a.5.5 0 0 0-.5-.5M11 2a5 5 0 1 1 0 10a5 5 0 0 1 0-10"/></g></svg>                        <span> Client Logins </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="/view-clients-logins">View</a></li>
                        <li><a href="/create-client-logins">Create</a></li>
                    </ul>
                </li>


                {{-- authuntication --}}
                <li>
                    <a class="waves-effect" href="/google-2fa"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M7 14q-.825 0-1.412-.587T5 12q0-.825.588-1.412T7 10q.825 0 1.413.588T9 12q0 .825-.587 1.413T7 14m0 4q-2.5 0-4.25-1.75T1 12q0-2.5 1.75-4.25T7 6q1.675 0 3.038.825T12.2 9H21l3 3l-4.5 4.5l-2-1.5l-2 1.5l-2.125-1.5H12.2q-.8 1.35-2.162 2.175T7 18m0-2q1.4 0 2.463-.85T10.875 13H14l1.45 1.025L17.5 12.5l1.775 1.375L21.15 12l-1-1h-9.275q-.35-1.3-1.412-2.15T7 8Q5.35 8 4.175 9.175T3 12q0 1.65 1.175 2.825T7 16"/></svg>
                     Google 2FA
                    </a>
                </li>

                <li>
                    <a class="waves-effect" href="/view-emp-attendence"><svg xmlns="http://www.w3.org/2000/svg" width="1.2rem" height="1.2rem" viewBox="0 0 512 512"><path fill="#f9e7c0" d="M437.567 512H88.004a8.182 8.182 0 0 1-8.182-8.182V8.182A8.182 8.182 0 0 1 88.004 0H437.83a7.92 7.92 0 0 1 7.92 7.92v495.898a8.183 8.183 0 0 1-8.183 8.182"/><path fill="#597b91" d="M368.727 92.401H126.453c-6.147 0-11.13-4.983-11.13-11.13s4.983-11.13 11.13-11.13h242.273c6.146 0 11.13 4.983 11.13 11.13s-4.983 11.13-11.129 11.13m-40.597 61.723c0-6.147-4.983-11.13-11.13-11.13H126.453c-6.147 0-11.13 4.983-11.13 11.13s4.983 11.13 11.13 11.13H317c6.146 0 11.13-4.983 11.13-11.13m-96.935 72.854c0-6.147-4.983-11.13-11.13-11.13h-93.612c-6.147 0-11.13 4.983-11.13 11.13s4.983 11.13 11.13 11.13h93.612c6.147-.001 11.13-4.983 11.13-11.13m109.051 72.853c0-6.146-4.983-11.13-11.13-11.13H126.453c-6.147 0-11.13 4.983-11.13 11.13s4.983 11.13 11.13 11.13h202.663c6.147 0 11.13-4.983 11.13-11.13m49.884-72.853c0-6.147-4.983-11.13-11.13-11.13H276.612c-6.146 0-11.13 4.983-11.13 11.13s4.983 11.13 11.13 11.13H379c6.146-.001 11.13-4.983 11.13-11.13m-92.38 145.707c0-6.146-4.983-11.13-11.13-11.13H126.453c-6.147 0-11.13 4.983-11.13 11.13s4.983 11.13 11.13 11.13H286.62c6.147-.001 11.13-4.984 11.13-11.13m66.504 72.853c0-6.146-4.983-11.13-11.13-11.13H126.453c-6.147 0-11.13 4.983-11.13 11.13s4.983 11.13 11.13 11.13h226.671c6.147 0 11.13-4.983 11.13-11.13m25.876-72.853c0-6.146-4.983-11.13-11.13-11.13h-51.752c-6.146 0-11.13 4.983-11.13 11.13s4.983 11.13 11.13 11.13H379c6.146-.001 11.13-4.984 11.13-11.13"/></svg>
                     Attendence
                    </a>
                </li>
                <li>
                    <a class="waves-effect" href="/office-time">
                        <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" viewBox="0 0 20 20"><path fill="#fff" d="M10 0c5.523 0 10 4.477 10 10s-4.477 10-10 10S0 15.523 0 10S4.477 0 10 0m-.93 5.581a.698.698 0 0 0-.698.698v5.581c0 .386.312.698.698.698h5.581a.698.698 0 1 0 0-1.395H9.767V6.279a.698.698 0 0 0-.697-.698"/></svg>
                       Office Times
                    </a>
                </li>

                {{--
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uim uim-window-grid"></i>
                        <span>Layouts</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">Vertical</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="layouts-dark-sidebar">Dark Sidebar</a></li>
                                <li><a href="layouts-light-sidebar">Light Sidebar</a></li>
                                <li><a href="layouts-compact-sidebar">Compact Sidebar</a></li>
                                <li><a href="layouts-icon-sidebar">Icon Sidebar</a></li>
                                <li><a href="layouts-boxed">Boxed Layout</a></li>
                                <li><a href="layouts-preloader">Preloader</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">Horizontal</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="layouts-horizontal">Horizontal</a></li>
                                <li><a href="layouts-hori-light-header">Light Header</a></li>
                                <li><a href="layouts-hori-topbar-dark">Topbar Dark</a></li>
                                <li><a href="layouts-hori-boxed-width">Boxed width</a></li>
                                <li><a href="layouts-hori-preloader">Preloader</a></li>
                            </ul>
                        </li>
                    </ul>
                </li> --}}

                {{-- <li class="menu-title">Pages</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uim uim-sign-in-alt"></i>
                        <span>Authentication</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="auth-login">Login</a></li>
                        <li><a href="auth-register">Register</a></li>
                        <li><a href="auth-recoverpw">Recover Password</a></li>
                        <li><a href="auth-lock-screen">Lock Screen</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uim uim-box"></i>
                        <span>Extra Pages</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="pages-starter">Starter Page</a></li>
                        <li><a href="pages-maintenance">Maintenance</a></li>
                        <li><a href="pages-comingsoon">Coming Soon</a></li>
                        <li><a href="pages-404">Error 404</a></li>
                        <li><a href="pages-500">Error 500</a></li>
                        <li><a href="pages-faq">(Help Center) FAQ</a></li>
                        <li><a href="pages-profile">Profile</a></li>
                        <li><a href="pages-pricing">Pricing</a></li>
                        <li><a href="pages-terms-conditions">Terms & Conditions</a></li>
                    </ul>
                </li> --}}

                {{-- <li class="menu-title">Components</li> --}}

                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uim uim-layer-group"></i>
                        <span>UI Elements</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="ui-alerts">Alerts</a></li>
                        <li><a href="ui-buttons">Buttons</a></li>
                        <li><a href="ui-cards">Cards</a></li>
                        <li><a href="ui-carousel">Carousel</a></li>
                        <li><a href="ui-dropdowns">Dropdowns</a></li>
                        <li><a href="ui-grid">Grid</a></li>
                        <li><a href="ui-images">Images</a></li>
                        <li><a href="ui-lightbox">Lightbox</a></li>
                        <li><a href="ui-modals">Modals</a></li>
                        <li><a href="ui-offcanvas">Offcavas</a></li>
                        <li><a href="ui-rangeslider">Range Slider</a></li>
                        <li><a href="ui-roundslider">Round Slider</a></li>
                        <li><a href="ui-session-timeout">Session Timeout</a></li>
                        <li><a href="ui-progressbars">Progress Bars</a></li>
                        <li><a href="ui-sweet-alert">Sweetalert 2</a></li>
                        <li><a href="ui-tabs-accordions">Tabs & Accordions</a></li>
                        <li><a href="ui-typography">Typography</a></li>
                        <li><a href="ui-video">Video</a></li>
                        <li><a href="ui-general">General</a></li>
                        <li><a href="ui-rating">Rating</a></li>
                        <li><a href="ui-notifications">Notifications</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="uim uim-document-layout-left"></i>
                        <span class="badge rounded-pill bg-danger float-end">6</span>
                        <span>Forms</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="form-elements">Basic Elements</a></li>
                        <li><a href="form-validation">Validation</a></li>
                        <li><a href="form-plugins">Plugins</a></li>
                        <li><a href="form-editors">Editors</a></li>
                        <li><a href="form-uploads">File Upload</a></li>
                        <li><a href="form-wizard">Wizard</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uim uim-table"></i>
                        <span>Tables</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="tables-bootstrap">Bootstrap Tables</a></li>
                        <li><a href="tables-datatable">Data Tables</a></li>
                        <li><a href="tables-editable">Editable Table</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uim uim-chart-pie"></i>
                        <span>Charts</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="javascript: void(0);" class="has-arrow">Apexcharts Part 1</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="charts-line">Line</a></li>
                                <li><a href="charts-area">Area</a></li>
                                <li><a href="charts-column">Column</a></li>
                                <li><a href="charts-bar">Bar</a></li>
                                <li><a href="charts-mixed">Mixed</a></li>
                                <li><a href="charts-timeline">Timeline</a></li>
                                <li><a href="charts-candlestick">Candlestick</a></li>
                                <li><a href="charts-boxplot">Boxplot</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript: void(0);" class="has-arrow">Apexcharts Part 2</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="charts-bubble">Bubble</a></li>
                                <li><a href="charts-scatter">Scatter</a></li>
                                <li><a href="charts-heatmap">Heatmap</a></li>
                                <li><a href="charts-treemap">Treemap</a></li>
                                <li><a href="charts-pie">Pie</a></li>
                                <li><a href="charts-radialbar">Radialbar</a></li>
                                <li><a href="charts-radar">Radar</a></li>
                                <li><a href="charts-polararea">Polararea</a></li>
                            </ul>
                        </li>
                        <li><a href="charts-echart">E Charts</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uim uim-object-ungroup"></i>
                        <span>Icons</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="icons-remix">Remix Icons</a></li>
                        <li><a href="icons-materialdesign">Material Design</a></li>
                        <li><a href="icons-unicons">Unicons</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uim uim-comment-plus"></i>
                        <span>Maps</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="maps-google">Google Maps</a></li>
                        <li><a href="maps-vector">Vector Maps</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uim uim-layers-alt"></i>
                        <span>Multi Level</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="javascript: void(0);">Level 1.1</a></li>
                        <li><a href="javascript: void(0);" class="has-arrow">Level 1.2</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="javascript: void(0);">Level 2.1</a></li>
                                <li><a href="javascript: void(0);">Level 2.2</a></li>
                            </ul>
                        </li>
                    </ul>
                </li> --}}

            </ul>

        </div>
        <!-- Sidebar -->
    </div>


    <style>
        body[data-sidebar=colored] .vertical-menu {
            background: #14213d;
            border-color: #14213d;
        }
    </style>

    <script>
        function confirmLogout() {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will be logged out!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                confirmButtonColor: '#FF5733', // Red color for "Yes"
                cancelButtonColor: '#4CAF50', // Green color for "No"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send an AJAX request to delete the task
                    $.ajax({
                        url: '/logout',
                        method: 'GET', // Use the DELETE HTTP method
                        success: function() {
                            // Provide user feedback
                            Swal.fire({
                                title: 'Success!',
                                text: 'Logged Out!',
                                icon: 'success'
                            }).then(() => {
                                window.location.href = "/login";
                            });
                        }

                    });

                }
            });
        }
    </script>

</div>
<!-- Left Sidebar End -->
