@extends('layouts.master')
@section('title')
    Announcements
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
    Announcements
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="row d-flex justify-content-between mb-5">
                            <h4 class="card-title" style="width:50%">Announcements</h4>
                            <div style="width: 13%">



                                <button type="button" class="p-2 reblateBtn w-75" data-toggle="modal"
                                    data-target="#exampleModal">
                                    <span style="width: 15px; height: 15px; margin-right: 5px;"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                                        </svg> Add New
                                </button>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Create Announcement</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form -->
                                        <form id="announcementForm">
                                            <div class="form-group mt-2">
                                                <label for="title">Announcement Title</label>
                                                <input type="text" class="form-control" id="title"
                                                    placeholder="Enter title">
                                                    <span id="title_message" style="color:red;margin:12px 0px;display:none;">Enter title</span>
                                            </div>
                                            <div class="form-group">
                                                <label for="recipient ">Recipient</label>
                                                <select class="form-control mt-2" id="recipient">
                                                    <option value="all">All</option>
                                                    <option value="employees">Employees</option>
                                                    <option value="managers">Managers</option>
                                                </select>
                                                <span id="res_message" style="color:red;margin:12px 0px;display:none;">Select Reciepient</span>
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea class="form-control mt-2" id="description" rows="3" placeholder="Enter description"></textarea>
                                                <span id="desc_message" style="color:red;margin:12px 0px;display:none;">Description</span>
                                            </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" id="submitButton" class="btn btn-primary">Add
                                                    Announcement</button>
                                            </div>
                                        </form>
                                </div>
                            </div>
                        </div>
                        {{-- <p class="card-title-desc">The Buttons extension for DataTables
                            provides a common set of options, API methods and styling to display
                            buttons on a page that will interact with a DataTable. The core library
                            provides the based framework upon which plug-ins can built.
                        </p> --}}

                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th> ID </th>
                                    <th> Title </th>
                                    <th> Date </th>
                                    <th> To </th>
                                    <th class="text-nowrap">Action</th>
                                </tr>
                            </thead>

                            <tbody id="table-body">

                            </tbody>



                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

  <!-- Bootstrap JS (optional, if you need JavaScript functionality) -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
    function submitAnnouncement() {
      // Handle submission of the announcement form here
      // For demonstration, this function just closes the modal
      $('#exampleModal').modal('hide');
    }
    $(document).ready(function() {
    // Event handler for the Add Announcement button
    $('#submitButton').on('click', function(event) {
        // Prevent the default form submission
        event.preventDefault();
        var title_message = document.getElementById('title_message');
        var res_message = document.getElementById('res_message');
        var desc_message = document.getElementById('desc_message');

        title_message.style.display = "none";
        res_message.style.display = "none";
        desc_message.style.display = "none";

        // Get the values from the form fields
        var title = $('#title').val();
        var recipient = $('#recipient').val();
        var description = $('#description').val();

        if(title == "") {
            title_message.style.display = "block";
        }
        if(res_message == "") {
            res_message.style.display = "block";
        }
        if(desc_message == "") {
            desc_message.style.display = "block";
        }
        // alert();

        // Log the values to the console (you can do any processing with this data here)
        console.log("Title: " + title);
        console.log("Recipient: " + recipient);
        console.log("Description: " + description);

        // Optionally, you can send this data to the server using AJAX
        // $.ajax({
        //     url: 'your-server-endpoint',
        //     method: 'POST',
        //     data: {
        //         title: title,
        //         recipient: recipient,
        //         description: description
        //     },
        //     success: function(response) {
        //         console.log(response);
        //     },
        //     error: function(xhr, status, error) {
        //         console.error(error);
        //     }
        // });
    });
});

  </script>
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
        <script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
