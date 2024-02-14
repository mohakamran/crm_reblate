@extends('layouts.master')
@section('title')
     Google 2fA
@endsection
@section('page-title')
     Google 2FA
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><strong>Two Factor Authentication</strong></div>
                    <div class="card-body">
                        <p>Two factor authentication (2FA) strengthens access security by requiring two methods (also referred to as factors) to verify your identity. Two factor authentication protects against phishing, social engineering and password brute force attacks and secures your logins from attackers exploiting weak or stolen credentials.</p>

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if($data['user']->loginSecurity == null)
                            <form class="form-horizontal" method="POST" action="{{ route('generate2faSecret') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        Generate Secret Key to Enable 2FA
                                    </button>
                                </div>
                            </form>
                        @elseif(!$data['user']->loginSecurity->google2fa_enable)
                            1. Scan this QR code with your Google Authenticator App. Alternatively, you can use the code: <code>{{ $data['secret'] }}</code><br/>
                            <img src="{{$data['google2fa_url'] }}" alt="">
                            <br/><br/>
                            2. Enter the pin from Google Authenticator app:<br/><br/>
                            <form class="form-horizontal" method="POST" action="{{ route('enable2fa') }}">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('verify-code') ? ' has-error' : '' }}">
                                    <label for="secret" class="control-label">Authenticator Code</label>
                                    <input id="secret" type="password" class="form-control col-md-4" name="secret" required>
                                    @if ($errors->has('verify-code'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('verify-code') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    Enable 2FA
                                </button>
                            </form>
                        @elseif($data['user']->loginSecurity->google2fa_enable)
                            <div class="alert alert-success">
                                2FA is currently <strong>enabled</strong> on your account.
                            </div>
                            <p>If you are looking to disable Two Factor Authentication. Please confirm your password and Click Disable 2FA Button.</p>
                            <form class="form-horizontal" method="POST" action="{{ route('disable2fa') }}">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                                    <label for="change-password" class="control-label">Current Password</label>
                                        <input id="current-password" type="password" class="form-control col-md-4" name="current-password" required>
                                        @if ($errors->has('current-password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                        </span>
                                        @endif
                                </div>
                                <button type="submit" class="btn btn-primary ">Disable 2FA</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- end row -->
        <script>
            function hideNow() {
                var divElement = document.getElementById('close-now');
                divElement.style.display = 'none';
            }

               // Get references to the select boxes
               const exParentCategory = document.getElementById("ex_parent_category");
                            const exChildCategory = document.getElementById("ex_child_category");

                            // Define a mapping of parent categories to child categories
                            const parentToChildCategories = {
                                "Office": ["Rent", "Blectricity Bill","Water Bill", "Kitchen","Internet Bill","Others", "Charity"],
                                "Salaries": ["Day Shift", "Night Shift"],
                                "Maintenance": ["none"],
                                "Day Food": ["none"],
                                "Marketing": ["none"]
                            };

                            // Function to update the second select box options based on the first select box selection
                            function updateChildCategory() {
                                const selectedParentCategory = exParentCategory.value;
                                const childCategories = parentToChildCategories[selectedParentCategory] || [];

                                // Clear existing options
                                exChildCategory.innerHTML = "";

                                // Add new options
                                childCategories.forEach(childCategory => {
                                    const option = document.createElement("option");
                                    option.value = childCategory;
                                    option.text = childCategory;
                                    exChildCategory.appendChild(option);
                                });
                            }

                            // Add an event listener to the first select box to update the second select box
                            exParentCategory.addEventListener("change", updateChildCategory);

                            // Initial update
                            updateChildCategory();

        </script>
    @endsection
    @section('scripts')
        <!-- bs custom file input plugin -->
        <script src="{{ URL::asset('build/libs/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/form-element.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
