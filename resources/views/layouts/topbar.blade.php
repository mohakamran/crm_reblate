
<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
              <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ url('reblate-favicon.png') }}" alt="logo-sm-dark" width="50" style="object-fit: contain">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ url('reblate-favicon.png') }}" alt="logo-dark" width="50" style="object-fit: contain">
                    </span>
                </a>

                <a href="index" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ url('reblate-favicon.png') }}" alt="logo-sm-light" width="50" style="object-fit: contain">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ url('reblate-favicon.png') }}" alt="logo-light" width="50" style="object-fit: contain">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn" id="vertical-menu-btn">
                <i class="ri-menu-2-line align-middle"></i>
            </button>

          <!-- start page title -->
          <div class="page-title-box align-self-center d-none d-md-block">
            <h4 class="page-title mb-0">@yield('page-title')</h4>
          </div>
          <!-- end page title -->
        </div>

        <div class="d-flex align-items-center">


            @if(Auth()->user()->user_type == "employee" || Auth()->user()->user_type == "manager")
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn noti-icon waves-effect" style="background-color: #14213d17; border-radius: 100px;" id="page-header-notifications-dropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ri-notification-3-line"></i>
                        <span class="noti-dot"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                        aria-labelledby="page-header-notifications-dropdown">
                        <div class="p-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0"> Notifications </h6>
                                </div>
                                <div class="col-auto">
                                    <a href="#!" class="small"> View All</a>
                                </div>
                            </div>
                        </div>
                        <div data-simplebar style="max-height: 230px;">
                            <a href="" class="text-reset notification-item">
                                <div class="d-flex">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title bg-primary rounded-circle font-size-16">
                                            <i class="ri-shopping-cart-line"></i>
                                        </span>
                                    </div>
                                    <div class="flex-1">
                                        <h6 class="mb-1">Your order is placed</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1">If several languages coalesce the grammar</p>
                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="" class="text-reset notification-item">
                                <div class="d-flex">
                                    <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}"
                                        class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                    <div class="flex-1">
                                        <h6 class="mb-1">James Lemire</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1">It will seem like simplified English.</p>
                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="" class="text-reset notification-item">
                                <div class="d-flex">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title bg-success rounded-circle font-size-16">
                                            <i class="ri-checkbox-circle-line"></i>
                                        </span>
                                    </div>
                                    <div class="flex-1">
                                        <h6 class="mb-1">Your item is shipped</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1">If several languages coalesce the grammar</p>
                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="" class="text-reset notification-item">
                                <div class="d-flex">
                                    <img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}"
                                        class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                    <div class="flex-1">
                                        <h6 class="mb-1">Salena Layfield</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1">As a skeptical Cambridge friend of mine occidental.</p>
                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="p-2 border-top">
                            <div class="d-grid">
                                <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                    <i class="mdi mdi-arrow-right-circle me-1"></i> View More..
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="btn-group">
                <button type="button" class="btn d-flex align-items-center dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #e3e3e3; border-radius: 10px;margin:10px;">
                    @if (Session::has('emp_img'))
                    <!-- Debugging: Check if session variable exists -->

                    <!-- Debugging: Output session variable value -->


                    @if (Session::get('emp_img') != "" && file_exists(Session::get('emp_img')))
                        <!-- Debugging: Output image path -->


                        <!-- Render image -->
                        <img src="{{ url(Session::get('emp_img')) }}" class="img-fluid header-profile-user rounded-circle" alt="">
                    @else


                        <!-- Render default image -->
                        <img src="{{ url('user.png') }}" class="img-fluid header-profile-user rounded-circle" alt="">
                    @endif
                @endif
                <div class="flex-grow-1 text-start">
                    <span class="ms-1 fw-medium user-name-text">{{ auth()->user()->user_name }}</span>
                </div>
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{ Route('user.chang-password')}}"><i
                    class="mdi mdi-account-circle text-muted font-size-16 align-middle me-1"></i> <span
                    class="align-middle">Change Password</span></a></li>
                  <li><a class="dropdown-item" href="javascript:void()" onclick="confirmLogout()"><i
                    class="mdi mdi-lock text-muted font-size-16 align-middle me-1"></i> <span
                    class="align-middle">Logout</span></a></li>

                </ul>
              </div>

        </div>
    </div>
</header>
