@extends('dashboard.layouts.master')
@section('css')

    <link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"><a href="{{route("dashboard.home")}}">Dashboard</a></h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/Update / Employees</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">

                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">Update Employee</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">
                    <form method="post" action="{{ route('dashboard.employees.update', $employee->slug) }}" data-parsley-validate=""
                          enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="row row-sm mg-b-20">
                            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-5 col-lg-4">
                                                <label id="first_name" class="form-control-label">First Name:
                                                    <span class="tx-danger">*</span>
                                                </label>
                                                <input class="form-control @error('first_name') is-invalid @enderror"
                                                       id="first_name"
                                                       name="first_name"
                                                       placeholder="First Name"
                                                       value="{{ old('first_name', $employee->first_name) }}"
                                                       type="text">
                                                @error('first_name')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-5 col-lg-4 mg-t-20 mg-md-t-0">
                                                <label id="second_name" class="form-control-label">Second Name: <span
                                                        class="tx-danger">*</span></label>
                                                <input class="form-control @error('second_name') is-invalid @enderror"
                                                       id="second_name" name="second_name"
                                                       value="{{ old('second_name',$employee->second_name) }}"
                                                       placeholder="Second Name" type="text">
                                                @error('second_name')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-5 col-lg-4 mg-t-20 mg-md-t-0">
                                                <label id="family_name" class="form-control-label">Family Name <span
                                                        class="tx-danger">*</span></label>
                                                <input class="form-control @error('family_name') is-invalid @enderror"
                                                       id="family_name" name="family_name"
                                                       value="{{ old('family_name',$employee->family_name) }}"
                                                       placeholder="Family Name" type="text">
                                                @error('family_name')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row row-sm mg-b-20">
                            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">
                                                <label for="gender" class="form-control-label">Gender:
                                                    <span class="tx-danger">*</span>
                                                </label>
                                                <select name="gender" id="gender" class="form-control select2">
                                                    <option label="Choose Gender"></option>
                                                    @foreach(App\Models\Employee::GENDER as $key=>$item)
                                                        <option
                                                            value="{{ $key }}" {{ old('gender') ==$key || $employee->gender == $key ? 'selected' : '' }}>{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                                @error('gender')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-md-3 col-lg-3 mg-t-20 mg-md-t-0">
                                                <label for="job_title" class="form-control-label">Job Title: <span
                                                        class="tx-danger">*</span></label>
                                                <input class="form-control @error('job_title') is-invalid @enderror"
                                                       id="job_title" name="job_title"
                                                       value="{{ old('job_title',$employee->job_title) }}"
                                                       placeholder="Job Title" type="text">
                                                @error('job_title')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-md-3 col-lg-3 mg-t-20 mg-md-t-0 mb-3">
                                                <label for="id_card" class="form-control-label">ID Card Number: <span
                                                        class="tx-danger">*</span></label>
                                                <input class="form-control @error('id_card') is-invalid @enderror"
                                                       id="id_card" name="id_card"
                                                       value="{{ old('id_card',$employee->id_card) }}"
                                                       placeholder="ID Card Number" type="text">
                                                @error('id_card')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-md-3 col-lg-3 mg-t-20 mg-md-t-0 mb-3">
                                                <label for="mobile" class="form-control-label">Mobile Number: <span
                                                        class="tx-danger">*</span></label>
                                                <input class="form-control @error('mobile') is-invalid @enderror"
                                                       id="mobile" name="mobile"
                                                       value="{{ old('mobile',$employee->mobile) }}"
                                                       placeholder="Mobile Number" type="text">
                                                @error('mobile')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 col-lg-12 mg-t-20 mg-md-t-0">
                                                <label for="address" class="form-control-label">Address: <span
                                                        class="tx-danger">*</span></label>
                                                <textarea name="address" id="address" rows="5"
                                                          class="form-control">{{ old('address',$employee->address) }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row row-sm mg-b-20">
                            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6">
                                                <label id="date_of_birth" class="form-control-label">Date Of Birth:
                                                    <span class="tx-danger">*</span>
                                                </label>
                                                <input class="form-control @error('date_of_birth') is-invalid @enderror"
                                                       id="date_of_birth"
                                                       name="date_of_birth"
                                                       placeholder="Date Of Birth"
                                                       value="{{ old('date_of_birth',$employee->date_of_birth->format('Y-m-d')) }}"

                                                       type="date">
                                                @error('date_of_birth')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 col-lg-6 mg-t-20 mg-md-t-0">
                                                <label id="date_of_employment" class="form-control-label">Date Of
                                                    Employment:
                                                    <span class="tx-danger">*</span>
                                                </label>
                                                <input
                                                    class="form-control @error('date_of_employment') is-invalid @enderror"
                                                    id="date_of_employment"
                                                    name="date_of_employment"
                                                    placeholder="Date Of Employment"
                                                    value="{{ old('date_of_employment', $employee->date_of_employment->format('Y-m-d')) }}"
                                                    type="date">
                                                @error('date_of_employment')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row row-sm mg-b-20">
                            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-md-3 col-lg-3">
                                                <label id="nationality" class="form-control-label">Nationality:
                                                    <span class="tx-danger">*</span>
                                                </label>
                                                <input class="form-control @error('nationality') is-invalid @enderror"
                                                       id="nationality"
                                                       name="nationality"
                                                       placeholder="Nationality"
                                                       value="{{ old('nationality',$employee->nationality) }}"

                                                       type="text">
                                                @error('nationality')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-md-3 col-lg-3 mg-t-20 mg-md-t-0">
                                                <label id="office_tel" class="form-control-label">Office Telephone:
                                                    <span class="tx-danger">*</span>
                                                </label>
                                                <input class="form-control @error('office_tel') is-invalid @enderror"
                                                       id="office_tel"
                                                       name="office_tel"
                                                       placeholder="Office Telephone"
                                                       value="{{ old('office_tel',$employee->office_tel) }}"

                                                       type="tel">
                                                @error('office_tel')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-md-3 col-lg-3 mg-t-20 mg-md-t-0">
                                                <label id="salary" class="form-control-label">Salary:
                                                    <span class="tx-danger">*</span>
                                                </label>
                                                <input class="form-control @error('salary') is-invalid @enderror"
                                                       id="salary"
                                                       name="salary"
                                                       placeholder="Salary"
                                                       value="{{ old('salary',$employee->salary) }}"

                                                       type="number"
                                                       step="0.01">
                                                @error('salary')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-md-3 col-lg-3 mg-t-20 mg-md-t-0">
                                                <label id="bank_account" class="form-control-label">Bank Account:
                                                    <span class="tx-danger">*</span>
                                                </label>
                                                <input class="form-control @error('bank_account') is-invalid @enderror"
                                                       id="bank_account"
                                                       name="bank_account"
                                                       placeholder="Bank Account"
                                                       value="{{ old('bank_account',$employee->bank_account) }}"

                                                       type="text">
                                                @error('bank_account')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row row-sm mg-b-20">
                            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-md-3 col-lg-3">
                                                <label for="companies" class="form-control-label">Company:
                                                    <span class="tx-danger">*</span>
                                                </label>
                                                <select name="company_id" id="company_id" class="form-control select2">
                                                    <option label="Choose Company"></option>
                                                    @foreach($companies as $key=>$item)
                                                        <option
                                                            value="{{ $key }}" {{ old('company_id', '') == $key || $employee->company_id == $key ? 'selected' : '' }}>{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                                @error('company_id')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-md-3 col-lg-3 mg-t-20 mg-md-t-0">
                                                <label for="companies" class="form-control-label">Department:
                                                    <span class="tx-danger">*</span>
                                                </label>
                                                <select name="department_id" id="department_id"
                                                        class="form-control select2">
                                                    <option label="Choose Department"></option>
                                                    @foreach($departments as $key=>$item)
                                                        <option
                                                            value="{{ $key }}" {{ old('department_id', '') == $key || $employee->department_id == $key ? 'selected' : '' }}>{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                                @error('department_id')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-md-3 col-lg-3 mg-t-20 mg-md-t-0">
                                                <label for="companies" class="form-control-label">Section:
                                                    <span class="tx-danger">*</span>
                                                </label>
                                                <select name="section_id" id="section_id" class="form-control select2">
                                                    <option label="Choose Section"></option>
                                                    @foreach($sections as $key=>$item)
                                                        <option
                                                            value="{{ $key }}" {{ old('section_id', '') == $key || $employee->section_id == $key ? 'selected' : '' }}>{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                                @error('section_id')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-md-3 col-lg-3 mg-t-20 mg-md-t-0">
                                                <label for="companies" class="form-control-label">Shift:
                                                    <span class="tx-danger">*</span>
                                                </label>
                                                <select name="shift_id" id="shift_id" class="form-control select2">
                                                    <option label="Choose Shift"></option>
                                                    @foreach($shifts as $key=>$item)
                                                        <option
                                                            value="{{ $key }}" {{ old('shift_id', '') == $key || $employee->shift_id == $key ? 'selected' : '' }}>{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                                @error('shift_id')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row row-sm mg-b-20">
                            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-md-4 col-lg-4">
                                                <label for="photo" class="form-control-label">Employee Photo:
                                                    <span class="tx-danger">*</span>
                                                </label>
                                                <input type="file" name="photo" id="photo"
                                                       class="form-control @error('photo') is-invalid @enderror">
                                                @error('photo')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-md-4 col-lg-4 mg-t-20 mg-md-t-0">
                                                <label for="birth_certificate" class="form-control-label">Employee Birth
                                                    Certificate:
                                                </label>
                                                <input type="file" name="birth_certificate" id="birth_certificate"
                                                       class="form-control @error('birth_certificate') is-invalid @enderror">
                                                @error('birth_certificate')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-md-4 col-lg-4 mg-t-20 mg-md-t-0">
                                                <label for="collage_certificate" class="form-control-label">Employee
                                                    Collage Certificate:
                                                </label>
                                                <input type="file" name="collage_certificate" id="collage_certificate"
                                                       class="form-control @error('collage_certificate') is-invalid @enderror">
                                                @error('collage_certificate')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row row-sm mg-b-20">
                            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-md-6 col-lg-6">
                                                <label for="military_status" class="form-control-label">Employee
                                                    Military Status:
                                                </label>
                                                <input type="file" name="military_status" id="military_status"
                                                       class="form-control @error('military_status') is-invalid @enderror">
                                                @error('military_status')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 col-lg-6 mg-t-20 mg-md-t-0">
                                                <label for="criminal_record" class="form-control-label">Employee
                                                    Criminal Record:
                                                </label>
                                                <input type="file" name="criminal_record" id="criminal_record"
                                                       class="form-control @error('criminal_record') is-invalid @enderror">
                                                @error('criminal_record')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row row-sm mg-b-20">
                            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-md-12 col-lg-12">
                                                <label for="additional_files" class="form-control-label">Employee
                                                    Additional files:
                                                </label>
                                                <input type="file" name="additional_files[]" multiple
                                                       id="additional_files"
                                                       class="form-control @error('additional_files') is-invalid @enderror">
                                                @error('additional_files')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row row-xs wd-xl-80p">
                            <div class="col-sm-6 col-md-3 mg-t-10 mg-md-t-0">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <button type="reset" class="btn btn-danger">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('js')

    <!-- Internal Select2.min js -->
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <!-- Internal form-elements js -->
    <script src="{{URL::asset('assets/js/form-elements.js')}}"></script>
    <!-- Internal Form-validation js -->
    <script src="{{URL::asset('assets/js/form-validation.js')}}"></script>

    <script>
        $(document).ready(function () {

            $('#company_id').on('change', function () {

                let companyId = $(this).val()

                $('#department_id').empty()
                $('#department_id').html("<option label='Choose Department'></option>")

                $.ajax({
                    type: 'get',
                    url: '{{ url('/admin/get-departments') }}/' + companyId,
                    success: function (response) {
                        var response = JSON.parse(response)
                        var data = $.map(response, function (value, index) {
                            return [value]
                        })

                        data.forEach((element) => {
                            $('#department_id').append(`'<option value="${element['id']}">${element['name']}</option>'`)
                        })

                    }
                })

            })

            $('#department_id').on('change', function(){
                let departmentId = $(this).val()

                $('#section_id').empty()
                $('#section_id').html("<option label='Choose Section'></option>")
                $.ajax({
                    type: 'get',
                    url: '{{ url('/admin/get-sections') }}/' + departmentId,
                    success: function (response) {
                        var response = JSON.parse(response)
                        var data = $.map(response, function (value, index) {
                            return [value]
                        })



                        data.forEach((element) => {
                            $('#section_id').append(`'<option value="${element['id']}">${element['name']}</option>'`)
                        })

                    }
                })
            })

        })
    </script>
@endsection
