<header id="page-topbar" style="background-color: #14213d; ">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box" style="background-color: #14213d;">
                <a href="index" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ url('reblate-favicon.png') }}" alt="logo-sm-dark" width="50"
                            style="object-fit: contain">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ url('reblate-favicon.png') }}" alt="logo-dark" width="50"
                            style="object-fit: contain">
                    </span>
                </a>

                <a href="index" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ url('reblate-favicon.png') }}" alt="logo-sm-light" width="50"
                            style="object-fit: contain">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ url('reblate-favicon.png') }}" alt="logo-light" width="50"
                            style="object-fit: contain">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn"
                id="vertical-menu-btn">
                <i class="ri-menu-2-line align-middle"></i>
            </button>

            <!-- start page title -->
            <div class="page-title-box align-self-center d-none d-md-block">
                <h4 class="page-title mb-0 text-light" style="font-size: 25px;">@yield('page-title')</h4>
            </div>
            <!-- end page title -->
        </div>

        <div class="d-flex align-items-center">


             @if (Auth()->user()->user_type == 'employee' || Auth()->user()->user_type == 'manager')
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn noti-icon waves-effect"
                        style="background-color: #14213d17; border-radius: 100px;"
                        id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ri-notification-3-line"></i>
                        @php
                            $notifications = $notifications ?? collect();
                        @endphp
                        @if ($notifications != null && $notifications->isNotEmpty())
                        <span class="noti-dot"></span>
                        @else
                        @endif
                    </button>
                
                    
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                        aria-labelledby="page-header-notifications-dropdown" >
                        @if ($notifications != null && $notifications->isNotEmpty())
                        @foreach ($notifications as $notify)
                        <div class="p-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0"> Notifications </h6>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ $notify->link }}" class="small"> View All</a>
                                </div>
                            </div>
                        </div>
                        <div  data-simplebar style="max-height: 230px;">
                            <a href="{{ $notify->link }}" class="text-reset notification-item">
                                <div class="d-flex">
                                    <div class="flex-1">
                                        <h6 class="mb-1">{{ $notify->title }}</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1">{{ $notify->message }}</p>
                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> {{ date('d F Y', strtotime($notify->date)) }}
                                            {{ $notify->time }}</p>
                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i><a href="javascript:void()"
                                                            onclick="markAsRead({{ $notify->id }},'all')">mark as
                                                            read</a></p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                        @else
                        <div class="p-2 border-top">
                            <div class="d-grid">
                                <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                    <i class="mdi mdi-arrow-right-circle me-1"></i> No Notifications
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>
                    
                </div>
            @endif 

                
            <div class="btn-group align-items-center">
                <div class="flex-grow-1 text-start" >
                    <span class="ms-1 fw-medium user-name-text text-light">{{ auth()->user()->user_name }}</span>
                </div>
                <button type="button" class="btn d-flex align-items-center dropdown-toggle"
                    data-bs-toggle="dropdown" aria-expanded="false"
                    style="background-color: #fca311; border-radius: 10px;margin:10px;">
                    @if (Session::has('emp_img'))
                        <!-- Debugging: Check if session variable exists -->
                        <img src="{{ url(Session::get('emp_img')) }}"
                        style='object-fit:cover;'
                        class="img-fluid header-profile-user rounded-circle"
                        alt="">
                        @else
                        <img src="{{ url('user.png') }}" style='object-fit:cover;'
                        class="img-fluid header-profile-user rounded-circle"
                        alt="">


                    @endif
                </button>

                <ul class="dropdown-menu" style="backdrop-filter:blur(10px);">
                    <li><a class="dropdown-item" href="{{ Route('user.chang-password') }}"><i
                                class="mdi mdi-account-circle text-muted font-size-16 align-middle me-1"></i> <span
                                class="align-middle">Change Password</span></a></li>
                    <li><a class="dropdown-item" href="javascript:void()" onclick="confirmLogout()"><i
                                class="mdi mdi-lock text-muted font-size-16 align-middle me-1"></i> <span
                                class="align-middle">Logout</span></a></li>


                    </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <a class="dropdown-item" href="{{ Route('user.chang-password') }}"><i
                                class="mdi mdi-account-circle text-muted font-size-16 align-middle me-1"></i> <span
                                class="align-middle">Change Password</span></a>
                        <a class="dropdown-item" href="javascript:void()" onclick="confirmLogout()"><i
                                class="mdi mdi-lock text-muted font-size-16 align-middle me-1"></i> <span
                                class="align-middle">Logout</span></a>

                    </div>
            </div>

        </div>
    </div>
</header>
<script>
                function markAsRead(id, str) {
                    if (str === "all") {
                        var not = "notifications_" + id;
                    }

                    if (str === "tasks") {
                        var not = "notifications_tasks_" + id;
                    }

                    var dc = document.getElementById(not).style.display = "none";

                    // Get CSRF token from somewhere (meta tag or inline assignment)
                    var csrfToken = "{{ csrf_token() }}"; // Ensure this is correctly populated

                    // Make an AJAX request to mark notification as read
                    fetch('/mark-as-read', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify({
                                id: id
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Notification marked as read:', data);
                            // Handle success
                        })
                        .catch(error => {
                            console.error('Error marking notification as read:', error);
                            // Handle error
                        });
                }
            </script>

