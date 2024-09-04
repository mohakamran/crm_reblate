@extends('layouts.master')
@section('title')
Projects
@endsection

@section('page-title')
Projects
@endsection
@section('body')


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card bg-white p-3">
                    <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h4 style="color: black;">Add New Project</h4>
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
                                        <label for="file_name" style="color: black;">Project Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="file_name"
                                            class="form-control"
                                            >
                                    </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="file_shift" style="color: black;">Start Data <span class="text-danger">*</span></label>
                                    <input type="date" name="start_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="file_shift" style="color: black;">End Data <span class="text-danger">*</span></label>
                                    <input type="date" name="end_date" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                        <label for="status" style="color: black;">Project Status: <span class="text-danger">*</span></label>
                                    <select name="status" id="file_shift"
                                        class="form-control @error('file_shift') is-invalid @enderror">
                                        <option value="">Select Status</option>
                                        <option value="Not Started">Not Started</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Completed">Completed</option>
                                        <option value="On Hold">On Hold</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" style="color: black;">
                                    <label for="file_shift">Assigned Team Members <span class="text-danger">*</span></label>
                                    <select name="assigned_team_members" id="file_shift"
                                        class="form-control">
                                        @foreach($employee as $employees)
                                            <option value="{{ $employees->id }}">{{ $employees->Emp_Full_Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" style="color: black;">
                                    <label for="file_shift">Budget <span class="text-danger">*</span></label>
                                    <input type="number" id="budget" name="budget" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="file_name" style="color: black;">Client/Stakeholder <span class="text-danger">*</span></label>
                                        <select name="client" id="file_shift"
                                        class="form-control">
                                        @foreach($client as $data)
                                            <option value="{{ $data->client_name }}">{{ $data->client_name }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="file_shift" style="color: black;">Priority <span class="text-danger">*</span></label>
                                    <select id="file_shift" name="priority" class="form-control">
                                        <option value="Low">Low</option>
                                        <option value="Medium">Medium</option>
                                        <option value="High">High</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="file_shift" style="color: black;">Attachments/Files <span class="text-danger">*</span></label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                            </div>
                        </div>
                        <h4 class="mt-3" style="color: black;">Description</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea name="description"  id="description" class="form-control p-3" style="width:100%;height:80px;">{!! ($find->description ?? old('file_description')) !!}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <input type="submit" class="reblateBtn p-2" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div> 

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
            $('#description').summernote({
                placeholder: 'Project Description',
                color:'black',
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
