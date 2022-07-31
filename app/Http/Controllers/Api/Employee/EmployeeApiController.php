<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\EmployeeSignRequest;
use App\Http\Resources\Employee\EmployeeResource;
use App\Models\Employee;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EmployeeApiController extends Controller
{
    public function getEmployee(EmployeeSignRequest $request, Employee $employee)
    {
        try {
            if ($employee->device_number == null) {
                $employee->update($request->validated());
            }

            $employee->load(['company', 'department', 'section', 'media', 'shift']);

            return EmployeeResource::make($employee)
                ->additional(['message' => 'Employee found successfully'])
                ->response()
                ->setStatusCode(200);

        } catch (Exception $e) {
            return response(['data' => null, 'message' => 'Something went wrong, please try again'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
