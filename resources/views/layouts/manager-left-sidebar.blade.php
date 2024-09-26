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
                    </a>
                </li>
                <li>
                    <a href="/view_profile/{{Auth()->user()->user_code}}" class="waves-effect">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M12 1C5.925 1 1 5.925 1 12s4.925 11 11 11s11-4.925 11-11S18.075 1 12 1m-.5 5a1 1 0 1 0 0 2h.5a1 1 0 1 0 0-2zM10 10a1 1 0 1 0 0 2h1v3h-1a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-1v-4a1 1 0 0 0-1-1z" clip-rule="evenodd"/></svg>
                        <span>Profile</span>
                    </a>
                </li>
                @if ( (auth()->user()->user_type == 'manager'))
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
                    <a href="/view-emp-tasks-each" class="waves-effect">
                        <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" viewBox="0 0 24 24"><path fill="white" d="M3 6a1 1 0 0 1 1-1h5a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm1.5 4.5h4v-4h-4Zm8.25-5a.75.75 0 0 0 0 1.5h7.5a.75.75 0 0 0 0-1.5zm0 6a.75.75 0 0 0 0 1.5h7.5a.75.75 0 0 0 0-1.5zm0 6a.75.75 0 0 0 0 1.5h7.5a.75.75 0 0 0 0-1.5zm-2.97-2.53a.75.75 0 0 1 0 1.06l-3.5 3.5a.75.75 0 0 1-1.06 0l-2-2a.75.75 0 1 1 1.06-1.06l1.47 1.47l2.97-2.97a.75.75 0 0 1 1.06 0"/></svg>
                        <span>My Tasks</span>
                    </a>
                </li>

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
                        <span>All Employees</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        @if(Session::has('employees_access') && Session::get('employees_access') != 'none' )
                           <li>
                            <a href="/manage-employees" class="waves-effect">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36">
                                    <path fill="currentColor"
                                        d="M12 16.14h-.87a8.67 8.67 0 0 0-6.43 2.52l-.24.28v8.28h4!z.08v-4.7l.55-.62l.25-.29a11 11 0 0 1 4.71-2.86A6.59 6.59 0 0 1 12 16.14Z"
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
                        </li>
                        @endif

                        @if(Session::has('tasks_access') && Session::get('tasks_access') != 'none' )
                             <li>
                                <a class="waves-effect" href="/view-tasks">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem"
                                        viewBox="0 0 24 24">
                                        <path fill="none" stroke="white" stroke-width="2"
                                            d="M12 20h12m-12-8h12M12 4h12M1 19l3 3l5-5m-8-6l3 3l5-5m0-8L4 6L1 3" />
                                    </svg>
                                    Employee Tasks
                                </a>
                            </li>
                        @endif


                        @if(Session::has('attendance_access') && Session::get('attendance_access') != 'none' )

                        <li>
                            <a class="waves-effect" href="/view-emp-attendence"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="1.2rem" height="1.2rem" viewBox="0 0 512 512">
                                    <path fill="#f9e7c0"
                                        d="M437.567 512H88.004a8.182 8.182 0 0 1-8.182-8.182V8.182A8.182 8.182 0 0 1 88.004 0H437.83a7.92 7.92 0 0 1 7.92 7.92v495.898a8.183 8.183 0 0 1-8.183 8.182" />
                                    <path fill="#597b91"
                                        d="M368.727 92.401H126.453c-6.147 0-11.13-4.983-11.13-11.13s4.983-11.13 11.13-11.13h242.273c6.146 0 11.13 4.983 11.13 11.13s-4.983 11.13-11.129 11.13m-40.597 61.723c0-6.147-4.983-11.13-11.13-11.13H126.453c-6.147 0-11.13 4.983-11.13 11.13s4.983 11.13 11.13 11.13H317c6.146 0 11.13-4.983 11.13-11.13m-96.935 72.854c0-6.147-4.983-11.13-11.13-11.13h-93.612c-6.147 0-11.13 4.983-11.13 11.13s4.983 11.13 11.13 11.13h93.612c6.147-.001 11.13-4.983 11.13-11.13m109.051 72.853c0-6.146-4.983-11.13-11.13-11.13H126.453c-6.147 0-11.13 4.983-11.13 11.13s4.983 11.13 11.13 11.13h202.663c6.147 0 11.13-4.983 11.13-11.13m49.884-72.853c0-6.147-4.983-11.13-11.13-11.13H276.612c-6.146 0-11.13 4.983-11.13 11.13s4.983 11.13 11.13 11.13H379c6.146-.001 11.13-4.983 11.13-11.13m-92.38 145.707c0-6.146-4.983-11.13-11.13-11.13H126.453c-6.147 0-11.13 4.983-11.13 11.13s4.983 11.13 11.13 11.13H286.62c6.147-.001 11.13-4.984 11.13-11.13m66.504 72.853c0-6.146-4.983-11.13-11.13-11.13H126.453c-6.147 0-11.13 4.983-11.13 11.13s4.983 11.13 11.13 11.13h226.671c6.147 0 11.13-4.983 11.13-11.13m25.876-72.853c0-6.146-4.983-11.13-11.13-11.13h-51.752c-6.146 0-11.13 4.983-11.13 11.13s4.983 11.13 11.13 11.13H379c6.146-.001 11.13-4.984 11.13-11.13" />
                                </svg>
                                Attendence
                            </a>
                        </li>
                        @endif

                        <li>
                            <a href="/view-login" class=" waves-effect">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M6 22q-.825 0-1.412-.587T4 20V10q0-.825.588-1.412T6 8h1V6q0-2.075 1.463-3.537T12 1q2.075 0 3.538 1.463T17 6v2h1q.825 0 1.413.588T20 10v10q0 .825-.587 1.413T18 22zm6-5q.825 0 1.413-.587T14 15q0-.825-.587-1.412T12 13q-.825 0-1.412.588T10 15q0 .825.588 1.413T12 17M9 8h6V6q0-1.25-.875-2.125T12 3q-1.25 0-2.125.875T9 6z" />
                                </svg>
                                <span> Employee Logins </span>
                            </a>

                        </li>
                        @if (auth()->user()->user_type == 'manager')
                        <li>
                            <a href="/leave-requests" class="waves-effect">
                                <svg fill="#fff" height="200px" width="200px" version="1.1" id="Capa_1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    viewBox="0 0 55 55" xml:space="preserve" stroke="#fff">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <g>
                                            <path
                                                d="M54.924,24.382c0.101-0.244,0.101-0.519,0-0.764c-0.051-0.123-0.125-0.234-0.217-0.327L42.708,11.293 c-0.391-0.391-1.023-0.391-1.414,0s-0.391,1.023,0,1.414L51.587,23H36.001V1c0-0.553-0.447-1-1-1h-34 c-0.032,0-0.06,0.015-0.091,0.018C0.854,0.023,0.805,0.036,0.752,0.05C0.658,0.075,0.574,0.109,0.493,0.158 C0.467,0.174,0.435,0.174,0.411,0.192C0.38,0.215,0.356,0.244,0.328,0.269c-0.017,0.016-0.035,0.03-0.051,0.047 C0.201,0.398,0.139,0.489,0.093,0.589c-0.009,0.02-0.014,0.04-0.022,0.06C0.029,0.761,0.001,0.878,0.001,1v46 c0,0.125,0.029,0.243,0.072,0.355c0.014,0.037,0.035,0.068,0.053,0.103c0.037,0.071,0.079,0.136,0.132,0.196 c0.029,0.032,0.058,0.061,0.09,0.09c0.058,0.051,0.123,0.093,0.193,0.13c0.037,0.02,0.071,0.041,0.111,0.056 c0.017,0.006,0.03,0.018,0.047,0.024l22,7C22.797,54.984,22.899,55,23.001,55c0.21,0,0.417-0.066,0.59-0.192 c0.258-0.188,0.41-0.488,0.41-0.808v-6h11c0.553,0,1-0.447,1-1V25h15.586L41.294,35.293c-0.391,0.391-0.391,1.023,0,1.414 C41.489,36.902,41.745,37,42.001,37s0.512-0.098,0.707-0.293l11.999-11.999C54.799,24.616,54.873,24.505,54.924,24.382z M22.001,52.633l-20-6.364V2.367l20,6.364V52.633z M34.001,46h-10V8c0-0.436-0.282-0.821-0.697-0.953L7.442,2h26.559V46z">
                                            </path>
                                            <path
                                                d="M20.372,31.071l-5-2c-0.509-0.205-1.095,0.043-1.3,0.558c-0.205,0.513,0.045,1.095,0.558,1.3l5,2 C19.751,32.978,19.877,33,20.001,33c0.396,0,0.772-0.237,0.929-0.629C21.134,31.858,20.884,31.276,20.372,31.071z">
                                            </path>
                                        </g>
                                    </g>
                                </svg>
                                <span>Leaves</span>
                            </a>
                        </li>
                        @endif




                    </ul>
                </li>

                <!-- finance -->
                @if(Session::get('invoices_access') != 'none' || Session::get('salary_slips_access') != 'none' || Session::get('salary_slips_access') != 'none'  || Session::get('tasks_access') != 'none')
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <svg xmlns="http://www.w3.org/2000/svg" width="384" height="512" viewBox="0 0 384 512">
                            <path fill="currentColor"
                                d="M64 0C28.7 0 0 28.7 0 64v384c0 35.3 28.7 64 64 64h256c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zm192 0v128h128L256 0zM64 80c0-8.8 7.2-16 16-16h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16zm0 64c0-8.8 7.2-16 16-16h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16zm128 72c8.8 0 16 7.2 16 16v17.3c8.5 1.2 16.7 3.1 24.1 5.1c8.5 2.3 13.6 11 11.3 19.6s-11 13.6-19.6 11.3c-11.1-3-22-5.2-32.1-5.3c-8.4-.1-17.4 1.8-23.6 5.5c-5.7 3.4-8.1 7.3-8.1 12.8c0 3.7 1.3 6.5 7.3 10.1c6.9 4.1 16.6 7.1 29.2 10.9l.5.1c11.3 3.4 25.3 7.6 36.3 14.6c12.1 7.6 22.4 19.7 22.7 38.2c.3 19.3-9.6 33.3-22.9 41.6c-7.7 4.8-16.4 7.6-25.1 9.1V440c0 8.8-7.2 16-16 16s-16-7.2-16-16v-17.8c-11.2-2.1-21.7-5.7-30.9-8.9c-2.1-.7-4.2-1.4-6.2-2.1c-8.4-2.8-12.9-11.9-10.1-20.2s11.9-12.9 20.2-10.1c2.5.8 4.8 1.6 7.1 2.4c13.6 4.6 24.6 8.4 36.3 8.7c9.1.3 17.9-1.7 23.7-5.3c5.1-3.2 7.9-7.3 7.8-14c-.1-4.6-1.8-7.8-7.7-11.6c-6.8-4.3-16.5-7.4-29-11.2l-1.6-.5c-11-3.3-24.3-7.3-34.8-13.7c-12-7.2-22.6-18.9-22.7-37.3c-.1-19.4 10.8-32.8 23.8-40.5c7.5-4.4 15.8-7.2 24.1-8.7V232c0-8.8 7.2-16 16-16z" />
                        </svg>
                        <span>Finance</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                         @if(Session::has('invoices_access') && Session::get('invoices_access') != 'none' )
                        <li>
                            <a href="/view-invoices" class=" waves-effect">
                                <svg xmlns="http://www.w3.org/2000/svg" width="384" height="512" viewBox="0 0 384 512">
                                    <path fill="currentColor"
                                        d="M64 0C28.7 0 0 28.7 0 64v384c0 35.3 28.7 64 64 64h256c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zm192 0v128h128L256 0zM64 80c0-8.8 7.2-16 16-16h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16zm0 64c0-8.8 7.2-16 16-16h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16zm128 72c8.8 0 16 7.2 16 16v17.3c8.5 1.2 16.7 3.1 24.1 5.1c8.5 2.3 13.6 11 11.3 19.6s-11 13.6-19.6 11.3c-11.1-3-22-5.2-32.1-5.3c-8.4-.1-17.4 1.8-23.6 5.5c-5.7 3.4-8.1 7.3-8.1 12.8c0 3.7 1.3 6.5 7.3 10.1c6.9 4.1 16.6 7.1 29.2 10.9l.5.1c11.3 3.4 25.3 7.6 36.3 14.6c12.1 7.6 22.4 19.7 22.7 38.2c.3 19.3-9.6 33.3-22.9 41.6c-7.7 4.8-16.4 7.6-25.1 9.1V440c0 8.8-7.2 16-16 16s-16-7.2-16-16v-17.8c-11.2-2.1-21.7-5.7-30.9-8.9c-2.1-.7-4.2-1.4-6.2-2.1c-8.4-2.8-12.9-11.9-10.1-20.2s11.9-12.9 20.2-10.1c2.5.8 4.8 1.6 7.1 2.4c13.6 4.6 24.6 8.4 36.3 8.7c9.1.3 17.9-1.7 23.7-5.3c5.1-3.2 7.9-7.3 7.8-14c-.1-4.6-1.8-7.8-7.7-11.6c-6.8-4.3-16.5-7.4-29-11.2l-1.6-.5c-11-3.3-24.3-7.3-34.8-13.7c-12-7.2-22.6-18.9-22.7-37.3c-.1-19.4 10.8-32.8 23.8-40.5c7.5-4.4 15.8-7.2 24.1-8.7V232c0-8.8 7.2-16 16-16z" />
                                </svg>
                                <span> Invoices </span>
                            </a>

                        </li>
                        @endif
                       @if(Session::has('salary_slips_access') && Session::get('salary_slips_access') != 'none' )

                        <li>
                            <a href="/view-slips" class=" waves-effect">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16"><path fill="#fff" d="M12.32 8a3 3 0 0 0-2-.7H5.63A1.59 1.59 0 0 1 4 5.69a2 2 0 0 1 0-.25a1.59 1.59 0 0 1 1.63-1.33h4.62a1.59 1.59 0 0 1 1.57 1.33h1.5a3.08 3.08 0 0 0-3.07-2.83H8.67V.31H7.42v2.3H5.63a3.08 3.08 0 0 0-3.07 2.83a2.09 2.09 0 0 0 0 .25a3.07 3.07 0 0 0 3.07 3.07h4.74A1.59 1.59 0 0 1 12 10.35a1.86 1.86 0 0 1 0 .34a1.59 1.59 0 0 1-1.55 1.24h-4.7a1.59 1.59 0 0 1-1.55-1.24H2.69a3.08 3.08 0 0 0 3.06 2.73h1.67v2.27h1.25v-2.27h1.7a3.08 3.08 0 0 0 3.06-2.73v-.34A3.06 3.06 0 0 0 12.32 8"/></svg>
                                <span> Salary Slips</span>
                            </a>
                        </li>
                        @endif

                     @if(Session::has('expenses_access') && Session::get('expenses_access') != 'none' )

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
                                <span>Expenses</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                <!-- clients  -->
                <li>
                    @if(Session::has('clients_access') && Session::get('clients_access') != 'none' )
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1920" height="1792"
                            viewBox="0 0 1920 1792">
                            <path fill="currentColor"
                                d="M593 896q-162 5-265 128H194q-82 0-138-40.5T0 865q0-353 124-353q6 0 43.5 21t97.5 42.5T384 597q67 0 133-23q-5 37-5 66q0 139 81 256zm1071 637q0 120-73 189.5t-194 69.5H523q-121 0-194-69.5T256 1533q0-53 3.5-103.5t14-109T300 1212t43-97.5t62-81t85.5-53.5T602 960q10 0 43 21.5t73 48t107 48t135 21.5t135-21.5t107-48t73-48t43-21.5q61 0 111.5 20t85.5 53.5t62 81t43 97.5t26.5 108.5t14 109t3.5 103.5zM640 256q0 106-75 181t-181 75t-181-75t-75-181t75-181T384 0t181 75t75 181zm704 384q0 159-112.5 271.5T960 1024T688.5 911.5T576 640t112.5-271.5T960 256t271.5 112.5T1344 640zm576 225q0 78-56 118.5t-138 40.5h-134q-103-123-265-128q81-117 81-256q0-29-5-66q66 23 133 23q59 0 119-21.5t97.5-42.5t43.5-21q124 0 124 353zm-128-609q0 106-75 181t-181 75t-181-75t-75-181t75-181t181-75t181 75t75 181z" />
                        </svg>
                        <span>All Clients</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <a href="/view-clients" class=" waves-effect">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1920" height="1792"
                                    viewBox="0 0 1920 1792">
                                    <path fill="currentColor"
                                        d="M593 896q-162 5-265 128H194q-82 0-138-40.5T0 865q0-353 124-353q6 0 43.5 21t97.5 42.5T384 597q67 0 133-23q-5 37-5 66q0 139 81 256zm1071 637q0 120-73 189.5t-194 69.5H523q-121 0-194-69.5T256 1533q0-53 3.5-103.5t14-109T300 1212t43-97.5t62-81t85.5-53.5T602 960q10 0 43 21.5t73 48t107 48t135 21.5t135-21.5t107-48t73-48t43-21.5q61 0 111.5 20t85.5 53.5t62 81t43 97.5t26.5 108.5t14 109t3.5 103.5zM640 256q0 106-75 181t-181 75t-181-75t-75-181t75-181T384 0t181 75t75 181zm704 384q0 159-112.5 271.5T960 1024T688.5 911.5T576 640t112.5-271.5T960 256t271.5 112.5T1344 640zm576 225q0 78-56 118.5t-138 40.5h-134q-103-123-265-128q81-117 81-256q0-29-5-66q66 23 133 23q59 0 119-21.5t97.5-42.5t43.5-21q124 0 124 353zm-128-609q0 106-75 181t-181 75t-181-75t-75-181t75-181t181-75t181 75t75 181z" />
                                </svg>
                                <span>Clients</span>
                            </a>
                        </li>
                    </ul>
                    @endif
                </li>
                <li>
                   <a href="{{ route('Reports.index') }}" class="waves-effect">
                    <svg width="64px" height="64px" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <defs> <style>.cls-1{fill:#f2f2fc;}.cls-2{fill:#61729b;}.cls-3{fill:#2c3b73;}.cls-4{fill:#d8d8fc;}.cls-5{fill:#fdbf00;}.cls-6{fill:#4bb9ec;}.cls-7{fill:#f03800;}</style> </defs> <title></title> <g id="dashboard"> <path class="cls-1" d="M57,15.008H53.061V45.992a1,1,0,0,1-1,1h-40a1,1,0,0,1-1-1V15.008H7v34H57Z"></path> <path class="cls-2" d="M37,51.008v3a1,1,0,0,1-1,1H28a1,1,0,0,1-1-1v-3H5.071a7.006,7.006,0,0,0,6.929,6H52a7,7,0,0,0,6.929-6Z"></path> <rect class="cls-3" height="2" width="6" x="29" y="51.008"></rect> <path class="cls-4" d="M51.061,12.706h-38V44.992h38ZM22.434,15.787a1,1,0,0,1,1,1V23.24h6.453a1,1,0,0,1,1,1,8.453,8.453,0,1,1-8.453-8.453Zm10.688,26.2a1,1,0,0,1-1,1h-16a1,1,0,0,1-1-1v-6a1,1,0,0,1,1-1h16a1,1,0,0,1,1,1ZM32.123,23H24.67a1,1,0,0,1-1-1V14.551a1,1,0,0,1,1-1A8.457,8.457,0,0,1,33.123,22,1,1,0,0,1,32.123,23Zm5.018,18.987a1,1,0,0,1-2,0v-6a1,1,0,0,1,2,0Zm4,0a1,1,0,0,1-2,0v-8a1,1,0,0,1,2,0Zm4,0a1,1,0,0,1-2,0v-9.5a1,1,0,0,1,2,0Zm3.981,0a1,1,0,0,1-2,0v-12a1,1,0,0,1,2,0Zm.125-15H34.918a1,1,0,0,1,0-2H49.247a1,1,0,0,1,0,2Zm0-2.857H34.918a1,1,0,0,1,0-2H49.247a1,1,0,0,1,0,2Zm0-2.857H34.918a1,1,0,0,1,0-2H49.247a1,1,0,0,1,0,2Zm0-2.857H34.918a1,1,0,0,1,0-2H49.247a1,1,0,0,1,0,2Z"></path> <path class="cls-3" d="M51.061,6.992h-38v3.714h38ZM17.775,9.849H14.918a1,1,0,0,1,0-2h2.857a1,1,0,0,1,0,2Zm5.715,0H20.632a1,1,0,0,1,0-2H23.49a1,1,0,0,1,0,2Zm5.714,0H26.347a1,1,0,1,1,0-2H29.2a1,1,0,0,1,0,2Z"></path> <path d="M60,49.008H59v-35a1,1,0,0,0-1-1H53.061V5.992a1,1,0,0,0-1-1h-40a1,1,0,0,0-1,1v7.016H6a1,1,0,0,0-1,1v35H4a1,1,0,0,0-1,1,9,9,0,0,0,9,9H52a9,9,0,0,0,9-9A1,1,0,0,0,60,49.008Zm-8,8H12a7.006,7.006,0,0,1-6.929-6H27v3a1,1,0,0,0,1,1h8a1,1,0,0,0,1-1v-3H58.929A7,7,0,0,1,52,57.008Zm-38.939-44.3h38V44.992h-38Zm0-5.714h38v3.714h-38ZM7,15.008h4.061V45.992a1,1,0,0,0,1,1h40a1,1,0,0,0,1-1V15.008H57v34H7Zm22,36h6v2H29Z"></path> <path class="cls-4" d="M17.775,7.849H14.918a1,1,0,0,0,0,2h2.857a1,1,0,0,0,0-2Z"></path> <path class="cls-4" d="M23.49,7.849H20.632a1,1,0,0,0,0,2H23.49a1,1,0,0,0,0-2Z"></path> <path class="cls-4" d="M29.2,7.849H26.347a1,1,0,1,0,0,2H29.2a1,1,0,0,0,0-2Z"></path> <path class="cls-5" d="M22.434,30.694A6.459,6.459,0,0,0,28.81,25.24H22.434a1,1,0,0,1-1-1V17.864a6.454,6.454,0,0,0,1,12.83Z"></path> <path d="M22.434,32.694a8.457,8.457,0,0,0,8.453-8.453,1,1,0,0,0-1-1H23.434V16.787a1,1,0,0,0-1-1,8.453,8.453,0,1,0,0,16.907Zm-1-14.83V24.24a1,1,0,0,0,1,1H28.81a6.454,6.454,0,1,1-7.376-7.376Z"></path> <path class="cls-6" d="M25.669,15.628V21h5.376A6.464,6.464,0,0,0,25.669,15.628Z"></path> <path d="M24.67,13.551a1,1,0,0,0-1,1V22a1,1,0,0,0,1,1h7.453a1,1,0,0,0,1-1A8.457,8.457,0,0,0,24.67,13.551Zm1,7.453V15.628A6.464,6.464,0,0,1,31.046,21Z"></path> <path d="M36.141,34.992a1,1,0,0,0-1,1v6a1,1,0,0,0,2,0v-6A1,1,0,0,0,36.141,34.992Z"></path> <path d="M40.141,32.992a1,1,0,0,0-1,1v8a1,1,0,0,0,2,0v-8A1,1,0,0,0,40.141,32.992Z"></path> <path d="M44.141,31.492a1,1,0,0,0-1,1v9.5a1,1,0,0,0,2,0v-9.5A1,1,0,0,0,44.141,31.492Z"></path> <path d="M48.122,28.992a1,1,0,0,0-1,1v12a1,1,0,0,0,2,0v-12A1,1,0,0,0,48.122,28.992Z"></path> <path d="M49.247,16.421H34.918a1,1,0,0,0,0,2H49.247a1,1,0,0,0,0-2Z"></path> <path d="M49.247,19.278H34.918a1,1,0,0,0,0,2H49.247a1,1,0,0,0,0-2Z"></path> <path d="M49.247,22.135H34.918a1,1,0,0,0,0,2H49.247a1,1,0,0,0,0-2Z"></path> <path d="M49.247,24.992H34.918a1,1,0,0,0,0,2H49.247a1,1,0,0,0,0-2Z"></path> <rect class="cls-7" height="4" width="14" x="17.122" y="36.992"></rect> <path d="M32.122,34.992h-16a1,1,0,0,0-1,1v6a1,1,0,0,0,1,1h16a1,1,0,0,0,1-1v-6A1,1,0,0,0,32.122,34.992Zm-1,6h-14v-4h14Z"></path> </g> </g></svg>
                       <span>Reports</span>
                   </a>
               </li>
                <li>
                    <a class="waves-effect" href="/office-time">
                        <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" viewBox="0 0 20 20"><path fill="#fff" d="M10 0c5.523 0 10 4.477 10 10s-4.477 10-10 10S0 15.523 0 10S4.477 0 10 0m-.93 5.581a.698.698 0 0 0-.698.698v5.581c0 .386.312.698.698.698h5.581a.698.698 0 1 0 0-1.395H9.767V6.279a.698.698 0 0 0-.697-.698"/></svg>
                       Office Times
                    </a>
                </li>

                <li>
                    <a href="/view-quotations" class="waves-effect">
                     <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 512 512"><path fill="#f9e7c0" d="M437.567 512H88.004a8.182 8.182 0 0 1-8.182-8.182V8.182A8.182 8.182 0 0 1 88.004 0H288.79l156.96 156.96v346.858a8.183 8.183 0 0 1-8.183 8.182"/><path fill="#eac083" d="m288.79 0l156.96 156.96H322.152c-18.426 0-33.363-14.937-33.363-33.363V0z"/><path fill="#597b91" d="M235.078 92.401H126.453c-6.147 0-11.13-4.983-11.13-11.13s4.983-11.13 11.13-11.13h108.625c6.147 0 11.13 4.983 11.13 11.13s-4.983 11.13-11.13 11.13m11.13 61.723c0-6.147-4.983-11.13-11.13-11.13H126.453c-6.147 0-11.13 4.983-11.13 11.13s4.983 11.13 11.13 11.13h108.625c6.147 0 11.13-4.983 11.13-11.13m0 72.854c0-6.147-4.983-11.13-11.13-11.13H126.453c-6.147 0-11.13 4.983-11.13 11.13s4.983 11.13 11.13 11.13h108.625c6.147-.001 11.13-4.983 11.13-11.13m94.038 72.853c0-6.146-4.983-11.13-11.13-11.13H126.453c-6.147 0-11.13 4.983-11.13 11.13s4.983 11.13 11.13 11.13h202.663c6.147 0 11.13-4.983 11.13-11.13m37.493-72.853c0-6.147-4.983-11.13-11.13-11.13h-74.985c-6.146 0-11.13 4.983-11.13 11.13s4.983 11.13 11.13 11.13h74.985c6.147-.001 11.13-4.983 11.13-11.13M299.92 372.685c0-6.146-4.983-11.13-11.13-11.13H126.453c-6.147 0-11.13 4.983-11.13 11.13s4.983 11.13 11.13 11.13H288.79c6.147-.001 11.13-4.984 11.13-11.13m66.21 72.853c0-6.146-4.983-11.13-11.13-11.13H126.453c-6.147 0-11.13 4.983-11.13 11.13s4.983 11.13 11.13 11.13H355c6.146 0 11.13-4.983 11.13-11.13"/></svg>
                        <span>Quotation</span>
                    </a>
                </li>


               <li>
                <a href="/announcements" class="waves-effect">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" viewBox="0 0 24 24">
                        <path fill="none" stroke="white" stroke-width="2"
                            d="M11 15c3 0 8 4 8 4V3s-5 4-8 4zm-6 0l3 8h4l-3-8m10-1a3 3 0 1 0 0-6m-8 11c1 0 3-1 3-3M2 11c0-3.111 1.791-4 4-4h5v8H6c-2.209 0-4-.889-4-4Z" />
                    </svg>
                    <span>Announcement</span>
                </a>
            </li>



            </ul>

        </div>
        <!-- Sidebar -->
    </div>

    {{-- <div class="dropdown px-3 sidebar-user sidebar-user-info">
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

            <a class="dropdown-item" href="{{ Route('user.chang-password') }}"><i
                    class="mdi mdi-account-circle text-muted font-size-16 align-middle me-1"></i> <span
                    class="align-middle">Change Password</span></a>
            <a class="dropdown-item" href="javascript:void()" onclick="confirmLogout()"><i
                    class="mdi mdi-lock text-muted font-size-16 align-middle me-1"></i> <span
                    class="align-middle">Logout</span></a>

        </div>
    </div> --}}


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
