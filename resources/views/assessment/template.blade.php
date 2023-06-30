@php
    use App\Classes\ScheduleClass;  
@endphp

<html>

<head>
    <title>Registration Form - {{ $enrolment->semester . ' Semester A.Y. ' . $enrolment->academic_year->ay_name }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
        body {
            padding: 0;
            margin: 0;
            font-size: 9pt;
            font-family: 'sans-serif';
        }

        header {
            position: fixed;
            top: -20px;
        }

        footer {
            position: fixed;
            bottom: 0px;
        }

        table tr (td, th) {
            padding: 0 !important;
            margin: 0 !important;
        }

        .watermark {
            height: 40px;
            opacity: 19%;
            /* opacity: 0.1; */
        }

        .div-wm {
            position: fixed;
            height: 40px;
            transform: rotate(345deg);
        }

        .table tr td,
        .table tr th {
            border: solid black 1px;
        }

        .pagenum:before {
            content: counter(page);
        }

        main .schedules-wrapper {
            width: 100%;
        }

        main .schedules-wrapper .sched-tbl {
            width: 100%;
            font-size: 10px;
            margin-bottom: 12px;
        }

        main .schedules-wrapper .sched-tbl {
            border-collapse: collapse;
        }

        main .schedules-wrapper .sched-tbl .sched-th,
        .sched-td {
            border: 1px solid black;
            padding: 2px !important;
            font-size: 10px;
        }

        main .schedules-wrapper .sched-tbl .sched-td {
            font-size: 10px;
        }

        main .table-title {
            text-align: left;
            font-weight: bold;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div style="width: 100%; padding: 0; margin: 0; position: fixed; top: -3%; text-align: center;">
        <img src="{{ asset('/images/header.webp') }}" style="width:400px; margin-right: 50px;">
    </div>
    <header class="w-100 p-0 m-0">
        @for ($i = -1; $i < 30; $i++) @php $mod=$i % 2 @endphp @for ($j = -1; $j < 6; $j++)
                @php
                    if ($mod) {
                        $space = -75;
                    } else {
                        $space = 0;
                } @endphp <div class="div-wm" style="top:{{ $i * 61 }}px; left:{{ $j * 150 + $space }}px">
                    <img class="watermark" src="{{ asset('/images/pnc-doc-watermark.webp') }}">
                </div>
            @endfor
        @endfor
    </header>

    <footer class="w-100">
        <table class="w-100">
            <tr>
                <td class="align-top" style="width:90%">
                </td>

            </tr>
        </table>

        <table class="w-100">
            <tr>
                <td class="align-bottom" style="width:70%">
                    <small>
                        <i>
                            This document is not valid without the signature of the University Registrar.<br>
                            Generated on {{ date('Fj,Y\a\tg:iA') }}
                        </i>
                    </small>
                </td>
                <td class="text-center ps-5" style="width: 40%; padding-top: 500px;">
                    <img src="{{ asset('/images/doc_gio_sign.webp') }}" alt=""
                        style="height: 70px; position: absolute; top: -50px; right: 70px">
                    <div style="">
                        <b>DR. GEORGE F. BARUNDIA</b><br>
                        University Registrar
                    </div>
                    <br>
                </td>
            </tr>
        </table>
    </footer>

    @for ($i = 0; $i < 2; $i++)
        <main style="@if ($i) page-break-before: always @endif">
            <table class="w-100" style="margin-top: -30px;">
                <tr>
                    <td class="text-right">
                        @if ($i)
                            <b>STUDENT'S COPY</b>
                        @else
                            <b>REGISTRAR'S COPY</b>
                        @endif
                    </td>
                </tr>
            </table>
            <table class="w-100 mb-4" style="position: absolute; top: 6%; font-size: 10px;">
                <tr>
                    <td class="text-center pb-4" colspan="4">
                        <b style="font-size: 12px;">REGISTRATION FORM</b><br>
                        {{ $enrolment->semester }} Semester, Academic Year {{ $enrolment->academic_year->ay_name }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%; vertical-align: center;">Student Name:</td>
                    <th style="width: 50%; vertical-align: center;">
                        <p>{{ $enrolment->student->fullname }}</p>
                    </th>
                    <td style="width: 25%; vertical-align: center;">Student No.:</td>
                    <th style="width: 75%; vertical-align: center;">
                        <p>{{ $enrolment->student->stud_id }}</p>
                    </th>
                </tr>
                <tr style="width: 25%; vertical-align: center;">Year Level:</td>
                    <th style="width: 50%; vertical-align: center;">
                        <p>{{ $enrolment->year_standing }} Year</p>
                    </th>
                    <td style="width: 25%; vertical-align: center;">Program/Major:</td>
                    <th style="width: 75%; vertical-align: center;">
                        <p>{{ $enrolment->program->description }} ({{ $enrolment->program->program_code }})</p>
                    </th>
                </tr>
                @if ($student_config['student_type'] == 1)
                    <tr>
                        <td style="width: 25%; vertical-align: center;">Clasification:</td>
                        <th style="width: 50%; vertical-align: center;">
                            <p>{{ $enrolment->student->classification }}</p>
                        </th>
                        <td style="width: 25%; vertical-align: center;">Unifast:</td>
                        <th style="width: 75%; vertical-align: center;">
                            <p>{{ $student_config['is_unifast'] ? 'Yes' : 'No' }}</p>
                        </th>
                    </tr>
                @endif
            </table>

            <div class="table-container" style="width: 100%; position: absolute; top: 17%;">
                <div class="schedules-wrapper" style="width: 100%">
                    <p class="table-title">Enlisted Schedules</p>
                    <table class="sched-tbl">
                        <thead class="sched-thead">
                            <th class="sched-th"
                                style="width: 10%; text-align: left; font-weight: bold; padding-left: 5px;">Course Code
                            </th>
                            <th class="sched-th"
                                style="width: 20%; text-align: left; font-weight: bold; padding-left: 5px;">Description
                            </th>
                            <th class="sched-th" style="width: 5%; text-align: center; font-weight: bold;">Lec Unit</th>
                            <th class="sched-th" style="width: 5%; text-align: center; font-weight: bold;">Lab Unit</th>
                            <th class="sched-th" style="width: 5%; text-align: center; font-weight: bold;">Day</th>
                            <th class="sched-th" style="width: 15%; text-align: center; font-weight: bold;">Time</th>
                            <th class="sched-th" style="width: 15%; text-align: center; font-weight: bold;">Room</th>
                            <th class="sched-th" style="width: 12%; text-align: center; font-weight: bold;">Section</th>
                        </thead>

                        @php
                            $enroled_units = 0;
                            $lec_units = 0;
                            $lab_units = 0;
                            $clab_units = 0;
                        @endphp

                        @foreach ($schedules as $schedule)
                            @php
                                $enroled_units += $schedule->units;
                                $lec_units += $schedule->lec_units;
                                $lab_units += $schedule->lab_units;
                                $clab_units = 0;

                                $formated_sched = ScheduleClass::formatDayTime($schedule->day, $schedule->time, $schedule->room);

                            @endphp
                            <tr class="sched-tr">
                                <td class="sched-td" style="text-align: left; padding-left: 5px;">{{ $schedule->code }}
                                </td>
                                <td class="sched-td" style="text-align: left; padding-left: 5px;">
                                    {{ $schedule->description }}
                                </td>
                                <td class="sched-td" style="text-align: center;">{{ $schedule->lec_units }}</td>
                                <td class="sched-td" style="text-align: center;">
                                    {{ $schedule->lab_units ? $schedule->lab_units : 0 }}
                                </td>
                                <td class="sched-td" style="text-align: center;">{{ $formated_sched['day'] }}</td>
                                <td class="sched-td" style="text-align: center;">{{ $formated_sched['time'] }}</td>
                                <td class="sched-td" style="text-align: center;">{{ $formated_sched['room'] }}</td>
                                <td class="sched-td" style="text-align: center;">{{ $schedule->block }}</td>
                            </tr>
                        @endforeach
                        <tfoot>
                            <tr class="sched-tr">
                                <th class="sched-th" colspan="8" style="text-align: center">
                                    <span style="font-weight: bold">Total Units:</span>
                                    <span>{{ $enroled_units }}</span>

                                    <span style="font-weight: bold">Lec:</span>
                                    <span>{{ $lec_units }}</span>

                                    <span style="font-weight: bold">Lab:</span>
                                    <span>{{ $lab_units }}</span>

                                    {{-- <span style="font-weight: bold">CLab:</span>
                                    <span>{{ $enrolment->clab_units }}</span> --}}
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="schedules-wrapper" style="width: 100%">
                    <p class="table-title">Assessment Breakdown</p>

                    <table class="sched-tbl">
                        <thead class="sched-thead">
                            <th class="sched-th" style="width: 80%; text-align: center; font-weight: bold;">Particulars
                            </th>
                            <th class="sched-th" style="width: 10%; text-align: center; font-weight: bold;">Unifast
                            </th>
                            <th class="sched-th" style="width: 10%; text-align: center; font-weight: bold;">Payables
                            </th>
                        </thead>

                        @php
                            $sub_total = 0;
                            $unifast_total = 0;
                            $payables_total = 0;
                            $total = 0;
                        @endphp

                        @if ($student_config['is_unifast'])
                            @foreach ($student_fee_breakdown as $fee)
                                @php
                                    switch ($fee->is_unifast) {
                                        case 1:
                                            $sub_total += $fee->amount;
                                            $unifast_total += $fee->amount;
                                            break;
                                    
                                        case 0:
                                            $sub_total += $fee->amount;
                                            $payables_total += $fee->amount;
                                            break;
                                    }
                                @endphp


                                @if ($fee->tuition_type == 1)
                                    <tr class="sched-tr">
                                        <td class="sched-td" style="text-align: left; padding-left: 5px;">
                                            {{ $fee->name }}</td>
                                        <td class="sched-td" style="text-align: right;">
                                            {{ $fee->is_unifast == 1
                                                ? number_format($student_fee_breakdown->where('tuition_type', 1)->sum('amount'), 2)
                                                : '0.00' }}
                                        </td>
                                        <td class="sched-td" style="text-align: right;">
                                            {{ $fee->is_unifast == 0
                                                ? number_format($student_fee_breakdown->where('tuition_type', 1)->sum('amount'), 2)
                                                : '0.00' }}
                                        </td>
                                    </tr>
                                @else
                                    <tr class="sched-tr">
                                        <td class="sched-td" style="text-align: left; padding-left: 5px;">
                                            {{ $fee->name }}</td>
                                        <td class="sched-td" style="text-align: right;">
                                            {{ $fee->is_unifast == 1 ? number_format($fee->amount, 2) : '0.00' }}
                                        </td>
                                        <td class="sched-td" style="text-align: right;">
                                            {{ $fee->is_unifast == 0 ? number_format($fee->amount, 2) : '0.00' }}
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @else
                            {{-- @foreach ($fee_types as $fee)
                            <tr class="sched-tr">
                                <td class="sched-td" style="text-align: left; padding-left: 5px;">{{ $fee->name }}</td>
                                <td class="sched-td" style="text-align: right;">{{ 0.00 }}</td>
                                <td class="sched-td" style="text-align: right;">{{ number_format($student_fee_breakdown->where('fee_type_id', $fee->fee_type_id)->sum('amount'), 2) }}</td>
                            </tr>
                        @endforeach --}}
                            @foreach ($student_fee_breakdown as $fee)
                                @php
                                    switch ($fee->is_unifast) {
                                        case 1:
                                            $sub_total += $fee->amount;
                                            $unifast_total += $fee->amount;
                                            break;
                                    
                                        case 0:
                                            $sub_total += $fee->amount;
                                            $payables_total += $fee->amount;
                                            break;
                                    }
                                @endphp

                                @if ($fee->tuition_type == 1)
                                    <tr class="sched-tr">
                                        <td class="sched-td" style="text-align: left; padding-left: 5px;">
                                            {{ $fee->name }}</td>
                                        <td class="sched-td" style="text-align: right;">
                                            {{ '0.00' }}
                                        </td>
                                        <td class="sched-td" style="text-align: right;">
                                            {{ number_format($student_fee_breakdown->where('tuition_type', 1)->sum('amount'), 2) }}
                                        </td>
                                    </tr>
                                @else
                                    <tr class="sched-tr">
                                        <td class="sched-td" style="text-align: left; padding-left: 5px;">
                                            {{ $fee->name }}</td>
                                        <td class="sched-td" style="text-align: right;">
                                            {{ '0.00' }}
                                        </td>
                                        <td class="sched-td" style="text-align: right;">
                                            {{ number_format($fee->amount, 2) }}
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif

                        <tfoot>
                            @if ($student_config['is_unifast'])
                                <tr class="sched-tr">
                                    <th class="sched-th">Total:</th>
                                    <th class="sched-th" style="text-align: right;">
                                        {{ number_format($unifast_total, 2) }}
                                    </th>
                                    <th class="sched-th" style="text-align: right;">
                                        {{ number_format($payables_total, 2) }}</th>
                                </tr>
                            @else
                                <tr class="sched-tr">
                                    <th class="sched-th">Total:</th>
                                    <th class="sched-th" style="text-align: right;">{{ 0.0 }}
                                    </th>
                                    <th class="sched-th" style="text-align: right;">
                                        {{ number_format($student_fee_breakdown->sum('amount'), 2) }}</th>
                                </tr>
                            @endif
                        </tfoot>
                    </table>

                    @php
                        $total = $sub_total - $unifast_total;
                    @endphp

                    <table class="sched-tbl" style="width: 100%; ">
                        @if ($student_config['is_unifast'])
                            <tr class="sched-tr">
                                <td class="border border-dark text-center" rowspan="3" style="width:65%">
                                    <h5 class="mb-0"><b>REGISTERED</b></h5>
                                    DATE: <u>{{ strtoupper(date('F j, Y', strtotime($enrolment->created_at))) }}</u>
                                </td>
                                <th class="sched-th text-right">TOTAL ASSESSMENT:</th>
                                <th class="sched-th text-right">{{ number_format($sub_total, 2) }}</th>
                            </tr>
                            <tr class="sched-tr">
                                <th class="sched-th text-right">Less (Unifast):</th>
                                <th class="sched-th text-right">{{ number_format($unifast_total, 2) }}</th>
                            </tr>
                            <tr class="sched-tr">
                                <th class="sched-th text-right">TOTAL AMOUNT DUE:</th>
                                <th class="sched-th text-right">{{ number_format($total, 2) }}</th>
                            </tr>
                        @else
                            <tr class="sched-tr">
                                <td class="border border-dark text-center" rowspan="3" style="width:65%">
                                    <h5 class="mb-0"><b>REGISTERED</b></h5>
                                    DATE: <u>{{ strtoupper(date('F j, Y', strtotime($enrolment->created_at))) }}</u>
                                </td>
                                <th class="sched-th text-right">TOTAL ASSESSMENT:</th>
                                <th class="sched-th text-right">
                                    {{ number_format($student_fee_breakdown->sum('amount'), 2) }}</th>
                            </tr>
                            <tr class="sched-tr">
                                <th class="sched-th text-right">Less (Unifast):</th>
                                <th class="sched-th text-right">{{ 0.0 }}</th>
                            </tr>
                            <tr class="sched-tr">
                                <th class="sched-th text-right">TOTAL AMOUNT DUE:</th>
                                <th class="sched-th text-right">
                                    {{ number_format($student_fee_breakdown->sum('amount'), 2) }}</th>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
    @endfor
</body>

</html>
