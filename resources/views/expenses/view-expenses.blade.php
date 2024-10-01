@extends('layouts.master')
@section('title')
    {{$title}}
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
{{$title}}
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
                        <form action="{{ url('/view-expenses') }}" method="GET">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="ex_child_category">Select Child Category</label>
                                    <select name="ex_child_category" id="ex_child_category" class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach($allCategories as $category)
                                            <option value="{{ $category }}" 
                                                {{ request()->input('ex_child_category') == $category ? 'selected' : '' }}>
                                                {{ $category }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="ex_date">Select Date</label>
                                    <input type="month" name="ex_month" id="ex_month" class="form-control" value="{{ request()->input('ex_month') }}">
                                </div>
                                <div class="col-md-4">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn btn-primary btn-block">Filter</button>
                                    <a href="{{ url('/print-expenses') }}?ex_child_category={{ request()->input('ex_child_category') }}&ex_month={{ request()->input('ex_month') }}" target="_blank" class="btn btn-secondary">
                                        Print as PDF
                                    </a>
                                </div>
                            </div>
                        </form>

                            <h4 class="card-title" style="width:50%">{{$title}}</h4>
                           
                            <div style="width: 13%">

                                 @if (Session::has('expenses_access'))
                                        @php
                                            $expenses_access = Session::get('expenses_access');
                                            // Convert to an array if it's a single value
                                            if (!is_array($expenses_access)) {
                                                $expenses_access = explode(',', $expenses_access);
                                                // Remove any empty elements resulting from the explode function
                                                $expenses_access = array_filter($expenses_access);
                                            }
                                        @endphp
                                @endif

                                @if(auth()->user()->user_type == 'employee' || auth()->user()->user_type == 'manager')

                                   @if (is_array($expenses_access) && in_array('all', $expenses_access) || in_array('create', $expenses_access) )
                                       <a href="/add-new-expense" class="reblateBtn w-75" style="padding:10px;text-align:center"><span
                                    style="width: 15px; height: 15px; margin-right: 5px;"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-plus-lg" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                                    </svg></span> Add New</a>
                                   @endif


                                @endif

                                @if(auth()->user()->user_type == 'admin')
                                    <a href="/add-new-expense" class="reblateBtn w-75" style="padding:10px;text-align:center"><span
                                        style="width: 15px; height: 15px; margin-right: 5px;"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-plus-lg" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                                        </svg></span> Add New</a>
                                @endif
                            </div>
                        </div>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Expense ID</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Parent Category</th>
                                    <th>Sub Category</th>
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
                                        <td>{{ $emp->expense_amount }} </td>
                                        <td>{{ $emp->expense_date }} </a></td>

                                        <td>{{ $emp->expense_parent_category }} </a></td>
                                        <td>{{ $emp->expense_child_category }}</td>
                                        <td class="text-nowrap">
                                            <div class="d-flex gap-3">
                                                @if (auth()->user()->user_type == 'employee' || auth()->user()->user_type == 'manager')
                                                    @if (Session::has('expenses_access'))
                                                        @php
                                                            $expenses_access = Session::get('expenses_access');
                                                            // Convert to an array if it's a single value
                                                            if (!is_array($expenses_access)) {
                                                                $expenses_access = explode(',', $expenses_access);
                                                                // Remove any empty elements resulting from the explode function
                                                                $expenses_access = array_filter($expenses_access);
                                                            }
                                                        @endphp
                                                        @if (is_array($expenses_access) && in_array('all', $expenses_access) || in_array('update', $expenses_access) )
                                                            <a href="/update-expense/{{ $emp->id }}" data-toggle="tooltip" class="btn btn-success btn-sm"
                                                                data-original-title="Edit">
                                                                <i class="mdi mdi-pencil"></i>
                                                            </a>
                                                        @endif
                                                        @if (is_array($expenses_access) && in_array('all', $expenses_access) || in_array('delete', $expenses_access) )
                                                            <a href="javascript:void()" onclick="deleteExpense({{ $emp->id }})" class="btn btn-danger btn-sm"
                                                                data-toggle="tooltip" data-original-title="Close">
                                                                <i class="mdi mdi-delete"></i>
                                                            </a>
                                                        @endif


                                                    @endif
                                                @endif

                                                @if(auth()->user()->user_type == 'admin')
                                                <a href="/update-expense/{{ $emp->id }}" data-toggle="tooltip" class="btn btn-success btn-sm"
                                                    data-original-title="Edit">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                                <a href="javascript:void()" onclick="deleteExpense({{ $emp->id }})" class="btn btn-danger btn-sm"
                                                    data-toggle="tooltip" data-original-title="Close">
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
            </div>
        </div>

        <script>
            function confirmDelete(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'The Expense would be removed from the database!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                    confirmButtonColor: '#FF5733', 
                    cancelButtonColor: '#4CAF50',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/delete-expense/'+id,
                            method: 'GET', 
                            success: function() {
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'The Expense has been deleted.',
                                    icon: 'success'
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function(xhr, status, error) {
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
                        "<'col-md-8'l>" +
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
        {{-- <script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script> --}}
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
