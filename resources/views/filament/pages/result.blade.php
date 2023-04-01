<x-filament::page>
    <div class="page-content container">
        <div class="page-header text-blue-d2">
            <h1 class="page-title text-secondary-d1">
                Reg
                <small class="page-info">
                    <i class="fa fa-angle-double-right"></i>
                    No: #{{ $student->registration_number }}
                </small>
            </h1>

            @if ($results->count() > 0)
            <div class="page-tools">
                <div class="action-buttons">
                    {{-- onclick="printDiv('pdf','{{ $student->name }} - results')" --}}
                    <a target="_blank" class="btn bg-white btn-light mx-1px text-95" href="{{ route('students.results.print', $student->id) }}" data-title="Print">
                        <i class="mr-1 heroicon-o-printer text-primary-m1 text-120 w-2"></i>

                        Print to Pdf
                    </a>/
                    <a class="btn bg-white btn-light mx-1px text-95" href="{{ route('students.results.mail', $student->id) }}" data-title="Print">
                        <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                        Email to student
                    </a>
                </div>
            </div>
            @endif
        </div>

        <div class="container px-0">
            <div class="row mt-4">
                <div class="col-12 col-lg-12">
                    <!-- .row -->
                    {{-- id="pdf" --}}
                    <div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div>
                                <span class="text-500 text-grey-m2 align-middle">Name:</span>
                                <span class="text-sm text-grey-m2 align-middle">{{ $student->name }}</span>
                            </div>

                            <div>
                                <span class="text-500 text-grey-m2 align-middle">Student Number:</span>
                                <span
                                    class="text-sm text-grey-m2 align-middle">{{ $student->registration_number }}</span>
                            </div>

                            <div>
                                <span class="text-500 text-grey-m2 align-middle">Email:</span>
                                <span class="text-sm text-grey-m2 align-middle">{{ $student->email }}</span>
                            </div>

                            <div>
                                <span class="text-500 text-grey-m2 align-middle">Semester:</span>
                                <span class="text-sm text-grey-m2 align-middle">Two</span>
                            </div>

                            <div>
                                <span class="text-500 text-grey-m2 align-middle">Year:</span>
                                <span class="text-sm text-grey-m2 align-middle">One</span>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>

                    <div class="mt-4">

                        <!-- or use a table instead -->
                        <div class="table-responsive">
                            <table
                                class="filament-tables-table w-full text-start divide-y table-auto dark:divide-gray-700">
                                <thead class="bg-none bgc-default-tp1">
                                    <tr class="text-white">
                                        <th>#</th>
                                        <th class="filament-tables-header-cell p-0 td-course">Course Name</th>
                                        <th class="filament-tables-header-cell p-0 ">CU</th>
                                        <th class="filament-tables-header-cell p-0 ">CW1/20</th>
                                        <th class="filament-tables-header-cell p-0 ">CW2/20</th>
                                        <th class="filament-tables-header-cell p-0 ">CW/40</th>
                                        <th class="filament-tables-header-cell p-0 ">FE/100</th>
                                        <th class="filament-tables-header-cell p-0 ">Total mark</th>
                                        <th class="filament-tables-header-cell p-0 ">LG</th>
                                        <th class="filament-tables-header-cell p-0 ">GP</th>
                                    </tr>
                                </thead>

                                <tbody class="text-95 text-secondary-d3">
                                    @if ($results->count() > 0)
                                    @php
                                        $credit_units = 0;
                                        $total_credit_units = 0;
                                        $credit_units_score = 0;
                                        $total_credit_units_score = 0;
                                    @endphp
                                    @foreach ($results as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td class="filament-tables-header-cell p-0 td-course">
                                            {{ $item->course->title }}</td>
                                        <td class="filament-tables-header-cell p-0 ">
                                            {{ $item->course->credit_units }}</td>
                                        <td class="filament-tables-header-cell p-0 ">{{ $item->cat_one }}
                                        </td>
                                        <td class="filament-tables-header-cell p-0 ">{{ $item->cat_two }}</td>
                                        <td class="filament-tables-header-cell p-0 ">{{ $item->total_cw }}</td>
                                        <td class="filament-tables-header-cell p-0 ">{{ $item->final_exam }}
                                        </td>
                                        <td class="filament-tables-header-cell p-0 ">{{ $item->total_mark }}
                                        </td>
                                        <td class="filament-tables-header-cell p-0 ">{{ $item->letter_grade }}
                                        </td>
                                        <td class="filament-tables-header-cell p-0 ">{{ $item->grade_point }}
                                        </td>

                                        @php
                                            $credit_units = $item->course->credit_units;
                                            $total_credit_units += $credit_units;
                                            $credit_units_score = $credit_units * $item->grade_point;
                                            $total_credit_units_score += $credit_units_score;
                                        @endphp
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr><td colspan="10">No results added yet</td></tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        @if ($results->count() > 0)
                        <div class="row mt-3">
                            <br>
                            <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                                <table class="table-responsive" width="100%">
                                    <tr>
                                        <td style="text-align:right">
                                            GPA: {{ number_format($total_credit_units_score / $total_credit_units, 2) }}
                                        </td>
                                        <td></td>
                                    </tr>
                                    {{-- <tr>
                                        <td class="td-course">CGPA</td>
                                        <td>3.43</td>
                                    </tr> --}}
                                </table>

                            </div>
                        </div>
                        @endif

                        <hr />
                    </div>
                    </div>
                    <div id="back">
                        <span class="text-secondary-d1 text-105">You need to go back to students lists?</span>
                        <a href="" class="btn btn-info btn-bold px-4 float-right mt-3 mt-lg-0">Click here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .text-secondary-d1 {
            color: #728299 !important;
        }

        .page-header {
            margin: 0 0 1rem;
            padding-bottom: 1rem;
            padding-top: .5rem;
            border-bottom: 1px dotted #e2e2e2;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-pack: justify;
            justify-content: space-between;
            -ms-flex-align: center;
            align-items: center;
        }

        .td-course {
            text-align: left !important;
        }

        td {
            text-align: center !important;
        }

        .page-title {
            padding: 0;
            margin: 0;
            font-size: 1.75rem;
            font-weight: 300;
        }

        .brc-default-l1 {
            border-color: #dce9f0 !important;
        }

        .ml-n1,
        .mx-n1 {
            margin-left: -.25rem !important;
        }

        .mr-n1,
        .mx-n1 {
            margin-right: -.25rem !important;
        }

        .mb-4,
        .my-4 {
            margin-bottom: 1.5rem !important;
        }

        hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 0;
            border-top: 1px solid rgba(0, 0, 0, .1);
        }

        .text-grey-m2 {
            color: #888a8d !important;
        }

        .text-success-m2 {
            color: #86bd68 !important;
        }

        .font-bolder,
        .text-500 {
            font-weight: 600 !important;
        }

        .text-110 {
            font-size: 110% !important;
        }

        .text-blue {
            color: #478fcc !important;
        }

        .pb-25,
        .py-25 {
            padding-bottom: .75rem !important;
        }

        .pt-25,
        .py-25 {
            padding-top: .75rem !important;
        }

        .bgc-default-tp1 {
            background-color: rgba(121, 169, 197, .92) !important;
        }

        .bgc-default-l4,
        .bgc-h-default-l4:hover {
            background-color: #f3f8fa !important;
        }

        .page-header .page-tools {
            -ms-flex-item-align: end;
            align-self: flex-end;
        }

        .btn-light {
            color: #757984;
            background-color: #f5f6f9;
            border-color: #dddfe4;
        }

        .w-2 {
            width: 1rem;
        }

        .text-120 {
            font-size: 120% !important;
        }

        .text-primary-m1 {
            color: #4087d4 !important;
        }

        .text-danger-m1 {
            color: #dd4949 !important;
        }

        .text-blue-m2 {
            color: #68a3d5 !important;
        }

        .text-150 {
            font-size: 150% !important;
        }

        .text-60 {
            font-size: 60% !important;
        }

        .text-grey-m1 {
            color: #7b7d81 !important;
        }

        .align-bottom {
            vertical-align: bottom !important;
        }
    </style>

</x-filament::page>
