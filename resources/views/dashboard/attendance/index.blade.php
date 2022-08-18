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
                <h4 class="content-title mb-0 my-auto"><a href="{{route("dashboard.home")}}">@lang('lang.dashboard')</a></h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ @lang('lang.Attendances')</span>
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
                    <h4 class="card-title mg-b-0">@lang('lang.table') @lang('lang.Attendances')</h4>
                    <a href="{{ route('dashboard.users.create') }}" class="btn btn-success">@lang('lang.create')</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table key-buttons text-md-nowrap">
                        <thead>
                        <tr>
                            <th class="border-bottom-0">@lang('lang.employee')</th>
{{--                            <th class="border-bottom-0">Department</th>--}}
{{--                            <th class="border-bottom-0">Section</th>--}}
                            <th class="border-bottom-0">@lang('lang.day')</th>
                            <th class="border-bottom-0">@lang('lang.d_status')</th>
                            <th class="border-bottom-0">@lang('lang.check_in')</th>
                            <th class="border-bottom-0">@lang('lang.check_out')</th>
                            <th class="border-bottom-0">@lang('lang.W_hour')</th>
                            <th class="border-bottom-0">@lang('lang.d_time')</th>
                            <th class="border-bottom-0">@lang('lang.A_time')</th>
                            <th class="border-bottom-0">@lang('lang.note')</th>
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
            ajax: "{{ route('dashboard.attendances.index') }}",
            buttons: ['copy', 'excel', 'pdf', 'colvis'],
            responsive: true,
            pageLength: 25,
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
                lengthMenu: '_MENU_ ',
            },
            columns: [
                {data: "name"},
                {data: "department"},
                {data: "section"},
                {data: "created_at"},
                {data: "day_status"},
                {data: "check_in"},
                {data: "check_out"},
                {data: "work_hour"},
                {data: "delay"},
                {data: "additional"},
                {data: "note"},
                {data: 'actions', name: 'actions', orderable: false, searchable: false},
            ]
        });
        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');
    </script>

@endsection
