@extends('dashboard.layouts.master')
@section('css')

    <link href="{{asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"><a href="{{route("dashboard.home")}}">@lang('lang.dashboard')</a></h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ @lang('lang.Employees')</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                <a href="https://vodex-hr.tawk.help" target="_blank" type="button" class="btn btn-info btn-icon ml-2"><i class="fas fa-info"></i></a>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->

    <!--div-->
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">Employees Table</h4>
                    <a href="{{ route('dashboard.employees.create') }}" class="btn btn-success">@lang('lang.create')</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table key-buttons text-md-nowrap">
                        <thead>
                        <tr>
                            <th class="border-bottom-0"> @lang('lang.account_no')</th>
                            <th class="border-bottom-0">@lang('lang.name')</th>
{{--                            <th class="border-bottom-0">Photo</th>--}}
                            <th class="border-bottom-0">@lang('lang.job_title')
                            <th class="border-bottom-0">@lang('lang.company')</th>
                            <th class="border-bottom-0">@lang('lang.department')</th>
{{--                            <th class="border-bottom-0">Section</th>--}}
{{--                            <th class="border-bottom-0">Office Telephone</th>--}}
                            <th class="border-bottom-0">@lang('lang.shift')</th>
{{--                            <th class="border-bottom-0">Salary</th>--}}
{{--                            <th class="border-bottom-0">Date of employment</th>--}}
                            <th class="border-bottom-0">@lang('lang.action')</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/div-->

@endsection
@section('js')

    <!-- Internal Data tables -->
    <script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>

    <script>
        const table = $('#example').DataTable({
            serverSide: true,
            processing: true,
            lengthChange: false,
            ajax: "{{ route('dashboard.employees.company', $company->id) }}",
            buttons: ['copy', 'excel', 'pdf', 'colvis'],
            responsive: true,
            pageLength: 25,
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
                lengthMenu: '_MENU_ ',
            },
            columns: [
                {data: "account_no"},
                {data: "name"},
                // {data: "photo"},
                {data: "job_title"},
                {data: "company"},
                {data: "department"},
                // {data: "section"},
                // {data: "office_tel"},
                {data: "shift"},
                // {data: "salary"},
                // {data: "date_of_employment"},
                {data: 'actions', name: 'actions', orderable: false, searchable: false},
            ]
        });
        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');
    </script>

@endsection
