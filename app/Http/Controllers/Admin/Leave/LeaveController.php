<?php

namespace App\Http\Controllers\Admin\Leave;

use App\Models\Leave;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Leave\CreateLeaveRequest;
use App\Http\Requests\Admin\Leave\UpdateLeaveRequest;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $leaves = Leave::query();

        if ($request->filled('keywords')) {
            $q = $request->keywords;

            $leaves->where(function ($query) use ($q) {
                $query->where('start_day', 'like', '%' . $q . '%')
                    ->orWhere('end_day', 'like', '%' . $q . '%')
                    ->orWhere('reason', 'like', '%' . $q . '%');
            });
        }

        if ($request->filled('leave_type_id')) {
            $leaveTypeId = $request->leave_type_id;
            $leaves->where('leave_type_id', $leaveTypeId);
        }

        if ($request->filled('status')) {
            $status = $request->status;
            $status->where('status', $status);
        }

        $leaves = $leaves->paginate(8);

        return response()->json($leaves);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateLeaveRequest $request)
    {
        $data = $request->validated();

        $leave = Leave::create($data);

        return response()->json([
            'message' => 'Create leave successfully!!!',
            'leave' => $leave
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
    public function update(UpdateLeaveRequest $request, $id)
    {
        $leave = Leave::findOrFail($id);

        $leave->update($request->validated());

        return response()->json([
            'message' => 'Update leave successfully!!!',
            'leave' => $leave
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
        $leave = Leave::findOrFail($id);

        if (auth()->user()->role == 'admin') {
            $leave->delete();
        }

        return response()->noContent();
    }
}
