@extends('layouts.master')
@section('title')
    {{$title}}
@endsection

@section('page-title')
{{$title}}
@endsection
@section('body')
    <style>
        .form-control {
            background-color: #fff;
            /* Set background color for the select box */
            color: #000;
            /* Set text color */
        }
    </style>

    <style>
        .service-container {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .task-container {
            margin-top: 10px;
        }
    </style>


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card bg-white p-3">

                    <form action="{{$route}}" method="post">
                        @csrf
                        <h4>{{$title}}</h4>
                        @if (session('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @elseif(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="row mt-3">
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


                        <h4 class="mt-3">File Content</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">

                                    <textarea name="file_description"  id="file_description" class="form-control p-3" style="width:100%;height:80px;">{!! ($file->description ?? old('file_description')) !!}</textarea>
                                    @error('file_description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <input type="submit" class="reblateBtn p-2" value="{{$text_btn}}">
                        </div>
                    </form>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->


        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
        </script>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
        </script>

        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
        <script>
            $('#file_description').summernote({
                placeholder: 'File Content',
                tabsize: 2,
                height: 100
            });
        </script>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    @endsection
    @section('scripts')
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @endsection
