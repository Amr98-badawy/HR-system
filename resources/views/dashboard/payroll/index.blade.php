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
                <h4 class="content-title mb-0 my-auto"><a href="{{route("dashboard.home")}}">@lang('lang.dashboard')</a>
                </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ @lang('lang.route_devices')</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                <a href="https://vodex-hr.tawk.help" target="_blank" type="button" class="btn btn-info btn-icon ml-2"><i
                        class="fas fa-info"></i></a>
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
                    <h4 class="card-title mg-b-0">@lang('lang.table') @lang('lang.route_devices')</h4>
                    <a href="{{ route('dashboard.devices.create') }}" class="btn btn-success">@lang('lang.create')</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table key-buttons text-md-nowrap">
                        <thead>
                        <tr>
                            <th class="border-bottom-0">Payroll No</th>
                            <th class="border-bottom-0">Employee Name</th>
                            <th class="border-bottom-0">Working Hours</th>
                            <th class="border-bottom-0">Working Additional Hours</th>
                            <th class="border-bottom-0">Working Deducted Hours</th>
                            <th class="border-bottom-0">Salary</th>
                            <th class="border-bottom-0">Actions</th>
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
            ajax: "{{ route('dashboard.payroll.index') }}",
            buttons: ['copy', 'excel', 'pdf', 'colvis'],
            responsive: true,
            pageLength: 25,
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
                lengthMenu: '_MENU_ ',
            },
            columns: [
                {data: "payroll_no"},
                {data: "employee_name"},
                {data: "working_hour"},
                {data: "working_additional"},
                {data: "working_deducted"},
                {data: "salary"},
                {data: 'actions', name: 'actions', orderable: false, searchable: false},
            ]
        });
        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');
    </script>

@endsection
