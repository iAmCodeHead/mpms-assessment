<?php

namespace App\Http\Controllers;

use App\Models\FieldsOfPractice;
use App\Models\Practice;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FieldPracticeController extends Controller
{
    public function fields()
    {
        $practices = DB::table('fields_of_practices')->select('fields_of_practices.*', 'fields_of_practices.name as practice_name')
                    ->leftJoin('practices', 'practices.id', 'fields_of_practices.practice_id')
                    ->paginate(2);

        return view('field_practice.index', compact('practices'));

    }

       /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $practices = Practice::all();
        return view('field_practice.create', compact('practices'));
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
            'name' => 'required|string|unique:fields_of_practices,name',
            'practice_id' => 'required',
        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation);
        }

         $employee = DB::table('fields_of_practices')->insert([ 'name' => $request->name,
         'practice_id' => $request->practice_id,]);

         if($employee){
            return redirect()->route('field_practice.index')->withSuccess('Operation Successful');
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
        $practice = DB::table('fields_of_practices')->where('id', $request->id)->first();
        return response()->json($practice);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $f_practice = FieldsOfPractice::find($id);
         $practices = Practice::all();
        return view('field_practice.edit', compact('f_practice','practices'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * */

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string',
            'practice_id' => 'required',
        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation);
        }

         $f_practice = FieldsOfPractice::where('id', $request->id)->update([ 'name' => $request->name,
         'practice_id' => $request->practice_id,]);

         if($f_practice){
            return redirect()->back()->withSuccess('Operation Successful');
        }
        return redirect()->back()->withError('Error occured');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        FieldsOfPractice::destroy($id);
        return redirect()->back()->withSuccess('Operation Successful');
    }

}
