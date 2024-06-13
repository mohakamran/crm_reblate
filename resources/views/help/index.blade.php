@extends('layouts.master')
@section('title')
    Help Page
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
@section('page-title')
    Help Page
@endsection
@section('body')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <style>
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
        </style>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-5">

                            <button id="popupButton" class="reblateBtn p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M19 12.998h-6v6h-2v-6H5v-2h6v-6h2v6h6z" />
                                </svg>
                                Upload New File
                            </button>
                            <div class="popup" id="popup">
                                <div class="popup-content flex-column">
                                    <div class="d-flex mb-3 align-items-center justify-content-between">
                                        <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
                                        <span class="closeBtn"><svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                height="20" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                            </svg></span>
                                    </div>
                                    <div class="modal-body">
                                        <p class="text-success" style="display: none;" id="success_message_id">
                                            file uploaded successfully!</p>
                                        <p class="text-danger" style="display: none;" id="error_message_id">
                                        </p>
                                        <form action="" id="file_form">

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <span>File Name: </span>
                                                    <input id="file_name" class="form-control" type="text">
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-md-12">
                                                    <div class="file-upload">
                                                        <label for="file-input" class="file-upload-label">
                                                            <span id="file-label">Upload file here</span>
                                                            <input id="file-input" accept="application/pdf" type="file"
                                                                onchange="updateFileName(this)">

                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">File Type</label>
                                                        <select name="" class="form-control" id="file_type">
                                                            <option value="">Select File Type</option>
                                                            <option value="hr_privacy_police">HR Privacy Policy</option>
                                                            <option value="company_privacy_police">Company Policy</option>
                                                            <option value="emp_agreement">Employee Agreement</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <label for="">Description</label>
                                                    <textarea name="" id="file_description" class="form-control" style="width:100%;height:15px;"></textarea>
                                                </div>
                                            </div>

                                            <div class="modal-footer mt-3 d-flex gap-2">
                                                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                    >Close</button> --}}
                                                <button type="button" onclick="uploadFiles()"
                                                    class="reblateBtn px-4 py-2">Upload</button>
                                            </div>


                                        </form>

                                    </div>



                                </div>

                            </div>



                        </div>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>File Name</th>
                                    <th>File Type</th>
                                    <th>Description</th>
                                    <th>Upload Date</th>
                                    <th>Action</th>

                                </tr>
                            </thead>

                            <tbody id="table-body">
                                @foreach ($data as $dt)
                                    @if ($dt->fileInput!=null && file_exists($dt->fileInput))
                                        <td>{{$dt->file_name}}</td>
                                        <td>
                                            @if ($dt->file_type == "hr_privacy_police")
                                                Hr Privacy Policy
                                                @elseif($dt->file_type == "company_privacy_police")
                                                Company Policy
                                                @elseif($dt->file_type == "emp_agreement")
                                                Employee Agreement
                                                @else
                                                Not Defined
                                            @endif

                                        </td>
                                        <td>{{$dt->file_description}}</td>
                                        <td>{{ \Carbon\Carbon::parse($dt->date)->isoFormat('Do MMMM YYYY') }}</td>
                                        <td>
                                            <a href="{{$dt->fileInput}}" target="_blank">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 24 24"><g fill="none" stroke="#14213d" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" color="#14213d"><path d="M21.544 11.045c.304.426.456.64.456.955c0 .316-.152.529-.456.955C20.178 14.871 16.689 19 12 19c-4.69 0-8.178-4.13-9.544-6.045C2.152 12.529 2 12.315 2 12c0-.316.152-.529.456-.955C3.822 9.129 7.311 5 12 5c4.69 0 8.178 4.13 9.544 6.045"/><path d="M15 12a3 3 0 1 0-6 0a3 3 0 0 0 6 0"/></g></svg>
                                            </a>
                                            <a href="javascript:void()" onclick="confirmDelete({{ $dt->id }})"
                                                data-toggle="tooltip" data-original-title="Close">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1.6rem" height="1.6rem" viewBox="0 0 24 24"><path fill="#b60707" d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zm2-4h2V8H9zm4 0h2V8h-2z"/></svg>
                                            </a>
                                        </td>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
        <script>
            // delete file
            // Function to confirm deletion with SweetAlert
            function confirmDelete(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'file will be removed from database!',
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
                            url: '/delete-help-file/'+id,
                            method: 'GET', // Use the DELETE HTTP method
                            success: function() {
                                // Provide user feedback
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'file has been deleted.',
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
                                    text: 'An error occurred while deleting the file!',
                                    icon: 'error'
                                });
                            }
                        });

                    }
                });
            }
            function updateFileName(input) {


                var fileName = input.files[0].name;
                var error = document.getElementById('select-file');

                if (fileName == "") {

                    error.style.display = "block";
                    file.style.display = "block";
                    return;
                }
                document.getElementById('file-label').textContent = 'Selected file: ' + fileName;
            }

            function removeFile() {
                var fileInput = document.getElementById('file-input');
                fileInput.value = ''; // Clear the file input value
                document.getElementById('file-label').textContent = 'Upload file here'; // Reset file label text
                document.querySelector('.remove-file').style.display = 'none'; // Hide remove button
            }

            $(document).ready(function() {

                // Open modal
                $('a[data-toggle="modal"]').click(function() {
                    var target = $(this).attr('data-target');
                    $(target).addClass('show').attr('aria-hidden', 'false');
                    $('body').addClass('modal-open');
                });

                // Close modal
                $('.modal .close, .modal .btn-close').click(function() {
                    $(this).closest('.modal').removeClass('show').attr('aria-hidden', 'true');
                    $('body').removeClass('modal-open');
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                const popupButton = document.getElementById('popupButton');
                const popup = document.getElementById('popup');
                const closeBtn = document.querySelector('.closeBtn');

                popupButton.addEventListener('click', function() {
                    popup.style.display = 'block';
                });

                closeBtn.addEventListener('click', function() {
                    popup.style.display = 'none';
                });

                window.addEventListener('click', function(e) {
                    if (e.target === popup) {
                        popup.style.display = 'none';
                    }
                });
            });
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
                        'excel', 'print'
                    ],

                });
            });


            function uploadFiles() {
                var fileInput = document.getElementById('file-input').files[0]; // Get the selected file
                var fileType = document.getElementById('file_type').value;
                var fileDescription = document.getElementById('file_description').value;
                var file_name = document.getElementById('file_name').value;

                var errorMessage = document.getElementById('error_message_id');
                var successMessage = document.getElementById('success_message_id');

                if (!file_name) {
                    errorMessage.style.display = "block";
                    errorMessage.innerHTML = "Write file name!";
                    return;
                } else {
                    errorMessage.style.display = "none";
                }

                if (!fileInput) {
                    errorMessage.style.display = "block";
                    errorMessage.innerHTML = "Please select a file!";
                    return;
                } else {
                    errorMessage.style.display = "none";
                }

                // Check file size
                var maxSize = 5 * 1024 * 1024; // 5 MB in bytes
                if (fileInput.size > maxSize) {
                    errorMessage.innerHTML = "File size exceeds the limit of 5 MB.";
                    errorMessage.style.display = "block";
                    return;
                }

                // Check file type
                var allowedTypes = ['application/pdf'];
                if (!allowedTypes.includes(fileInput.type)) {
                    errorMessage.innerHTML = "Only PDF files are allowed!";
                    errorMessage.style.display = "block";
                    return;
                }

                if (!fileType) {
                    errorMessage.style.display = "block";
                    errorMessage.innerHTML = "Please select file type!";
                    return;
                } else {
                    errorMessage.style.display = "none";
                }

                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                var formData = new FormData();
                formData.append('_token', csrfToken);
                formData.append('fileInput', fileInput); // Append the file to the form data
                formData.append('file_type', fileType);
                formData.append('file_name', file_name);
                formData.append('file_description', fileDescription);

                errorMessage.style.display = "none";
                successMessage.style.display = "none";

                // AJAX call to send data to the Laravel controller
                $.ajax({
                    url: '/save-help-file', // The Laravel route
                    type: 'POST', // POST request
                    data: formData,
                    processData: false, // Prevent jQuery from processing the data
                    contentType: false, // Prevent jQuery from setting the content type
                    success: function(response) {
                        // Show success message
                        console.log(response);
                        var file_form = document.getElementById('file_form');
                        file_form.reset();
                        removeFile();
                        successMessage.style.display = "block";

                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 400) {
                            errorMessage.innerHTML = "Something went wrong!";
                            errorMessage.style.display = "block";
                        }
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Add CSRF token to request headers
                    }
                });

                return false; // Prevent form submission if within a form
            }
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
