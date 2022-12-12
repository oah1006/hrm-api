<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Employee\CreateEmployeeRequest;
use App\Http\Requests\Admin\Employee\UpdateEmployeeRequest;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $employees = Employee::query();

        if ($request->filled('keywords')) {
            $q = $request->keywords;

            $employees->where(function($query) use ($q) {
                $query->where('first_name', 'like', '%' . $q . '%')
                    ->orWhere('last_name', 'like', '%' . $q . '%')
                    ->orWhere('email', 'like', '%' . $q . '%')
                    ->orWhere('phone_number', '%' . $q . '%')
                    ->orWhere('birth_date', 'like', '%' . $q . '%');
            });
        }

        if ($request->filled('gender')) {
            $gender = $request->gender;

            $employees->where('gender', $gender);
        }

        if ($request->filled('role')) {
            $role = $request->role;

            $employees->where('role', $role);
        }

        if ($request->filled('department_id')) {
            $departmentId = $request->department_id;

            $employees->where('department_id', $departmentId);
        }

        $employees = $employees->paginate(10);

        return response()->json($employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateEmployeeRequest $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEmployeeRequest $request)
    {
        $data = $request->validated();

        $data['password'] = bcrypt($data['password']);

        if (auth()->user()->role == 'admin') {
            $employee = Employee::create($data);
            $token = $employee->createToken('apitoken');

            return response()->json([
                'employees' => $employee,
                'token' => $token->plainTextToken
            ]);
        }

        return response()->json(['message' => 'You don\'t have permission to create this employee!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $data = $request->validated();

        $employee->update($data);

        return response()->json([
            'employee' => $employee
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);

        if (auth()->user()->role == 'admin') {
            $employee->delete();
            return response()->json(['message', 'Delete employee successfully!']);
        }

        return response()->json(['message', 'You don\'t have permission to delete this employee!']);
    }
}
