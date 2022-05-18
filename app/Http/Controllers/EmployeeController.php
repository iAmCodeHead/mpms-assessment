<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Practice;
use DB;
use UnexpectedValueException;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = DB::table('employees')->select('employees.*', 'practices.name as practice_name')
                    ->leftJoin('practices', 'practices.id', 'employees.practice_id')
                    ->paginate(10);

        return view('employee.index', compact('employees'));
        // return response()->json(['status' => true, 'message' => 'Operation successful','data' => $employees]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $practices = Practice::all();
        return view('employee.create', compact('practices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'practice_id' => 'required',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|numeric',
        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation);
        }

        $practiceExists = Practice::find($request->practice_id);

        // if(!$practiceExists) throw new UnexpectedValueException('Practice does not exist');
        if(!$practiceExists) return back()->withError('Practice does not exist');

         $employee = Employee::create($request->all());

         if($employee){
            return redirect()->route('employee.index')->withSuccess('Operation Successful');
        }
        return redirect()->back()->withError('Unable to create employee');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        $employee = Employee::where('id', $request->id)->first();
        return response()->json($employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $employee = Employee::find($id);
         $practices = Practice::all();
        return view('employee.edit', compact('employee','practices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'practice_id' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation);
        }

        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'practice_id' => $request->practice_id,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

         $employee = Employee::where('id', $request->id)->update($data);

            return redirect()->back()->withSuccess('Operation Successful');
       

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        Employee::destroy($id);
        return redirect()->back()->withSuccess('Operation Successful');
    }
}
