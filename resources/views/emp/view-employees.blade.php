@extends('layouts.master')
@section('title')
    {{ $emp }}
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
    {{ $emp }}
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">{{ $emp }}</h4>
                        {{-- <p class="card-title-desc">The Buttons extension for DataTables
                            provides a common set of options, API methods and styling to display
                            buttons on a page that will interact with a DataTable. The core library
                            provides the based framework upon which plug-ins can built.
                        </p> --}}



                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>SR</th>
                                    <th>EMP ID</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Shift</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody id="table-body">
                                @php
                                    $count = 1;
                                @endphp
                                @foreach ($rec as $emp)
                                    <tr>

                                        <td>{{ $count }}</td>
                                        {{-- <td>{{ ( $emp->Emp_Code < 10) ? '00'.$emp->Emp_Code : $emp->Emp_Code }}sols</td> --}}
                                        <td>{{ $emp->Emp_Code }} </td>
                                        <td><a href="view_emp_details/{{ $emp->Emp_Code }}">{{ $emp->Emp_Full_Name }}</a>
                                        </td>
                                        <td>{{ $emp->Emp_Designation }}</td>

                                        <td>
                                            <a href="javascript:void()" onclick="changeShift({{ $emp->id }})">

                                                @if ($emp->Emp_Shift_Time == 'Morning')
                                                    <span class="label label-primary"> {{ $emp->Emp_Shift_Time }}</span>
                                                @else
                                                    <span class="label label-info"> {{ $emp->Emp_Shift_Time }}</span>
                                                @endif
                                            </a>
                                        </td>

                                        <td class="text-nowrap">
                                            <div class="d-flex gap-3">
                                                @if (auth()->user()->user_type == 'employee' || auth()->user()->user_type == 'manager')
                                                    @if (Session::has('employees_access'))
                                                        @php
                                                            $employees_access = Session::get('employees_access');
                                                            // Convert to an array if it's a single value
                                                            if (!is_array($employees_access)) {
                                                                $employees_access = explode(',', $employees_access);
                                                                // Remove any empty elements resulting from the explode function
                                                                $employees_access = array_filter($employees_access);
                                                            }
                                                        @endphp
                                                        {{-- update --}}
                                                        @if (is_array($employees_access) && in_array('update', $employees_access) && in_array('delete', $employees_access))
                                                            <a href="/update-employee/{{ $emp->Emp_Code }}"
                                                                data-toggle="tooltip" class="btn btn-success btn-sm"
                                                                data-original-title="Edit">
                                                                <i class="mdi mdi-pencil"></i>
                                                            </a>
                                                            <a href="javascript:void()"
                                                                onclick="deleteEmployee('{{ $emp->Emp_Code }}')"
                                                                class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                                data-original-title="Close">
                                                                <i class="mdi mdi-delete"></i>
                                                            </a>
                                                            @elseif (is_array($employees_access) && in_array('update', $employees_access))
                                                            <a href="javascript:void()"
                                                                onclick="deleteEmployee('{{ $emp->Emp_Code }}')"
                                                                class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                                data-original-title="Close">
                                                                <i class="mdi mdi-delete"></i>
                                                            </a>
                                                            @elseif (is_array($employees_access) && in_array('delete', $employees_access))
                                                            <a href="javascript:void()"
                                                                onclick="deleteEmployee('{{ $emp->Emp_Code }}')"
                                                                class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                                data-original-title="Close">
                                                                <i class="mdi mdi-delete"></i>
                                                            </a>
                                                            @else
                                                            no action allowed
                                                        @endif

                                                    @endif
                                                @else
                                                    <a href="/update-employee/{{ $emp->Emp_Code }}" data-toggle="tooltip"
                                                        class="btn btn-success btn-sm" data-original-title="Edit">
                                                        <i class="mdi mdi-pencil"></i>
                                                        <a href="javascript:void()"
                                                            onclick="deleteEmployee('{{ $emp->Emp_Code }}')"
                                                            class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                            data-original-title="Close">
                                                            <i class="mdi mdi-delete"></i>
                                                        </a>
                                                @endif

                                            </div>
                                        </td>
                                        @php $count++;  @endphp
                                    </tr>
                                @endforeach
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
                    text: 'The Employee would be removed from the database!',
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
                            url: '/delete-employee/' + id,
                            method: 'GET', // Use the DELETE HTTP method
                            success: function() {
                                // Provide user feedback
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'The employee has been deleted.',
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
                                    text: 'An error occurred while deleting the employee!',
                                    icon: 'error'
                                });
                            }
                        });

                    }
                });
            }

            function changeShiftEmp(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Shift of employee will be changed!',
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
                            url: '/change-shift/' + id,
                            method: 'GET', // Use the DELETE HTTP method
                            success: function() {
                                // Provide user feedback
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Shift has been changed.',
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
                                    text: 'An error occurred while deleting the employee!',
                                    icon: 'error'
                                });
                            }
                        });

                    }
                });
            }

            function changeStatusEmp(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Status of employee will be changed!',
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
                            url: '/change-status/' + id,
                            method: 'GET', // Use the DELETE HTTP method
                            success: function() {
                                // Provide user feedback
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Status has been changed.',
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
                                    text: 'An error occurred while deleting the employee!',
                                    icon: 'error'
                                });
                            }
                        });

                    }
                });
            }

            function deleteEmployee(id) {
                confirmDelete(id);
            }

            function changeShift(id) {
                changeShiftEmp(id);
            }

            function changeStatus(id) {
                changeStatusEmp(id);
            }
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