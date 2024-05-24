@extends('layouts.master')
@section('title')
    Salaries By Month
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('build/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ URL::asset('build/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page-title')
Salaries By Month
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">



                        <div class="row">
                            <form action="/search-salary-by-month" method="post">
                                @csrf
                                <div class="row">

                                    <div class="col-md-3">
                                        <select name="shift_type" class="form-control" id="">
                                            <option value="all" {{ isset($shift_type) && $shift_type == "all" ? 'selected' : '' }}>All</option>
                                            <option value="Night" {{ isset($shift_type) && $shift_type == "Night" ? 'selected' : '' }}>Night</option>
                                            <option value="Morning" {{ isset($shift_type) && $shift_type == "Morning" ? 'selected' : '' }}>Morning</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="month" class="form-control" id="start" name="monthly_salaries" min="2018-03" value="{{ $currentYear }}-{{ $currentMonth }}" />
                                    </div>
                                    <div class="col-md-3">
                                        <button class="reblateBtn mt-1" style="padding: 7px 14px;"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path
                                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                        </svg></button>
                                    </div>
                               </div>
                          </form>
                        </div>

                        <div class="mb-3">
                            <span>Total : {{$sum_total_salaries}} PKR</span>
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
                                    <th>Emp ID</th>
                                    <th>Employee Name</th>
                                    <th>Net Salary</th>
                                    <th>Month Salary</th>
                                </tr>
                            </thead>

                            <tbody id="table-body">

                                @foreach ($salaries as $emp)
                                    <tr>


                                        {{-- <td>{{ ( $emp->Emp_Code < 10) ? '00'.$emp->Emp_Code : $emp->Emp_Code }}sols</td> --}}
                                        <td>
                                            <a href="/view_profile/{{$emp->emp_id}}">
                                                {{ $emp->emp_id }}
                                            </a> </td>
                                        <td>
                                            <a href="/view-salaries/{{$emp->emp_id}}">
                                                {{ $emp->emp_name }}
                                            </a>

                                        </td>


                                        <td>{{ number_format((float)$emp->amount, 2) }}</td>
                                        <td>{{ $emp->month_salary }}</td>


                                    </tr>
                                @endforeach

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>Total: {{$sum_total_salaries}}</td>
                                    <td></td>
                                </tr>
                            </tbody>



                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

        <script>
            // Function to confirm deletion with SweetAlert
            function confirmDelete(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'The Expense would be removed from the database!',
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
                            url: '/delete-expense/'+id,
                            method: 'GET', // Use the DELETE HTTP method
                            success: function() {
                                // Provide user feedback
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'The Expense has been deleted.',
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
                                    text: 'An error occurred while deleting the Expense!',
                                    icon: 'error'
                                });
                            }
                        });

                    }
                });
            }

            function deleteExpense(id) {
                confirmDelete(id);
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
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        buttons: [
            'excel', 'print'
        ],

    });
});

        </script>

        <style>
            /* Adjust layout of DataTable components */
.dataTables_length,
.dataTables_filter {
    display: inline-block;
    margin-right: 10px; /* Adjust margin as needed */
}

.dataTables_filter {
    float: right; /* Align search bar to the right */
}

.dataTables_buttons {
    float: right; /* Align buttons to the right */
}
        </style>
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
    @endsection
