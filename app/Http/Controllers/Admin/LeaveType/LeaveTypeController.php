<?php

namespace App\Http\Controllers\Admin\LeaveType;

use App\Models\LeaveType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LeaveType\CreateLeaveTypeRequest;
use App\Http\Requests\Admin\LeaveType\UpdateLeaveTypeRequest;

class LeaveTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $leaveTypes = LeaveType::query();   
        if ($request->filled('keywords')) {
            $q = $request->keywords;

            $leaveTypes->where(function ($query) use ($q) {
                $query->where('type_name', 'like', '%' . $q . '%');
            });
        }

        $leaveTypes = $leaveTypes->paginate(4);

        return response()->json($leaveTypes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateLeaveTypeRequest $request)
    {   
        $data = $request->validated();

        $leaveType = LeaveType::create($data);
        
        return response()->json([
            'message' => 'Create type of leave sucessfully!',
            'leaveType' => $leaveType
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLeaveTypeRequest $request, $id)
    {
        $leaveType = LeaveType::findOrFail($id);

        $leaveType->update($request->validated());

        return response()->json([
            'message' => 'Update type of leave successfully!',
            'leaveType' => $leaveType
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
        $leaveType = LeaveType::findOrFail($id);

        $leaveType->delete();

        return response()->noContent();
    }
}
