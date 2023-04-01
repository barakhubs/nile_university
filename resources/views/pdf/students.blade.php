<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Styles -->
    <style>
        .text-uppercase-bold-sm {
            text-transform: uppercase !important;
            font-weight: 500 !important;
            letter-spacing: 2px !important;
            font-size: .85rem !important;
        }

        .hover-lift-light {
            transition: box-shadow .25s ease, transform .25s ease, color .25s ease, background-color .15s ease-in;
        }

        .justify-content-center {
            justify-content: center !important;
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-clip: border-box;
            border: 1px solid rgba(30, 46, 80, .09);
            border-radius: 0.25rem;
            box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
        }

        .card-body {
            flex: 1 1 auto;
            padding: 0.5rem 0.5rem;
        }

        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            border-color: inherit;
            border-style: solid;
            border-width: 0;
        }

        .table td,
        .table th {
            border-bottom: 0;
            border-top: 1px solid #edf2f9;
            text-align: left !important;
        }

        .table>:not(caption)>*>* {
            padding: 1rem 1rem;
            background-color: var(--bs-table-bg);
            border-bottom-width: 1px;
            box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
        }

        .px-0 {
            padding-right: 0 !important;
            padding-left: 0 !important;
        }

        .table thead th,
        tbody td,
        tbody th {
            vertical-align: middle;
        }

        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            border-color: inherit;
            border-style: solid;
            border-width: 0;
        }

        .mt-5 {
            margin-top: 3rem !important;
        }
    </style>
</head>

<body>
    <div>
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body p-2">
                        <h4>
                            Provisional Results
                        </h4>
                        <p class="fs-sm">
                            These are provisional results
                        </p>

                        <table class="table border-bottom border-gray-200 mt-3">
                            <thead>
                                <tr>
                                    <th colspan="5" scope="col"
                                        class="fs-sm text-dark text-uppercase-bold-sm px-0">{{ config('nile_university.year') }}</th>
                                    <th colspan="4" scope="col"
                                        class="fs-sm text-dark text-uppercase-bold-sm text-end px-0">{{ config('nile_university.semester') }}</th>
                                </tr>
                            </thead>
                        </table>
                        <table class="table border-bottom border-gray-200 mt-1">
                            <thead>
                                <tr>
                                    <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm px-0">#</th>
                                    <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm text-end px-0">
                                        Course</th>
                                    <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm text-end px-0">CU
                                    </th>
                                    <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm text-end px-0">CW1
                                    </th>
                                    <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm text-end px-0">CW2
                                    </th>
                                    <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm text-end px-0">TCW
                                    </th>
                                    <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm text-end px-0">FM
                                    </th>
                                    <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm text-end px-0">TM
                                    </th>
                                    <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm text-end px-0">LP
                                    </th>
                                    <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm text-end px-0">GP
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $credit_units = 0;
                                    $total_credit_units = 0;
                                    $credit_units_score = 0;
                                    $total_credit_units_score = 0;
                                @endphp
                                @foreach ($results as $key => $item)
                                    @if ($item->course->semester == 'Semester One')
                                        <tr>
                                            <td class="px-0">{{ $key + 1 }}</td>
                                            <td class="px-0">{{ $item->course->title }}</td>
                                            <td class="px-0">{{ $item->course->credit_units }}</td>
                                            <td class="px-0">{{ $item->cat_one }}</td>
                                            <td class="px-0">{{ $item->cat_two }}</td>
                                            <td class="px-0">{{ $item->total_cw }}</td>
                                            <td class="px-0">{{ $item->final_exam }}</td>
                                            <td class="px-0">{{ $item->total_mark }}</td>
                                            <td class="px-0">{{ $item->letter_grade }}</td>
                                            <td class="px-0">{{ $item->grade_point }}</td>
                                        </tr>
                                        @php
                                            $credit_units = $item->course->credit_units;
                                            $total_credit_units += $credit_units;
                                            $credit_units_score = $credit_units * $item->grade_point;
                                            $total_credit_units_score += $credit_units_score;
                                        @endphp
                                    @endif
                                @endforeach
                            </tbody>
                        </table>

                        <table class="mt-5">
                            <tr>
                                <td class="col-md-6">
                                    <div class="text-muted mb-2">GPA:</div>
                                </td>
                                <td class="col-md-6">
                                    <div class="text-muted mb-2">{{ $total_credit_units_score / $total_credit_units }}</div>
                                </td>
                            </tr>
                            {{-- <tr>
                                <td class="col-md-6">
                                    <div class="text-muted mb-2">CGPA:</div>
                                </td>
                                <td class="col-md-6">
                                    <div class="text-muted mb-2">3.45</div>
                                </td>
                            </tr> --}}
                            <tr>
                                <td class="col-md-6 text-md-end">
                                    <div class="text-muted mb-2">Comment:</div>
                                </td>
                                <td class="col-md-6 text-md-end">
                                    <strong>Normal Progress</strong>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>
