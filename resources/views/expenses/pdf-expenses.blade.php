<!DOCTYPE html>
<html>
<head>
    <title>Reblate Solutions Expenses</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<div id="expenseData">
    <h1>{{ $title }}</h1>
    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Expense ID</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Parent Category</th>
                                    <th>Sub Category</th>
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
                                        @php $count++;  @endphp
                                    </tr>
                                @endforeach
                            </tbody>
    </table>
</div>
<button type="button" id="downloadBtn" class="btn btn-primary">Download as PDF</button>
<script>
    document.getElementById('downloadBtn').addEventListener('click', function () {
        var element = document.getElementById('expenseData'); // The content to convert to PDF
        var opt = {
            margin:       1,
            filename:     'expenses-report.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2 },
            jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
        };
        // Convert the element to PDF and download it
        html2pdf().from(element).set(opt).save();
    });
</script>

</body>
</html>
