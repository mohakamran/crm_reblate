@extends('layouts.master')
@section('title')
    File Uploads
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
        </style>
        <div class="row">
            <div class="col-12">
                <div class="card" style="box-shadow: none">
                    <div class="card-body bg-white">
                        <div class="d-flex justify-content-end mb-5">


                            <a href="/upload-new-file" class="reblateBtn p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M19 12.998h-6v6h-2v-6H5v-2h6v-6h2v6h6z" />
                                </svg> Add New File
                            </a>
                            {{-- <div class="popup" id="popup">
                                <div class="popup-content flex-column">
                                    <div class="d-flex mb-3 align-items-center justify-content-between">
                                        <h5 class="modal-title" id="exampleModalLabel"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M19 12.998h-6v6h-2v-6H5v-2h6v-6h2v6h6z" />
                                            </svg> Upload A New File</h5>
                                        <span class="closeBtn"><svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                height="20" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                            </svg></span>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" id="form-reset-upload">
                                            <p class="text-success" style="display: none;" id="success_message_id">
                                                File uploaded successfully!</p>
                                            <p class="text-danger" style="display: none;" id="error_message_file"></p>
                                            <p style="color:red;display:none;" id="select-file"> </p>


                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">File Name <span
                                                                    style="color:red">*</span></label>

                                                            <input type="text" id="file_name" class="form-control" />

                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Shift <span style="color:red">*</span>
                                                            </label>
                                                            <select name="" id="file_shift" class="form-control">
                                                                <option value="">Select Shift</option>
                                                                <option value="Morning">Morning</option>
                                                                <option value="Night">Night</option>
                                                                <option value="Both">Both</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-3">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">File Type <span style="color:red">*</span>
                                                            </label>
                                                            <select name="" id="file_policy" class="form-control">
                                                                <option value="">Select File Type</option>

                                                                <option value="Company Policy">Company Policy</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="file-upload">
                                                            <label for="file-input" class="file-upload-label">
                                                                <span id="file-label">Upload file here</span>
                                                                <input id="file-input" accept="application/pdf" type="file"
                                                                    onchange="updateFileName(this)">
                                                                <span class="remove-file" id="remove"
                                                                    onclick="removeFile()">x</span>
                                                            </label>
                                                        </div>

                                                        <script>
                                                            function updateFileName(input) {
                                                                var file = document.getElementById('remove');

                                                                var fileName = input.files[0].name;
                                                                var error = document.getElementById('select-file');

                                                                if (fileName == "") {

                                                                    error.style.display = "block";
                                                                    file.style.display = "block";
                                                                    return;
                                                                } else {
                                                                    document.querySelector('.remove-file').style.display = fileName !== '' ? 'inline' :
                                                                        'none'; // Show or hide remove button based on file selection
                                                                    error.style.display = "none";
                                                                    file.style.display = "none";
                                                                }
                                                                document.getElementById('file-label').textContent = 'Selected file: ' + fileName;
                                                            }

                                                            function removeFile() {
                                                                var fileInput = document.getElementById('file-input');
                                                                fileInput.value = ''; // Clear the file input value
                                                                document.getElementById('file-label').textContent = 'Upload file here'; // Reset file label text
                                                                document.querySelector('.remove-file').style.display = 'none'; // Hide remove button
                                                            }
                                                        </script>


                                                    </div>
                                                </div>

                                                <div class="row mt-2">
                                                    <div class="form-group">
                                                        <label for="">Description</label>
                                                        <textarea id="description" name="" class="form-control" style="width:100%;height:50px;" id=""
                                                            cols="30" rows="10"></textarea>
                                                    </div>
                                                </div>



                                    </div>
                                    <div class="modal-footer mt-3 d-flex gap-2">
                                        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                >Close</button>
                                        <button type="button" onclick="saveFile(event)"
                                            class="reblateBtn px-4 py-2">Upload
                                            File</button>
                                    </div>
                                    </form>
                                </div>

                            </div> --}}



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
                                    <th class="font-size-20" style="color: white">File Name</th>
                                    <th class="font-size-20" style="color: white">Type</th>
                                    <th class="font-size-20" style="color: white">Uploaded Date</th>

                                    <th class="borderingRightTable font-size-20" style="color: white">Action</th>


                                </tr>
                            </thead>

                            @php
                                $id = 1;
                            @endphp

                            <tbody id="table-body">
                                @foreach ($files as $file)
                                    <tr>
                                        <td>{{ $id++ }}</td>
                                        <td>{{ $file->file_name }}</td>
                                        <td>{{ $file->file_type }}</td>
                                        <td>{{ $file->created_at }}</td>
                                        <td>
                                            <a href="/update-file/{{ $file->file_id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="m14.06 9.02l.92.92L5.92 19H5v-.92zM17.66 3c-.25 0-.51.1-.7.29l-1.83 1.83l3.75 3.75l1.83-1.83a.996.996 0 0 0 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29m-3.6 3.19L3 17.25V21h3.75L17.81 9.94z">
                                                    </path>
                                                </svg>
                                            </a>

                                            <a href="#" onclick="delUploadEntry('{{ $file->file_id }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                    viewBox="0 0 24 24">
                                                    <path fill="#d20f0f"
                                                        d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zm2-4h2V8H9zm4 0h2V8h-2z">
                                                    </path>
                                                </svg>
                                            </a>

                                            <a href="/page-view/{{$file->file_id}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" color="currentColor"><path d="M21.544 11.045c.304.426.456.64.456.955c0 .316-.152.529-.456.955C20.178 14.871 16.689 19 12 19c-4.69 0-8.178-4.13-9.544-6.045C2.152 12.529 2 12.315 2 12c0-.316.152-.529.456-.955C3.822 9.129 7.311 5 12 5c4.69 0 8.178 4.13 9.544 6.045"/><path d="M15 12a3 3 0 1 0-6 0a3 3 0 0 0 6 0"/></g></svg>
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
            function delUploadEntry(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'file will be deleted!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                    confirmButtonColor: '#FF5733', // Red color for "Yes"
                    cancelButtonColor: '#4CAF50', // Green color for "No"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Send an AJAX request to delete the task
                        $.ajax({
                            url: '/del-file/' + id,
                            method: 'GET', // Use the DELETE HTTP method
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
                                    text: 'An error occurred while deleting task!',
                                    icon: 'error'
                                });
                            }
                        });

                    }
                });
            }


            $(document).ready(function() {
                $('#datatable-buttons').DataTable({
                    dom: "<'container-fluid'" +
                        "<'row'" +
                        "<'col-md-8'lB>" +
                        "<'col-md-4 text-right'f>" +
                        ">" +
                        "<'row dt-table'" +
                        "<'col-md-12'tr>" +
                        ">" +
                        "<'row'" +
                        "<'col-md-7'i>" +
                        "<'col-md-5 text-right'p>" +
                        ">" +
                        ">",
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    buttons: [
                        '', ''
                    ],

                });
            });
        </script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @endsection
    @section('scripts')
        <!-- Required datatable js -->
        <script src="{{ URL::asset('build/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <!-- Buttons examples -->
        <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/jszip/jszip.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/pdfmake/build/pdfmake.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/pdfmake/build/vfs_fonts.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

        <script src="{{ URL::asset('build/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>

        <!-- Responsive examples -->
        <script src="{{ URL::asset('build/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

        <!-- Datatable init js -->

        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>

        {{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> --}}
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    @endsection
