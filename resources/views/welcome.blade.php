<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
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
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(30, 46, 80, .09);
            border-radius: 0.25rem;
            box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
        }

        .p-5 {
            padding: 3rem !important;
        }

        .card-body {
            flex: 1 1 auto;
            padding: 1.5rem 1.5rem;
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

        .icon-circle[class*=text-] [fill]:not([fill=none]),
        .icon-circle[class*=text-] svg:not([fill=none]),
        .svg-icon[class*=text-] [fill]:not([fill=none]),
        .svg-icon[class*=text-] svg:not([fill=none]) {
            fill: currentColor !important;
        }

        .svg-icon>svg {
            width: 1.45rem;
            height: 1.45rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body p-5">
                        <h4>
                            Provisional Results
                        </h4>
                        <p class="fs-sm">
                            These are provisional results
                        </p>

                        <div class="border-top border-gray-200 pt-4 mt-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="text-muted mb-2">Reg No.</div>
                                    <strong>#88305</strong>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <div class="text-muted mb-2">Date Generated</div>
                                    <strong>Feb/09/20</strong>
                                </div>
                            </div>
                        </div>

                        <div class="border-top border-gray-200 mt-4 py-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="text-muted mb-2">Student details</div>
                                    <strong>
                                        John McClane
                                    </strong>
                                    <p class="fs-sm">
                                        0773034311
                                        <br>
                                        <a href="#!" class="text-purple">john@email.com
                                        </a>
                                    </p>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <div class="text-muted mb-2">Program details</div>
                                    <strong>
                                        Faculty
                                    </strong>
                                    <p class="fs-sm">
                                        Program name
                                        <br>
                                        <span class="text-purple">Program
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <table class="table border-bottom border-gray-200 mt-3">
                            <thead>
                                <tr>
                                    <th colspan="5" scope="col"
                                        class="fs-sm text-dark text-uppercase-bold-sm px-0">Year one</th>
                                    <th colspan="4" scope="col"
                                        class="fs-sm text-dark text-uppercase-bold-sm text-end px-0">semester one</th>
                                </tr>
                            </thead>
                        </table>
                        <table class="table border-bottom border-gray-200 mt-3">
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
                                <tr>
                                    <td class="px-0">1</td>
                                    <td class="px-0">Theme customization</td>
                                    <td class="px-0">$60.00</td>
                                    <td class="px-0">$60.00</td>
                                    <td class="px-0">$60.00</td>
                                    <td class="px-0">$60.00</td>
                                    <td class="px-0">$60.00</td>
                                    <td class="px-0">$60.00</td>
                                    <td class="px-0">$60.00</td>
                                    <td class="px-0">$60.00</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="mt-5">
                            <div class="d-flex justify-content-end">
                                <p class="text-muted me-3">GPA:</p>
                                <span>3.45</span>
                            </div>
                            <div class="d-flex justify-content-end">
                                <p class="text-muted me-3">CGPA:</p>
                                <span>3.45</span>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <h5 class="me-3">Comment:</h5>
                                <h5 class="text-success">Normal Progress</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>
