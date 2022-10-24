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
    public function index()
    {
        
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

        $employee = Employee::create($data);

        $token = $employee->createToken('apitoken');

        return response()->json([
            'employees' => $employee,
            'token' => $token->plainTextToken
        ]);
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

        if ($data['password']) {
            $data['password'] = bcrypt($data['password']);
        }

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
        $employee->delete();

        return response()->noContent();
    }
}
