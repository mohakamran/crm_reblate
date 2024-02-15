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

            </div>
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title"> Menu </li>

                <li>
                    <a href="/" class="waves-effect">
                        <i class="uim uim-airplay"></i>
                        <span>Dashboard</span>
                    </a>|
                </li>

                @if (auth()->user()->user_type = 'employee' || (auth()->user()->user_type = 'manager'))
                    <li>
                        <a href="/view-my-slips" class="waves-effect">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16">
                                <path fill="#fff"
                                    d="M12.32 8a3 3 0 0 0-2-.7H5.63A1.59 1.59 0 0 1 4 5.69a2 2 0 0 1 0-.25a1.59 1.59 0 0 1 1.63-1.33h4.62a1.59 1.59 0 0 1 1.57 1.33h1.5a3.08 3.08 0 0 0-3.07-2.83H8.67V.31H7.42v2.3H5.63a3.08 3.08 0 0 0-3.07 2.83a2.09 2.09 0 0 0 0 .25a3.07 3.07 0 0 0 3.07 3.07h4.74A1.59 1.59 0 0 1 12 10.35a1.86 1.86 0 0 1 0 .34a1.59 1.59 0 0 1-1.55 1.24h-4.7a1.59 1.59 0 0 1-1.55-1.24H2.69a3.08 3.08 0 0 0 3.06 2.73h1.67v2.27h1.25v-2.27h1.7a3.08 3.08 0 0 0 3.06-2.73v-.34A3.06 3.06 0 0 0 12.32 8" />
                            </svg>
                            <span> My Salary Slips</span>
                        </a>
                    </li>
                @endif

                <li>
                    <a href="/view_info" class="waves-effect">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M12 1C5.925 1 1 5.925 1 12s4.925 11 11 11s11-4.925 11-11S18.075 1 12 1m-.5 5a1 1 0 1 0 0 2h.5a1 1 0 1 0 0-2zM10 10a1 1 0 1 0 0 2h1v3h-1a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-1v-4a1 1 0 0 0-1-1z" clip-rule="evenodd"/></svg>
                        <span>Info</span>
                    </a>
                </li>

                {{-- employee access --}}
                @if (Session::has('employees_access'))
                    @php
                        $employees_access = Session::get('employees_access');
                        // Convert to an array if it's a single value
                        if (!is_array($employees_access)) {
                            $employees_access = explode(',', $employees_access);
                            // Remove any empty elements resulting from the explode function
                            $employees_access = array_filter($employees_access);
                        }
                    @endphp


                    {{-- all --}}
                    @if (is_array($employees_access) && in_array('all', $employees_access))
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                                    viewBox="0 0 36 36">
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
                    @elseif(is_array($employees_access) && in_array('create', $employees_access) && in_array('update', $employees_access) && in_array('view', $employees_access) && in_array('delete', $employees_access))
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                                    viewBox="0 0 36 36">
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
                    @elseif(is_array($employees_access) && in_array('view', $employees_access) && in_array('create', $employees_access))
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                                    viewBox="0 0 36 36">
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
                    @elseif(is_array($employees_access) && in_array('view', $employees_access))
                        <li>
                            <a href="/manage-employees" class="waves-effect">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                                    viewBox="0 0 36 36">
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
                                <span>View Employees</span>
                            </a>
                        </li>
                    @elseif(is_array($employees_access) && in_array('create', $employees_access))
                        <li>
                            <a href="/add-new" class="has-arrow waves-effect">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                                    viewBox="0 0 36 36">
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
                                <span>Add Employee</span>
                            </a>
                        </li>
                    @endif

                @endif

                {{-- expenses access --}}
                @if (Session::has('expenses_access'))
                    @php
                        $expenses_access = Session::get('expenses_access');
                        // Convert to an array if it's a single value
                        if (!is_array($expenses_access)) {
                            $expenses_access = explode(',', $expenses_access);
                            // Remove any empty elements resulting from the explode function
                            $expenses_access = array_filter($expenses_access);
                        }
                    @endphp
                    @if (is_array($expenses_access) && in_array('all', $expenses_access))
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
                    @elseif(is_array($expenses_access) && in_array('create', $expenses_access) && in_array('update', $expenses_access) && in_array('view', $expenses_access) && in_array('delete', $expenses_access))
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
                    @elseif(is_array($expenses_access) && in_array('view', $expenses_access) && in_array('create', $expenses_access))
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
                    @elseif(is_array($expenses_access) && in_array('view', $expenses_access))
                        <li>
                            <a href="/view-expenses" class=" waves-effect">
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
                                <span>View Expenses</span>
                            </a>
                        </li>
                    @elseif(is_array($expenses_access) && in_array('create', $expenses_access))
                        <li>
                            <a href="/add-new-expense" class="waves-effect">
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
                                <span>Add Expense</span>
                            </a>
                        </li>
                    @endif
                @endif

                {{-- Invoices access --}}
                @if (Session::has('invoices_access'))
                    @php
                        $invoices_access = Session::get('invoices_access');
                        // Convert to an array if it's a single value
                        if (!is_array($invoices_access)) {
                            $invoices_access = explode(',', $invoices_access);
                            // Remove any empty elements resulting from the explode function
                            $invoices_access = array_filter($invoices_access);
                        }
                    @endphp
                    @if (is_array($invoices_access) && in_array('all', $invoices_access))
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
                    @elseif(is_array($invoices_access) && in_array('create', $invoices_access) && in_array('update', $invoices_access) && in_array('view', $invoices_access) && in_array('delete', $invoices_access))
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
                    @elseif(is_array($invoices_access) && in_array('view', $invoices_access) && in_array('create', $invoices_access))
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
                    @elseif(is_array($invoices_access) && in_array('view', $invoices_access))
                    <li>
                        <a href="/view-invoices" class="waves-effect">
                            <svg xmlns="http://www.w3.org/2000/svg" width="384" height="512" viewBox="0 0 384 512">
                                <path fill="currentColor"
                                    d="M64 0C28.7 0 0 28.7 0 64v384c0 35.3 28.7 64 64 64h256c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zm192 0v128h128L256 0zM64 80c0-8.8 7.2-16 16-16h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16zm0 64c0-8.8 7.2-16 16-16h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16zm128 72c8.8 0 16 7.2 16 16v17.3c8.5 1.2 16.7 3.1 24.1 5.1c8.5 2.3 13.6 11 11.3 19.6s-11 13.6-19.6 11.3c-11.1-3-22-5.2-32.1-5.3c-8.4-.1-17.4 1.8-23.6 5.5c-5.7 3.4-8.1 7.3-8.1 12.8c0 3.7 1.3 6.5 7.3 10.1c6.9 4.1 16.6 7.1 29.2 10.9l.5.1c11.3 3.4 25.3 7.6 36.3 14.6c12.1 7.6 22.4 19.7 22.7 38.2c.3 19.3-9.6 33.3-22.9 41.6c-7.7 4.8-16.4 7.6-25.1 9.1V440c0 8.8-7.2 16-16 16s-16-7.2-16-16v-17.8c-11.2-2.1-21.7-5.7-30.9-8.9c-2.1-.7-4.2-1.4-6.2-2.1c-8.4-2.8-12.9-11.9-10.1-20.2s11.9-12.9 20.2-10.1c2.5.8 4.8 1.6 7.1 2.4c13.6 4.6 24.6 8.4 36.3 8.7c9.1.3 17.9-1.7 23.7-5.3c5.1-3.2 7.9-7.3 7.8-14c-.1-4.6-1.8-7.8-7.7-11.6c-6.8-4.3-16.5-7.4-29-11.2l-1.6-.5c-11-3.3-24.3-7.3-34.8-13.7c-12-7.2-22.6-18.9-22.7-37.3c-.1-19.4 10.8-32.8 23.8-40.5c7.5-4.4 15.8-7.2 24.1-8.7V232c0-8.8 7.2-16 16-16z" />
                            </svg>
                            <span> View Invoices </span>
                        </a>
                    </li>
                    @elseif(is_array($invoices_access) && in_array('create', $invoices_access))
                    <li>
                        <a href="/create-new-invoice" class="waves-effect">
                            <svg xmlns="http://www.w3.org/2000/svg" width="384" height="512" viewBox="0 0 384 512">
                                <path fill="currentColor"
                                    d="M64 0C28.7 0 0 28.7 0 64v384c0 35.3 28.7 64 64 64h256c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zm192 0v128h128L256 0zM64 80c0-8.8 7.2-16 16-16h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16zm0 64c0-8.8 7.2-16 16-16h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16zm128 72c8.8 0 16 7.2 16 16v17.3c8.5 1.2 16.7 3.1 24.1 5.1c8.5 2.3 13.6 11 11.3 19.6s-11 13.6-19.6 11.3c-11.1-3-22-5.2-32.1-5.3c-8.4-.1-17.4 1.8-23.6 5.5c-5.7 3.4-8.1 7.3-8.1 12.8c0 3.7 1.3 6.5 7.3 10.1c6.9 4.1 16.6 7.1 29.2 10.9l.5.1c11.3 3.4 25.3 7.6 36.3 14.6c12.1 7.6 22.4 19.7 22.7 38.2c.3 19.3-9.6 33.3-22.9 41.6c-7.7 4.8-16.4 7.6-25.1 9.1V440c0 8.8-7.2 16-16 16s-16-7.2-16-16v-17.8c-11.2-2.1-21.7-5.7-30.9-8.9c-2.1-.7-4.2-1.4-6.2-2.1c-8.4-2.8-12.9-11.9-10.1-20.2s11.9-12.9 20.2-10.1c2.5.8 4.8 1.6 7.1 2.4c13.6 4.6 24.6 8.4 36.3 8.7c9.1.3 17.9-1.7 23.7-5.3c5.1-3.2 7.9-7.3 7.8-14c-.1-4.6-1.8-7.8-7.7-11.6c-6.8-4.3-16.5-7.4-29-11.2l-1.6-.5c-11-3.3-24.3-7.3-34.8-13.7c-12-7.2-22.6-18.9-22.7-37.3c-.1-19.4 10.8-32.8 23.8-40.5c7.5-4.4 15.8-7.2 24.1-8.7V232c0-8.8 7.2-16 16-16z" />
                            </svg>
                            <span> Create New Invoice </span>
                        </a>
                    </li>
                    @endif
                @endif

                {{-- Clients access --}}
                @if (Session::has('clients_access'))
                                @php
                                    $clients_access = Session::get('clients_access');
                                    // Convert to an array if it's a single value
                                    if (!is_array($clients_access)) {
                                        $clients_access = explode(',', $clients_access);
                                        // Remove any empty elements resulting from the explode function
                                        $clients_access = array_filter($clients_access);
                                    }
                                @endphp
                                @if (is_array($clients_access) && in_array('all', $clients_access))
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1920" height="1792" viewBox="0 0 1920 1792"><path fill="currentColor" d="M593 896q-162 5-265 128H194q-82 0-138-40.5T0 865q0-353 124-353q6 0 43.5 21t97.5 42.5T384 597q67 0 133-23q-5 37-5 66q0 139 81 256zm1071 637q0 120-73 189.5t-194 69.5H523q-121 0-194-69.5T256 1533q0-53 3.5-103.5t14-109T300 1212t43-97.5t62-81t85.5-53.5T602 960q10 0 43 21.5t73 48t107 48t135 21.5t135-21.5t107-48t73-48t43-21.5q61 0 111.5 20t85.5 53.5t62 81t43 97.5t26.5 108.5t14 109t3.5 103.5zM640 256q0 106-75 181t-181 75t-181-75t-75-181t75-181T384 0t181 75t75 181zm704 384q0 159-112.5 271.5T960 1024T688.5 911.5T576 640t112.5-271.5T960 256t271.5 112.5T1344 640zm576 225q0 78-56 118.5t-138 40.5h-134q-103-123-265-128q81-117 81-256q0-29-5-66q66 23 133 23q59 0 119-21.5t97.5-42.5t43.5-21q124 0 124 353zm-128-609q0 106-75 181t-181 75t-181-75t-75-181t75-181t181-75t181 75t75 181z"/></svg>
                                        <span>Clients</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="true">
                                        <li><a href="/view-clients">View</a></li>
                                        <li><a href="/add-new-client">Add New</a></li>
                                    </ul>

                                </li>
                                @elseif(is_array($clients_access) && in_array('create', $clients_access) && in_array('update', $clients_access) && in_array('view', $clients_access) && in_array('delete', $clients_access))
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1920" height="1792" viewBox="0 0 1920 1792"><path fill="currentColor" d="M593 896q-162 5-265 128H194q-82 0-138-40.5T0 865q0-353 124-353q6 0 43.5 21t97.5 42.5T384 597q67 0 133-23q-5 37-5 66q0 139 81 256zm1071 637q0 120-73 189.5t-194 69.5H523q-121 0-194-69.5T256 1533q0-53 3.5-103.5t14-109T300 1212t43-97.5t62-81t85.5-53.5T602 960q10 0 43 21.5t73 48t107 48t135 21.5t135-21.5t107-48t73-48t43-21.5q61 0 111.5 20t85.5 53.5t62 81t43 97.5t26.5 108.5t14 109t3.5 103.5zM640 256q0 106-75 181t-181 75t-181-75t-75-181t75-181T384 0t181 75t75 181zm704 384q0 159-112.5 271.5T960 1024T688.5 911.5T576 640t112.5-271.5T960 256t271.5 112.5T1344 640zm576 225q0 78-56 118.5t-138 40.5h-134q-103-123-265-128q81-117 81-256q0-29-5-66q66 23 133 23q59 0 119-21.5t97.5-42.5t43.5-21q124 0 124 353zm-128-609q0 106-75 181t-181 75t-181-75t-75-181t75-181t181-75t181 75t75 181z"/></svg>
                                        <span>Clients</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="true">
                                        <li><a href="/view-clients">View</a></li>
                                        <li><a href="/add-new-client">Add New</a></li>
                                    </ul>

                                </li>
                                @elseif(is_array($clients_access) && in_array('view', $clients_access) && in_array('create', $clients_access))
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1920" height="1792" viewBox="0 0 1920 1792"><path fill="currentColor" d="M593 896q-162 5-265 128H194q-82 0-138-40.5T0 865q0-353 124-353q6 0 43.5 21t97.5 42.5T384 597q67 0 133-23q-5 37-5 66q0 139 81 256zm1071 637q0 120-73 189.5t-194 69.5H523q-121 0-194-69.5T256 1533q0-53 3.5-103.5t14-109T300 1212t43-97.5t62-81t85.5-53.5T602 960q10 0 43 21.5t73 48t107 48t135 21.5t135-21.5t107-48t73-48t43-21.5q61 0 111.5 20t85.5 53.5t62 81t43 97.5t26.5 108.5t14 109t3.5 103.5zM640 256q0 106-75 181t-181 75t-181-75t-75-181t75-181T384 0t181 75t75 181zm704 384q0 159-112.5 271.5T960 1024T688.5 911.5T576 640t112.5-271.5T960 256t271.5 112.5T1344 640zm576 225q0 78-56 118.5t-138 40.5h-134q-103-123-265-128q81-117 81-256q0-29-5-66q66 23 133 23q59 0 119-21.5t97.5-42.5t43.5-21q124 0 124 353zm-128-609q0 106-75 181t-181 75t-181-75t-75-181t75-181t181-75t181 75t75 181z"/></svg>
                                        <span>Clients</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="true">
                                        <li><a href="/view-clients">View</a></li>
                                        <li><a href="/add-new-client">Add New</a></li>
                                    </ul>

                                </li>
                                @elseif(is_array($clients_access) && in_array('view', $clients_access))
                                <li>
                                    <a href="/view-clients" class="waves-effect">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1920" height="1792" viewBox="0 0 1920 1792"><path fill="currentColor" d="M593 896q-162 5-265 128H194q-82 0-138-40.5T0 865q0-353 124-353q6 0 43.5 21t97.5 42.5T384 597q67 0 133-23q-5 37-5 66q0 139 81 256zm1071 637q0 120-73 189.5t-194 69.5H523q-121 0-194-69.5T256 1533q0-53 3.5-103.5t14-109T300 1212t43-97.5t62-81t85.5-53.5T602 960q10 0 43 21.5t73 48t107 48t135 21.5t135-21.5t107-48t73-48t43-21.5q61 0 111.5 20t85.5 53.5t62 81t43 97.5t26.5 108.5t14 109t3.5 103.5zM640 256q0 106-75 181t-181 75t-181-75t-75-181t75-181T384 0t181 75t75 181zm704 384q0 159-112.5 271.5T960 1024T688.5 911.5T576 640t112.5-271.5T960 256t271.5 112.5T1344 640zm576 225q0 78-56 118.5t-138 40.5h-134q-103-123-265-128q81-117 81-256q0-29-5-66q66 23 133 23q59 0 119-21.5t97.5-42.5t43.5-21q124 0 124 353zm-128-609q0 106-75 181t-181 75t-181-75t-75-181t75-181t181-75t181 75t75 181z"/></svg>
                                        <span>View Clients</span>
                                    </a>
                                </li>
                                @elseif(is_array($clients_access) && in_array('create', $clients_access))
                                <li>
                                    <a href="/add-new-client" class=" waves-effect">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1920" height="1792" viewBox="0 0 1920 1792"><path fill="currentColor" d="M593 896q-162 5-265 128H194q-82 0-138-40.5T0 865q0-353 124-353q6 0 43.5 21t97.5 42.5T384 597q67 0 133-23q-5 37-5 66q0 139 81 256zm1071 637q0 120-73 189.5t-194 69.5H523q-121 0-194-69.5T256 1533q0-53 3.5-103.5t14-109T300 1212t43-97.5t62-81t85.5-53.5T602 960q10 0 43 21.5t73 48t107 48t135 21.5t135-21.5t107-48t73-48t43-21.5q61 0 111.5 20t85.5 53.5t62 81t43 97.5t26.5 108.5t14 109t3.5 103.5zM640 256q0 106-75 181t-181 75t-181-75t-75-181t75-181T384 0t181 75t75 181zm704 384q0 159-112.5 271.5T960 1024T688.5 911.5T576 640t112.5-271.5T960 256t271.5 112.5T1344 640zm576 225q0 78-56 118.5t-138 40.5h-134q-103-123-265-128q81-117 81-256q0-29-5-66q66 23 133 23q59 0 119-21.5t97.5-42.5t43.5-21q124 0 124 353zm-128-609q0 106-75 181t-181 75t-181-75t-75-181t75-181t181-75t181 75t75 181z"/></svg>
                                        <span>Add New Client</span>
                                    </a>
                                </li>
                                @endif
                @endif

                {{-- Slips access --}}
                @if (Session::has('salary_slips_access'))
                                @php
                                    $salary_slips_access = Session::get('salary_slips_access');
                                    // Convert to an array if it's a single value
                                    if (!is_array($salary_slips_access)) {
                                        $salary_slips_access = explode(',', $salary_slips_access);
                                        // Remove any empty elements resulting from the explode function
                                        $salary_slips_access = array_filter($salary_slips_access);
                                    }
                                @endphp
                                @if (is_array($salary_slips_access) && in_array('all', $salary_slips_access))
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
                                @elseif(is_array($salary_slips_access) && in_array('create', $salary_slips_access) && in_array('update', $salary_slips_access) && in_array('view', $salary_slips_access) && in_array('delete', $salary_slips_access))
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
                                @elseif(is_array($salary_slips_access) && in_array('view', $salary_slips_access) && in_array('create', $salary_slips_access))
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
                                @elseif(is_array($salary_slips_access) && in_array('view', $salary_slips_access))
                                <li>
                                    <a href="/view-slips" class="waves-effect">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16"><path fill="#fff" d="M12.32 8a3 3 0 0 0-2-.7H5.63A1.59 1.59 0 0 1 4 5.69a2 2 0 0 1 0-.25a1.59 1.59 0 0 1 1.63-1.33h4.62a1.59 1.59 0 0 1 1.57 1.33h1.5a3.08 3.08 0 0 0-3.07-2.83H8.67V.31H7.42v2.3H5.63a3.08 3.08 0 0 0-3.07 2.83a2.09 2.09 0 0 0 0 .25a3.07 3.07 0 0 0 3.07 3.07h4.74A1.59 1.59 0 0 1 12 10.35a1.86 1.86 0 0 1 0 .34a1.59 1.59 0 0 1-1.55 1.24h-4.7a1.59 1.59 0 0 1-1.55-1.24H2.69a3.08 3.08 0 0 0 3.06 2.73h1.67v2.27h1.25v-2.27h1.7a3.08 3.08 0 0 0 3.06-2.73v-.34A3.06 3.06 0 0 0 12.32 8"/></svg>
                                        <span> View Slips</span>
                                    </a>
                                </li>
                                @elseif(is_array($clients_access) && in_array('create', $clients_access))
                                <li>
                                    <a href="/generate-new-salary-slip" class="waves-effect">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16"><path fill="#fff" d="M12.32 8a3 3 0 0 0-2-.7H5.63A1.59 1.59 0 0 1 4 5.69a2 2 0 0 1 0-.25a1.59 1.59 0 0 1 1.63-1.33h4.62a1.59 1.59 0 0 1 1.57 1.33h1.5a3.08 3.08 0 0 0-3.07-2.83H8.67V.31H7.42v2.3H5.63a3.08 3.08 0 0 0-3.07 2.83a2.09 2.09 0 0 0 0 .25a3.07 3.07 0 0 0 3.07 3.07h4.74A1.59 1.59 0 0 1 12 10.35a1.86 1.86 0 0 1 0 .34a1.59 1.59 0 0 1-1.55 1.24h-4.7a1.59 1.59 0 0 1-1.55-1.24H2.69a3.08 3.08 0 0 0 3.06 2.73h1.67v2.27h1.25v-2.27h1.7a3.08 3.08 0 0 0 3.06-2.73v-.34A3.06 3.06 0 0 0 12.32 8"/></svg>
                                        <span> Create New Salary Slip</span>
                                    </a>

                                </li>
                            @endif
                @endif


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
                {{-- <li>
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

                </li> --}}
                {{-- Expenses --}}
                {{-- <li>
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

                </li> --}}
                {{-- Clients --}}
                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1920" height="1792" viewBox="0 0 1920 1792"><path fill="currentColor" d="M593 896q-162 5-265 128H194q-82 0-138-40.5T0 865q0-353 124-353q6 0 43.5 21t97.5 42.5T384 597q67 0 133-23q-5 37-5 66q0 139 81 256zm1071 637q0 120-73 189.5t-194 69.5H523q-121 0-194-69.5T256 1533q0-53 3.5-103.5t14-109T300 1212t43-97.5t62-81t85.5-53.5T602 960q10 0 43 21.5t73 48t107 48t135 21.5t135-21.5t107-48t73-48t43-21.5q61 0 111.5 20t85.5 53.5t62 81t43 97.5t26.5 108.5t14 109t3.5 103.5zM640 256q0 106-75 181t-181 75t-181-75t-75-181t75-181T384 0t181 75t75 181zm704 384q0 159-112.5 271.5T960 1024T688.5 911.5T576 640t112.5-271.5T960 256t271.5 112.5T1344 640zm576 225q0 78-56 118.5t-138 40.5h-134q-103-123-265-128q81-117 81-256q0-29-5-66q66 23 133 23q59 0 119-21.5t97.5-42.5t43.5-21q124 0 124 353zm-128-609q0 106-75 181t-181 75t-181-75t-75-181t75-181t181-75t181 75t75 181z"/></svg>
                        <span>Clients</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="/view-clients">View</a></li>
                        <li><a href="/add-new-client">Add New</a></li>
                    </ul>

                </li> --}}
                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1920" height="1280" viewBox="0 0 1920 1280"><path fill="currentColor" d="M768 896h384v-96h-128V352H910L762 489l77 80q42-37 55-57h2v288H768v96zm512-256q0 70-21 142t-59.5 134t-101.5 101t-138 39t-138-39t-101.5-101T661 782t-21-142t21-142t59.5-134T822 263t138-39t138 39t101.5 101t59.5 134t21 142zm512 256V384q-106 0-181-75t-75-181H384q0 106-75 181t-181 75v512q106 0 181 75t75 181h1152q0-106 75-181t181-75zm128-832v1152q0 26-19 45t-45 19H64q-26 0-45-19t-19-45V64q0-26 19-45T64 0h1792q26 0 45 19t19 45z"/></svg>
                        <span> Salary Slip</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="/view-slips">View</a></li>
                        <li><a href="/generate-new-salary-slip">Add New</a></li>
                    </ul>

                </li> --}}
                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <svg xmlns="http://www.w3.org/2000/svg" width="384" height="512" viewBox="0 0 384 512"><path fill="currentColor" d="M64 0C28.7 0 0 28.7 0 64v384c0 35.3 28.7 64 64 64h256c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zm192 0v128h128L256 0zM64 80c0-8.8 7.2-16 16-16h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16zm0 64c0-8.8 7.2-16 16-16h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16zm128 72c8.8 0 16 7.2 16 16v17.3c8.5 1.2 16.7 3.1 24.1 5.1c8.5 2.3 13.6 11 11.3 19.6s-11 13.6-19.6 11.3c-11.1-3-22-5.2-32.1-5.3c-8.4-.1-17.4 1.8-23.6 5.5c-5.7 3.4-8.1 7.3-8.1 12.8c0 3.7 1.3 6.5 7.3 10.1c6.9 4.1 16.6 7.1 29.2 10.9l.5.1c11.3 3.4 25.3 7.6 36.3 14.6c12.1 7.6 22.4 19.7 22.7 38.2c.3 19.3-9.6 33.3-22.9 41.6c-7.7 4.8-16.4 7.6-25.1 9.1V440c0 8.8-7.2 16-16 16s-16-7.2-16-16v-17.8c-11.2-2.1-21.7-5.7-30.9-8.9c-2.1-.7-4.2-1.4-6.2-2.1c-8.4-2.8-12.9-11.9-10.1-20.2s11.9-12.9 20.2-10.1c2.5.8 4.8 1.6 7.1 2.4c13.6 4.6 24.6 8.4 36.3 8.7c9.1.3 17.9-1.7 23.7-5.3c5.1-3.2 7.9-7.3 7.8-14c-.1-4.6-1.8-7.8-7.7-11.6c-6.8-4.3-16.5-7.4-29-11.2l-1.6-.5c-11-3.3-24.3-7.3-34.8-13.7c-12-7.2-22.6-18.9-22.7-37.3c-.1-19.4 10.8-32.8 23.8-40.5c7.5-4.4 15.8-7.2 24.1-8.7V232c0-8.8 7.2-16 16-16z"/></svg>
                        <span> Invoices </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="/view-invoices">View</a></li>
                        <li><a href="/create-new-invoice">Add New</a></li>
                    </ul>
                 </li> --}}

                {{-- login  --}}
                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M6 22q-.825 0-1.412-.587T4 20V10q0-.825.588-1.412T6 8h1V6q0-2.075 1.463-3.537T12 1q2.075 0 3.538 1.463T17 6v2h1q.825 0 1.413.588T20 10v10q0 .825-.587 1.413T18 22zm6-5q.825 0 1.413-.587T14 15q0-.825-.587-1.412T12 13q-.825 0-1.412.588T10 15q0 .825.588 1.413T12 17M9 8h6V6q0-1.25-.875-2.125T12 3q-1.25 0-2.125.875T9 6z"/></svg>
                        <span> Logins </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="/view-login">View</a></li>
                        <li><a href="/create-new-login">Create</a></li>
                    </ul>
                 </li> --}}

            </ul>

        </div>
        <!-- Sidebar -->
    </div>

    <div class="dropdown px-3 sidebar-user sidebar-user-info">
        <button type="button" class="btn w-100 px-0 border-0" id="page-header-user-dropdown"
            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <img src="{{ url('user.png') }}" class="img-fluid header-profile-user rounded-circle"
                        alt="">
                </div>

                <div class="flex-grow-1 ms-2 text-start">
                    <span class="ms-1 fw-medium user-name-text">{{ auth()->user()->user_name }} </span>
                </div>

                <div class="flex-shrink-0 text-end">
                    <i class="mdi mdi-dots-vertical font-size-16"></i>
                </div>
            </span>
        </button>
        <div class="dropdown-menu dropdown-menu-end">
            <!-- item-->
            <a class="dropdown-item" href="{{ Route('user.chang-password') }}"><i
                    class="mdi mdi-account-circle text-muted font-size-16 align-middle me-1"></i> <span
                    class="align-middle">Change Password</span></a>
            {{-- <a class="dropdown-item" href="apps-chat"><i
                    class="mdi mdi-message-text-outline text-muted font-size-16 align-middle me-1"></i> <span
                    class="align-middle">Messages</span></a> --}}
            {{-- <a class="dropdown-item" href="pages-faq"><i
                    class="mdi mdi-lifebuoy text-muted font-size-16 align-middle me-1"></i> <span
                    class="align-middle">Help</span></a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="pages-profile"><i
                    class="mdi mdi-wallet text-muted font-size-16 align-middle me-1"></i> <span
                    class="align-middle">Balance : <b>$5971.67</b></span></a>
            <a class="dropdown-item" href="#"><span class="badge bg-primary mt-1 float-end">New</span><i
                    class="mdi mdi-cog-outline text-muted font-size-16 align-middle me-1"></i> <span
                    class="align-middle">Settings</span></a> --}}
            <a class="dropdown-item" href="javascript:void()" onclick="confirmLogout()"><i
                    class="mdi mdi-lock text-muted font-size-16 align-middle me-1"></i> <span
                    class="align-middle">Logout</span></a>

        </div>
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
