@extends('layouts.master')
@section('title')
Projects
@endsection
@section('page-title')
Projects
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
            <style>
                @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

                .borderingLeftTable {
                    border-top-left-radius: 10px !important;
                }

                .borderingRightTable {
                    border-top-right-radius: 10px !important;
                }

                .table-lines {
                    font-family: 'Poppins';
                    color: #000;
                    font-weight: 700;
                }

                /* Adjust layout of DataTable components */
                .dataTables_length,
                .dataTables_filter,
                .dataTables_buttons {
                    display: inline-block;
                    margin-right: 10px;
                    /* Adjust margin as needed */
                }

                .dataTables_filter {
                    float: right;
                    /* Align search bar to the right */
                }

                .modal-backdrop {

                    position: fixed;
                    top: 0;
                    left: 0;
                    z-index: -1;
                    width: 100vw;
                    height: 100vh;
                    background-color: var(--bs-backdrop-bg);
                }

                .popup {
                    display: none;
                    position: fixed;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    background-color: rgba(0, 0, 0, 0.5);
                    width: 100%;
                    height: 100%;
                    z-index: 1000;
                }

                .popup-content {
                    /* overflow-y: scroll;
                                                                scroll-behavior: smooth scroll; */
                    display: flex;
                    max-width: 700px;
                    margin: auto auto;
                    position: relative;
                    top: 100px;
                    justify-content: center;
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 5px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);

                }

                .closeBtn {
                    position: absolute;
                    top: 25px;
                    right: 15px;
                    cursor: pointer;
                }

                .upload-btn-wrapper {
                    position: relative;
                    overflow: hidden;
                    display: inline-block;
                }

                .upload-btn-wrapper input[type=file] {
                    font-size: 100px;
                    position: absolute;
                    left: 0;
                    top: 0;
                    opacity: 0;
                }

                #file_modal:hover {
                    cursor: pointer;
                }

                .file-upload {
                    display: inline-block;
                    position: relative;
                    overflow: hidden;
                }

                .file-upload-label {
                    display: inline-block;
                    padding: 20px;
                    border: 2px dashed #ccc;
                    border-radius: 5px;
                    cursor: pointer;
                    text-align: center;
                    font-size: 16px;
                }

                .file-upload-label span {
                    display: block;
                }

                #file-input {
                    position: absolute;
                    left: 0;
                    top: 0;
                    width: 100%;
                    height: 100%;
                    opacity: 0;
                    cursor: pointer;
                }

                .remove-file {
                    position: absolute;
                    top: 5px;
                    right: 5px;
                    cursor: pointer;
                    font-size: 14px;
                    color: #f00;
                    display: none;
                }

                .modal-fullscreen {
                    width: 100vw;
                    max-width: 100%;
                    margin: 0;
                }

                .modal-dialog-scrollable {
                    display: flex;
                    max-height: calc(100vh - 60px);
                    /* Adjust as needed based on your modal content */
                    margin-top: 30px;
                    /* Adjust top margin as needed */
                }

                .embed-responsive {
                    position: relative;
                    display: block;
                    width: 100%;
                    padding-top: 100%;
                    /* This keeps the aspect ratio (height:width) */
                    overflow: hidden;
                }

                .embed-responsive iframe {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    border: none;
                }

                .text-link {

        background: #14213d;
        padding: 10px;
        margin: 3px;
        color: #ddd;
        border-radius: 5px;
        font-size: 15px;

            }
        </style>
        <div class="row">
            <div class="col-12">
                <div class="card" style="box-shadow: none">
                    <div class="card-body bg-white">
                        <div class="d-flex justify-content-end mb-5">
                            <a href="{{ route('project-add') }}" class="reblateBtn p-2 mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M19 12.998h-6v6h-2v-6H5v-2h6v-6h2v6h6z" />
                                </svg> Create New project
                            </a>
                        </div>
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <table id="datatable-buttons" class="table dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr style="background-color: #14213d">
                                    <th class="borderingLeftTable font-size-20" style="color: white">ID</th>
                                    <th class="font-size-20" style="color: white">Name</th>
                                    <th class="font-size-20" style="color: white">Status</th>
                                    <th class="font-size-20" style="color: white">Client Name</th>
                                    <th class="font-size-20" style="color: white">Priority</th>
                                    <th class="borderingRightTable font-size-20" style="color: white">Action</th>
                                </tr>
                            </thead>
                            @php
                                $id = 1;
                            @endphp

                            <tbody id="table-body">
                                @foreach($project as $data)
                                  <tr>
                                    <td style="color: #000;">{{$id++}}</td>
                                    <td style="color: #000;">{{ $data->name }}</td>
                                    <td style="color: #000;">{{ $data->status }}</td>
                                    <td style="color: #000;">{{ $data->client }}</td>
                                    <td style="color: #000;">{{ $data->priority }}</td>
                                    <td>
                                        <a href="{{ route('project.edit',$data->id) }}" class="text-link">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                viewBox="0 0 24 24">
                                                <path fill="#fff"
                                                    d="m14.06 9.02l.92.92L5.92 19H5v-.92zM17.66 3c-.25 0-.51.1-.7.29l-1.83 1.83l3.75 3.75l1.83-1.83a.996.996 0 0 0 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29m-3.6 3.19L3 17.25V21h3.75L17.81 9.94z">
                                                </path>
                                            </svg>
                                        </a>
                                        <a href="/view-project/{{$data->id}}" class="text-link" >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><g fill="none" stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" color="white"><path d="M21.544 11.045c.304.426.456.64.456.955c0 .316-.152.529-.456.955C20.178 14.871 16.689 19 12 19c-4.69 0-8.178-4.13-9.544-6.045C2.152 12.529 2 12.315 2 12c0-.316.152-.529.456-.955C3.822 9.129 7.311 5 12 5c4.69 0 8.178 4.13 9.544 6.045"/><path d="M15 12a3 3 0 1 0-6 0a3 3 0 0 0 6 0"/></g></svg>
                                        </a>
                                        <a href="#" onclick="deleteproject('{{$data->id}}')" class="text-link">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="white" d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zm2-4h2V8H9zm4 0h2V8h-2z"/></svg>
                                        </a>

                                    </td>
                                  </tr>
                                  @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

        <script>
            function deleteproject(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You Want To Delete The Project',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                    confirmButtonColor: '#FF5733', // Red color for "Yes"
                    cancelButtonColor: '#4CAF50', // Green color for "No"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Send an AJAX request to delete the team member
                        $.ajax({
                            url: '/del-project/' + id,
                            method: 'DELETE', // Use the DELETE HTTP method
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                            },
                            success: function() {
                                // Provide user feedback
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'deleted!',
                                    icon: 'success'
                                }).then(() => {
                                    location.reload(); // Refresh the page
                                });
                            },
                            error: function(xhr, status, error) {
                                // Handle errors, you can display an error message to the user
                                console.error('Error:', error);
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'An error occurred while deleting quotation!',
                                    icon: 'error'
                                });
                            }
                        });
                    }
                });
            }
        </script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @endsection
    @section('scripts')
        <script src="{{ URL::asset('build/libs/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
        <script src="{{ URL::asset('build/js/pages/form-element.init.js') }}"></script>
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
