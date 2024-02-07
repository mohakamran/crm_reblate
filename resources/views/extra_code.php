<!-- login page code  -->
<div>
    <div class="text-center mt-1">
        <h4 class="font-size-18">Welcome Back !</h4>
        <p class="text-muted">Sign in to continue to Reblate Solutions CRM
        </p>
    </div>

    <form method="post" action="{{ route('auth.user') }}" class="auth-input">
        @csrf

        @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <a type="button" class="close" data-dismiss="alert" aria-label="Close" style="float: right;">
                <span aria-hidden="true">&times;</span>
            </a>
        </div>
        @endif
        <div class="mb-2">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" class="form-control @error('user_email') is-invalid @enderror"
                name="user_email" value="{{ old('user_email') }}" autocomplete="email" autofocus>
            @error('user_email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label" for="password-input">Password</label>
            <input type="password" class="form-control @error('user_password') is-invalid @enderror"
                placeholder="Enter password" id="password" name="user_password" autocomplete="current-password">
            @error('user_password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="mb-3">

            <input type="checkbox" onclick="togglePasswordVisibility()">
            <label for="showPassword">Show Password</label>

        </div>

        <div class="form-check d-flex justify-content-between">
            <div>
                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                    {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">Remember
                    me</label>
            </div>
            {{-- <a href="{{ route('password.update') }}" class="text-end">Forget Password?</a> --}}
        </div>

        <div class="mt-4">
            <button class="btn btn-primary w-100" style="background:#14213d;" type="submit">Sign
                In</button>
        </div>

        {{-- <div class="mt-4 pt-2 text-center">
                                                            <div class="signin-other-title">
                                                                <h5 class="font-size-14 mb-4 title">Sign In with</h5>
                                                            </div>
                                                            <div class="pt-2 hstack gap-2 justify-content-center">
                                                                <button type="button" class="btn btn-primary btn-sm"><i
                                                                        class="ri-facebook-fill font-size-16"></i></button>
                                                                <button type="button" class="btn btn-danger btn-sm"><i
                                                                        class="ri-google-fill font-size-16"></i></button>
                                                                <button type="button" class="btn btn-dark btn-sm"><i
                                                                        class="ri-github-fill font-size-16"></i></button>
                                                                <button type="button" class="btn btn-info btn-sm"><i
                                                                        class="ri-twitter-fill font-size-16"></i></button>
                                                            </div>
                                                        </div> --}}
    </form>
</div>
