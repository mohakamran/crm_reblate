@extends('layouts.master-without-nav')
@section('title')
    404 Error
@endsection
@section('content')
    <div class="auth-error d-flex align-items-center min-vh-100">
        <div class="bg-overlay bg-light"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-8">
                    <div>
                        <div class="text-center mb-4">
                            <div class="mt-5">
                                <h1 class="error-title mt-5"><span>404!</span></h1>
                                <h4 class="mt-2 text-uppercase mt-4">Sorry, You are searching for Not Found!</h4>

                            </div>

                            <div class="mt-5 text-center">
                                {{-- <a class="btn btn-primary waves-effect waves-light" href="/">Back to Dashboard</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
