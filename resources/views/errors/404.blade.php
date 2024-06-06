@extends('layouts.master-without-nav')
@section('title')
    404 Error
@endsection
<style>
    .card-box {
    font-size: 18px;
    font-weight: 700;
    background-color: #14213d;
    padding: 5px 50px;
    color: #fca311;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: 0.3s;
    flex-wrap: wrap;
    border-radius: 50px;
    border: 1px solid rgba(255, 255, 255, 0.5);
}
</style>
@section('content')
    <div class="auth-error d-flex align-items-center min-vh-100">
        <div class="bg-overlay bg-light"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-8">
                    <div>

                        <div class="text-center mb-4">
                            <div class="mt-5">
                                <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>

    <dotlottie-player src="https://lottie.host/c6812568-1bd4-4214-851c-7451b2e9c03a/ReCK2FKyyH.json" background="transparent" speed="1" style="width: 300px; height: 300px;margin:0 auto;display:block;" loop autoplay></dotlottie-player>
                                <h4 class="mt-2 text-uppercase mt-4">Sorry, page not found</h4>

                            </div>

                            <div class="mt-5 text-center">
                                <a class="btn btn-primary waves-effect waves-light" href="/">Back to Dashboard</a>
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
