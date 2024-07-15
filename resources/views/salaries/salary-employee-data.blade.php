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

            .EmpNameStyle {
                font-size: 30px;
                color: #fff;
                font-weight: 600;
                font-family: 'Poppins';
            }
             {
                list-style-type: circle;
            }
            .formstyle{
            text-align: end;
            margin-top: 50px;
            }

            .EmpStyle {
                font-size: 18px;
                color: #fca311;
                font-family: 'Poppins';
                font-weight: 300
            }

            .badge {
                background-color: #179109;
                color: white;
                padding: 4px 6px;
                border-radius: 13px;
                margin-left: 20px;
            }
            .badgeTotalSalary{
                background-color: #fca311;
                color: white;
                padding: 0px 8px;
                border-radius: 28px;
                margin-left: -30px;
                margin-top: 19px;
            }
            .Greenbadge{
                background-color: #179109;
                color: white;
                padding: 4px 6px;
                border-radius: 13px;
                margin-left: 190px;
            }
            .badgeRed{
                background-color: red;
                color: white;
                padding: 4px 5px;
                border-radius: 13px;
                margin-left: 50px;
                font-size: 13px;
            }
            .badgeRedmetric{
                background-color: red;
                color: white;
                padding: 4px 5px;
                border-radius: 13px;
                margin-left: 50px;
                font-size: 13px;
            }


            .time-list .dash-stats-list {
                flex-flow: column wrap;
                flex-grow: 1;
                padding: 0 15px;
            }

            .time-list .dash-stats-list h4 {
                color: #1f1f1f;
                font-size: 21px;
                font-weight: 700;
                line-height: 1.5;
                margin-bottom: 0;
            }

            .time-list .dash-stats-list p {
                color: #777;
                font-size: 13px;
                font-weight: 600;
                line-height: 1.5;
                margin-bottom: 0;
                text-transform: uppercase;
            }

            ul li {
                list-style: none;
            }

            .timesheet-right {
                color: #8E8E8E;
                font-size: 13px;
                float: right;
                margin-top: 7px;

            }


            .punch-info .punch-hours {
                border: 3px solid #fca311;

                max-width: 250px;

                padding: 20px;
                margin: 0 auto;
                border-radius: 12px;
                position: relative;
                text-align: center;
            }



            .punch-hours span {
                font-weight: 500;
                transform: translate(-50%, -50%);
                font-size: 30px;
                color: #14213d;
            }

            .view-class-more {

                font-size: 16px;
                text-align: center;
                display: block;
                /* margin: 0px; */
                margin-top: 17px;

            }

            .timeliner {

                margin: 0 auto;
                letter-spacing: 0.2px;
                position: relative;
                padding-top: 20px;
                margin-left: 10px;
                padding-bottom: 0;

                list-style: none;
                text-align: left;

            }

            @media (max-width: 767px) {
                .timeliner {
                    max-width: 98%;
                    padding: 25px;
                }
            }

            .timeliner h1 {
                font-weight: 300;
                font-size: 1.4em;
            }

            .timeliner h2,
            .timeliner h3 {
                font-weight: 600;
                font-size: 1rem;
                margin-bottom: 10px;
            }

            .timeliner .event {

                position: relative;
            }

            @media (max-width: 767px) {
                .timeliner .event {
                    padding-top: 30px;
                }
            }

            .timeliner .event:last-of-type {
                padding-bottom: 0;
                margin-bottom: 0;
                border: none;
            }

            .timeliner .event:before,
            .timeliner .event:after {
                position: absolute;
                display: block;
                top: 0;
            }

            .timeliner .event:before {
                left: -207px;
                content: attr(data-date);
                text-align: right;
                font-weight: 100;
                font-size: 0.9em;
                min-width: 120px;
            }

            @media (max-width: 767px) {
                .timeliner .event:before {
                    left: 0px;
                    text-align: left;
                }
            }

            .timeliner .event:after {
                -webkit-box-shadow: 0 0 0 3px #fca311;
                box-shadow: 0 0 0 3px #fca311;
                left: -23.6px;
                background: #fff;
                border-radius: 50%;
                height: 6px;
                width: 6px;
                content: "";
                top: 10px;
            }

            @media (max-width: 767px) {
                .timeliner .event:after {
                    left: -31.8px;
                }
            }

            .rtl .timeliner {
                text-align: right;
                border-bottom-right-radius: 0;
                border-top-right-radius: 0;
                border-bottom-left-radius: 4px;
                border-top-left-radius: 4px;
                border-right: 3px solid #727cf5;
            }

            .rtl .timeliner .event::before {
                left: 0;
                right: -170px;
            }

            .rtl .timeliner .event::after {
                left: 0;
                right: -55.8px;
            }


            /* CSS for styling the chart container */
            #line_chart {
                width: 100%;
                height: 400px;
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

            .char-count {
                font-size: 0.8em;
                color: #666;
                text-align: right;
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
                text-align: center;
            }

            .closeBtn {
                position: absolute;
                top: 25px;
                right: 15px;
                cursor: pointer;
            }

            .active {
                color: #14213d;
                border-bottom: 1px solid #fca311;
            }

            .notification-hover:hover {
                background: #fca31130;
                transition: all 0.2s ease-in-out;
            }

            .to-do-form input,
            textarea {
                width: 100%;
                padding: 5px 10px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }

            .to-do-form textarea {
                height: 37px;
                resize: none;
            }


            button {
                padding: 5px 10px;
                background-color: #28a745;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
            }

            button:hover {
                background-color: #218838;
            }

            #todoList {
                display: flex;
                gap: 10px;
                flex-wrap: wrap;
                justify-content: center;
            }

            #todoList li {
                background-color: #14213d26;
                padding: 10px;
                border-radius: 10px;
            }

            #todoList li h3 {
                color: #14213d;
                font-size: 18px;
                font-family: 'Poppins'
            }

            #todoList li p {
                color: #14213d;
                font-size: 15px;
                font-family: 'Poppins';
                margin-bottom: 0;
            }
            .dateSet{
                text-align: end;
                /* margin-top: -31px; */
                /* margin-left: 13px; */
                margin: -34px -199px 0px 0px;
                color: white;
            }
        </style>
        <div class="row" sytle="color:black">
            <div class="col-12">
                <div class="card" style="box-shadow: none">
                    <div class="card-body bg-white">
                    <table id="datatable-buttons" class="table dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr style="background-color: #14213d">
                                    <th class="borderingLeftTable font-size-17" style="color: white">Employee Id</th>
                                    <th class="font-size-17" style="color: white">Salary Month</th>
                                    <th class="font-size-17" style="color: white">Amount</th>
                                    <th class="font-size-17" style="color: white">View</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                @if($salary !=null)
                                <tr>
                                        <td> {{ $salary->emp_id }}</td>
                                        <td>{{ $salary->month_salary }}</td>
                                        <td> {{ $salary->amount }}</td>
                                        <td> <a href="/preview-slip-employee-page/{{$salary->id}}"><svg xmlns="http://www.w3.org/2000/svg"width="25" height="25" viewBox="0 0 32 32"><path fill="#14213d" d="M30.94 15.66A16.69 16.69 0 0 0 16 5A16.69 16.69 0 0 0 1.06 15.66a1 1 0 0 0 0 .68A16.69 16.69 0 0 0 16 27a16.69 16.69 0 0 0 14.94-10.66a1 1 0 0 0 0-.68ZM16 25c-5.3 0-10.9-3.93-12.93-9C5.1 10.93 10.7 7 16 7s10.9 3.93 12.93 9C26.9 21.07 21.3 25 16 25Z"></path><path fill="#14213d" d="M16 10a6 6 0 1 0 6 6a6 6 0 0 0-6-6Zm0 10a4 4 0 1 1 4-4a4 4 0 0 1-4 4Z"></path></svg></a></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
     

        <!-- END ROW -->


        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/0.2.0/Chart.min.js" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        
        <script>
            const xValues = [50,60,70,80,90,100,110,120,130,140,150];
            const yValues = [7,8,8,9,9,9,10,11,14,14,15];

                    new Chart("myChart", {
                    type: "line",
                    data: {
                        labels: xValues,
                        datasets: [{
                        fill: false,
                        lineTension: 0,
                        backgroundColor: "rgba(0,0,255,1.0)",
                        borderColor: "rgba(0,0,255,0.1)",
                        data: yValues
                        }]
                    },
                    options: {
                        legend: {display: false},
                        scales: {
                        yAxes: [{ticks: {min: 6, max:16}}],
                        }
                    }
                    });
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
                        '', ''
                    ],

                });
            });

            $(function() {
                $('input[name="daterange"]').daterangepicker({
                        opens: 'right',
                        isInvalidDate: function(date) {
                            // Disable Saturdays and Sundays
                            return (date.day() === 0 || date.day() === 6);
                        }
                    },
                    function(start, end, label) {
                        var startDate = start.format('YYYY-MM-DD');
                        var endDate = end.format('YYYY-MM-DD');
                    });
            });

            function delFile(id) {
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
                            url: '/delete-help-file/' + id,
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



            function setOfficeHolidays() {



                var holiday_dates = document.getElementById('holiday_dates').value;
                var holiday_type = document.getElementById('holiday_type').value;

                var holiday_description = document.getElementById('holiday_description').value;


                var holiday_date_message = document.getElementById('holiday_date_message');
                var holiday_type_message = document.getElementById('holiday_type_message');
                // var holiday_desc_message = document.getElementById('holiday_desc_message');

                var datesArray = holiday_dates.split(' - ');


                if (holiday_dates == "") {
                    holiday_date_message.style.display = "block";
                    holiday_date_message.innerHTML = "Please Select Date!";
                    return;
                } else {
                    holiday_date_message.style.display = "none";
                }

                if (holiday_type == "") {
                    holiday_type_message.style.display = "block";
                    holiday_type_message.innerHTML = "required!";
                    return;
                } else {
                    holiday_type_message.style.display = "none";
                }

                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                var startDate = datesArray[0];
                var endDate = datesArray[1];

                var formData = {
                    _token: csrfToken,
                    holiday_type: holiday_type,
                    holiday_description: holiday_description,
                    startDate: startDate,
                    endDate: endDate
                };

                // console.log(formData);



                var success_message_id = document.getElementById('success_message_id');
                var error_message_id = document.getElementById('error_message_id');

                error_message_id.style.display = "none";
                success_message_id.style.display = "none";

                // AJAX call to send data to the Laravel controller
                $.ajax({
                    url: '/create-holidays', // The Laravel route
                    type: 'POST', // POST request
                    data: formData,
                    success: function(response) {
                        // Show success message
                        // console.log('Response');

                        if (error_message_id.style.display == "block") {
                            error_message_id.style.display == "none";
                        }
                        success_message_id.style.display = "block";


                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 400) {
                            if (success_message_id.style.display == "block") {
                                success_message_id.style.display == "none";
                            }
                            error_message_id.style.display = "block";
                        }
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Add CSRF token to request headers
                    }
                });

                return false; // Prevent form submission if within a form
            }

            //update
            function updateOfficeHolidays(id) {
                var holiday_id = 'holiday_dates_' + id;
                var holiday_type_id = 'holiday_type_' + id;
                var holiday_des_id = 'holiday_description_' + id;
                var holiday_date_message_id = 'holiday_date_message_' + id;
                // console.log(holiday_date_message);
                var holiday_type_message_id = 'holiday_type_message_' + id;



                var holiday_dates = document.getElementById(holiday_id).value;
                var holiday_type = document.getElementById(holiday_type_id).value;

                var holiday_description = document.getElementById(holiday_des_id).value;


                var holiday_date_message = document.getElementById(holiday_date_message_id);
                var holiday_type_message = document.getElementById(holiday_type_message_id);

                // var holiday_desc_message = document.getElementById('holiday_desc_message');

                var datesArray = holiday_dates.split(' - ');

                if (holiday_type == "") {
                    holiday_type_message.style.display = "block";
                    holiday_type_message.innerHTML = "required!";
                    return;
                } else {
                    holiday_type_message.style.display = "none";
                }



                if (holiday_dates == "") {
                    holiday_date_message.style.display = "block";
                    holiday_date_message.innerHTML = "Please Select Date!";
                    return;
                } else {
                    holiday_date_message.style.display = "none";
                }



                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                var startDate = datesArray[0];
                var endDate = datesArray[1];

                var formData = {
                    id: id,
                    _token: csrfToken,
                    holiday_type: holiday_type,
                    holiday_description: holiday_description,
                    startDate: startDate,
                    endDate: endDate,
                    status: 'update'
                };




                var success_message_id_id = 'success_message_id_' + id;
                var error_message_id_id = 'error_message_id_' + id;
                var success_message_id = document.getElementById(success_message_id_id);
                var error_message_id = document.getElementById(error_message_id_id);

                error_message_id.style.display = "none";
                success_message_id.style.display = "none";

                // AJAX call to send data to the Laravel controller
                $.ajax({
                    url: '/update-holidays', // The Laravel route
                    type: 'POST', // POST request
                    data: formData,
                    success: function(response) {
                        // Show success message
                        // console.log('Response');

                        if (error_message_id.style.display == "block") {
                            error_message_id.style.display == "none";
                        }
                        success_message_id.style.display = "block";


                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 400) {
                            if (success_message_id.style.display == "block") {
                                success_message_id.style.display == "none";
                            }
                            error_message_id.style.display = "block";
                        }
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Add CSRF token to request headers
                    }
                });

                return false; // Prevent form submission if within a form
            }
            function saveFile(event) {
                event.preventDefault();

                var file_name = document.getElementById('file_name').value;
                var file_shift = document.getElementById('file_shift').value;
                var file_policy = document.getElementById('file_policy').value;
                var description = document.getElementById('description').value;
                var fileInput = document.getElementById('file-input');
                var error = document.getElementById('select-file');

                // Clear previous errors
                error.style.display = "none";

                // Validate file name
                if (file_name.trim() === "") {
                    error.innerHTML = "File name is required!";
                    error.style.display = "block";
                    return;
                }

                // Validate file shift
                if (file_shift.trim() === "") {
                    error.innerHTML = "Please select a shift!";
                    error.style.display = "block";
                    return;
                }

                // Validate file policy
                if (file_policy.trim() === "") {
                    error.innerHTML = "Please select a file type!";
                    error.style.display = "block";
                    return;
                }

                // Validate file input
                if (fileInput.files.length === 0) {
                    error.innerHTML = "Please select a file.";
                    error.style.display = "block";
                    return;
                }

                // Check file type
                var allowedTypes = ['application/pdf'];
                var fileType = fileInput.files[0].type;

                if (!allowedTypes.includes(fileType)) {
                    error.innerHTML = "Only PDF files are allowed.";
                    error.style.display = "block";
                    return;
                }

                // Check file size
                var maxSize = 2 * 1024 * 1024; // 2 MB in bytes
                var fileSize = fileInput.files[0].size;

                if (fileSize > maxSize) {
                    error.innerHTML = "File size exceeds the limit of 2 MB.";
                    error.style.display = "block";
                    return;
                }

                var formData = new FormData();
                 formData.append('fileInput', fileInput.files[0]); // Append file input to formData
                formData.append('file_name', file_name);
                formData.append('file_shift', file_shift);
                formData.append('file_policy', file_policy);
                formData.append('description', description);

                console.log(fileInput.files[0]);
                // CSRF token (replace with your actual token handling logic)
                var csrfToken = "{{ csrf_token() }}";

                // AJAX request using fetch API
                fetch('/save-help-file', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                        },
                        body: formData // Send formData containing file and other fields
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // console.log(data);
                        if (data.success) {
                            var form_reset_upload = document.getElementById('form-reset-upload');
                            form_reset_upload.reset();
                            var success_message = document.getElementById('success_message_id');
                            success_message.innerHTML = "File Uploaded Successfully!";
                            success_message.style.display = "block";
                            setTimeout(function() {
                                success_message.style.display = "none";

                                document.getElementById('file-label').textContent = "Upload file here";
                            }, 5000); // 5 seconds

                        } else {
                            var error_message = document.getElementById('error_message_file');

                            error_message.innerHTML = "Something went wrong!";
                            error_message.style.display = "block";
                            setTimeout(function() {
                                error_message.style.display = "none";
                            }, 5000); // 5 seconds
                        }
                    })
                    .catch(error => {
                        console.error('There was a problem with the fetch operation:', error);
                    });
            }
        </script>
        <script type="text/javascript">
            const xProgressBar = ["Full Time", "Half Time", "InterShip"];
            const yProgressBar = [55, 49, 44];
            const ProgressBarColors = [
            "#fca311",
            "#f88fff",
            "#6ec3ff"
            ];

            new Chart("myChartbar", {
            type: "doughnut",
            data: {
                // labels: xProgressBar,
                datasets: [{
                backgroundColor: ProgressBarColors,
                data: yProgressBar
                }]
            },
            options: {
                title: {
                display: true,
                text: "World Wide Wine Production 2018"
                }
            }
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
