<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="container p-5">
        <table id="kt_datatable_dom_positioning" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
            <thead>
                <th>Student Number</th>
                <th>Name</th>
                <th>Program</th>
                <th>RLE</th>
            </thead>
            <tbody>
                @foreach($data as $student)
                <tr>
                    <td>{{ $student->student_number }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->program }}</td>
                    <td>{{ $student->rle }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
    
            </tfoot>
        </table>
    </div>

    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        $(function(){
           $("#kt_datatable_dom_positioning").DataTable({
            "language": {
            "lengthMenu": "Show _MENU_",
            },
            "pageLength": 14,
            "dom":
            "<'row'" + "<'col-sm-6 d-flex align-items-center justify-conten-start'l>"
                + "<'col-sm-6 d-flex align-items-center justify-content-end'f>" + ">" + "<'table-responsive'tr>" + "<'row'"
                + "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>"
                + "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" + ">" });
        })
    </script>
</body>
</html>