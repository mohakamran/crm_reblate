@extends('layouts.master')
@section('title')
    {{ $title }}
@endsection
@section('page-title')
    {{ $title }}
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        {{-- <p class="card-title">Fill below form to add new employee. Fields with(<span
                                style="color:red;">*</span>) are mandatory to fill, remaining are optional.</p> --}}
                        <br>

                        <form method="post" action="{{ $route }}" enctype="multipart/form-data">
                            @csrf
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" id="close-now">
                                    {{ session('success') }}
                                    <button type="button" onclick="hideNow()" class="close" data-dismiss="alert"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="text" placeholder="User Name" name="user_name"
                                            value="{{ isset($user->user_name) ? $user->user_name : old('user_name') }}">
                                        @error('user_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label for="">User Name <span class="text-danger">*</span></label>

                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="email" placeholder="email" name="user_email"
                                        value="{{ isset($user->user_email) ? $user->user_email : old('user_email') }}">
                                        @error('user_email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label for="">Email address <span class="text-danger">*</span></label>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="password" placeholder="Password"
                                            name="user_password" id="user_password">
                                        @error('user_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label for="">Password <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="mb-3">

                                        <input type="checkbox" onclick="togglePasswordVisibility()" id="passwordCheck">
                                        <label for="showPassword">Show Password</label>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="password" placeholder="Password"
                                            name="user_password_confirmation" id="confirmPassword">
                                        @error('user_password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label for="">Confirm Password <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="mb-3">

                                        <input type="checkbox" onclick="toggleConfirmPasswordVisibility()" id="passwordConfirmCheck">
                                        <label for="showPassword">Show Password</label>

                                    </div>
                                </div>

                            </div>


                            <div>
                                <button type="submit" class="btn btn-primary  w-md"
                                    style="background-color: #14213D ; border-color: #fff;">{{ $btn_text }}</button>
                            </div>
                        </form>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
        <script>
            function hideNow() {
                var divElement = document.getElementById('close-now');
                divElement.style.display = 'none';
            }

            function togglePasswordVisibility() {
                const passwordInput = document.getElementById('user_password');
                const checkbox = document.getElementById('passwordCheck');

                passwordInput.type = checkbox.checked ? 'text' : 'password';
            }
            function toggleConfirmPasswordVisibility() {
                const passwordInput = document.getElementById('confirmPassword');
                const checkbox = document.getElementById('passwordConfirmCheck');

                passwordInput.type = checkbox.checked ? 'text' : 'password';
            }
        </script>
    @endsection
    @section('scripts')
        <!-- bs custom file input plugin -->
        <script src="{{ URL::asset('build/libs/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/form-element.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
