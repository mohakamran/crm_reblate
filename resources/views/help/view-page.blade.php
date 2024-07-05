@extends('layouts.master')
@section('title')
    Page
@endsection
@section('page-title')
Page
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
    <style>
        body {
            font-family: 'Raleway', sans-serif;
            font-family: 'Roboto', sans-serif;
        }

        .container {
            margin-left: auto;
            margin-right: auto;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .container .contact {
            position: relative;
            z-index: 5;
        }

        .container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            /* background-image: url('{{ url('public/reblate.png') }}'); */
            background-position: center;
            background-size: 950px;
            background-repeat: no-repeat;
            height: 100%;
            width: 100%;
            opacity: 0.1;
            z-index: -1;
        }

        .logo {
            width: 300px;
            object-fit: contain;
        }
        table tr,td,th {
            border:1px solid #eee;
            border-collapse: collapse;
        }

        table {
            width: 100%;
            /* border-collapse: collapse; */
            /* border: 2px solid black; */
            margin-top: 30px;
            font-family: 'Roboto', sans-serif;
        }

        table td {
            line-height: 25px;
            padding:6px;
            font-size: 15px;
        }

        table th {
            background-color: #14213d3b;
            color: #000;
            text-align: left;
            font-size: 17px;
            padding:5px 5px;
        }

        .heading {
            background-color: #14213d;
            color: #ffffff;
            text-align: center;
            font-size: 40px;
            font-weight: 600;
            font-family: sans-serif;
        }

        .netSalery {
            padding: 20px;
            background-color: #14213d;
            color: white;
            font-size: 18px;
        }

        .names {
            padding: 15px;
            font-size: 20px;
        }

        .role {
            background-color: orange;
        }

        .desc {
            padding: 10px;
            text-align: center;
            color: gray;
        }

        .contact {
            padding: 20px;
            font-family: sans-serif;
        }

        .contact h1 {
            font-size: 20px;
        }

        a {
            text-decoration: none;
            font-size: 18px;
        }



        p {
            font-size: 18px;
        }

        .contact_section {
            margin: 10px;
            line-height: 0.9;
            text-align: center;
        }
        .contact_section h3{
            font-size: 18px;
            color: #000;

        }

        .contact_section p {
            font-size: 13px;
        }
    </style>
    <div class="row justify-content-center">
        <div class="col-xl-7">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        {{-- {{$file_path}} --}}
                        <embed src="{{url($file_path)}}" type="application/pdf" width="100%" height="600px" />
                    </div>
                </div>
            </div>
        </div>
    </div>



    @endsection
    @section('scripts')
        <!-- bs custom file input plugin -->
        <script src="{{ URL::asset('build/libs/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/form-element.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
