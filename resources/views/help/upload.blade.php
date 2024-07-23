@extends('layouts.master')
@section('title')
    {{$title}}
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('build/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ URL::asset('build/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
@endsection

@section('body')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

            .borderingLeftTable {
                border-top-left-radius: 10px !important;
            }
            .ck-editor__editable_inline {
                height: 400px;  /* Adjust the height as needed */
            }
        </style>
        <div class="row">
            <div class="col-12">
                <div class="card mb-5" style="box-shadow: none">
                    <div class="card-body bg-white">
                        <h3>
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M19 12.998h-6v6h-2v-6H5v-2h6v-6h2v6h6z" />
                            </svg>
                            {{$title}}
                        </h3>

                        <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Display Success Message -->
                            @if (session('success'))
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <!-- Display Validation Errors -->
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="row mt-5 container">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="file_name">File Name <span class="text-danger">*</span></label>
                                        <input type="text" name="file_name" id="file_name"
                                            class="form-control @error('file_name') is-invalid @enderror"
                                            placeholder="File Name .... "
                                            value="{{ $file->file_name ?? old('file_name') }}">
                                        @error('file_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="file_type">File Type <span class="text-danger">*</span></label>
                                        <select name="file_type" id="file_type"
                                            class="form-control @error('file_type') is-invalid @enderror">
                                            <option value="">Select File Type</option>
                                            <option value="Company Policy"
                                                {{ ($file->file_type ?? old('file_type')) == 'Company Policy' ? 'selected' : '' }}>
                                                Company Policy
                                            </option>

                                            <!-- Add more options as needed -->
                                        </select>
                                        @error('file_type')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="file_shift">Shift <span class="text-danger">*</span></label>
                                        <select name="file_shift" id="file_shift"
                                            class="form-control @error('file_shift') is-invalid @enderror">
                                            <option value="">Select Shift</option>
                                            <option value="Both" {{ ($file->shift ?? old('file_shift')) == 'Both' ? 'selected' : '' }}>Both  </option>
                                            <option value="Morning" {{ ($file->shift ?? old('file_shift')) == 'Morning' ? 'selected' : '' }}>Morning  </option>
                                            <option value="Night" {{ ($file->shift ?? old('file_shift')) == 'Night' ? 'selected' : '' }}>Night  </option>

                                        </select>
                                        @error('file_shift')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row container mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="file_description">File Content: <span
                                                class="text-danger">*</span></label>
                                        <textarea name="file_description" id="file_description"
                                            class="form-control @error('file_description') is-invalid @enderror" cols="30" rows="10">{!! $file->description ?? old('file_description') !!}</textarea>
                                        @error('file_description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="container mt-3">
                                <button type="submit" class="reblateBtn p-2 mt-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M19 12.998h-6v6h-2v-6H5v-2h6v-6h2v6h6z" />
                                    </svg>
                                    {{$text_btn}}
                                </button>
                            </div>


                        </form>


                        <br><br>


                    </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
            <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
            <script>


                ClassicEditor
                    .create(document.querySelector('#file_description'), {
                        ckfinder: {
                            uploadUrl: "{{ route('ckeditor.upload',['_token'=>csrf_token()]) }}",
                        }
                    })
                    .catch(error => {
                        console.error('CKEditor Error:', error);
                    });



            </script>



            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        @endsection
        @section('scripts')
            <!-- Datatable init js -->

            <!-- App js -->
            <script src="{{ URL::asset('build/js/app.js') }}"></script>
            {{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> --}}
            <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        @endsection
