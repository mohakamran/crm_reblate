@extends('layouts.master')
@section('title')
Profile
@endsection
@section('page-title')
    Profile
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')

    @endsection
    @section('scripts')
        <!-- bs custom file input plugin -->
        <script src="{{ URL::asset('build/libs/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/form-element.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection

