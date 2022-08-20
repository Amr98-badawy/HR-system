<table>
    <thead>
    <tr>
        <th>Account No.</th>
        <th>Name</th>
        <th>Company</th>
        <th>Department</th>
        <th>Section</th>
        <th>Shift</th>
        <th>Day</th>
        <th>Check In</th>
        <th>Check Out</th>
        <th>Work Hour</th>
    </tr>
    </thead>
    <tbody>
    @foreach($attendances as $item)
        <tr>
            <th>{{ $item->employee->account_no }}</th>
            <th>{{ $item->employee->fullName }}</th>
            <th>{{ $item->employee->company->name }}</th>
            <th>{{ $item->employee->department->name }}</th>
            <th>{{ $item->employee->section->name }}</th>
            <th>{{ $item->employee->shift->name }}</th>
            <th>{{ $item->created_at->format('M d, Y') }}</th>
            <th>{{ \Carbon\Carbon::make($item->check_in)->format('h:i A') }}</th>
            <th>{{ \Carbon\Carbon::make($item->check_out)->format('h:i A') }}</th>
            <th>{{ \Carbon\Carbon::make($item->work_hour)->format('H:i:s') }}</th>
        </tr>
    @endforeach
    </tbody>
</table>
