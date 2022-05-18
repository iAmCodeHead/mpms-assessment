<?php

namespace App\Http\Controllers;

use App\Models\Practice;
use DB;
use Illuminate\Http\Request;
use View;
use Illuminate\Support\Facades\Validator;

class PracticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $practices = Practice::paginate(10);
        
        return view('practices.index', compact('practices'));

        // return response()->json(['status' => true, 'message' => 'Operation successful', 'data' => $practices]);

    }


    /**
     * Display a listing of the resource for api.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function list()
    {
        $practices = Practice::all();
        
        return response()->json(['status' => true, 'message' => 'Operation successful', 'data' => $practices]);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('practices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|unique:practices,name',
            'email' => 'required|email',
            'logo' => 'required|image|dimensions:min_width=100,min_height=100',
            'url' => 'nullable|url'
        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation);
        }

        $data = ['name' => $request->name, 'email'=> $request->email , 'website_url'=>$request->url];

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path() . '/images';
            $file->move($destinationPath, $fileName);
            $data['logo'] = $fileName;
        }

        $practice = Practice::create($data);

        if($practice){
            return redirect()->route('practices.index')->withSuccess('Operation Successful');
        }
        return redirect()->back()->withError('Unable to create practice');

        // return response()->json(['status' => true, 'message' => 'Operation successful', 'data' => $practice]);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request, $id): \Illuminate\View\View
    {
        $practice = Practice::with('fields', 'employees')->find($request->id);

        // dd($practice);

        return view('practices.show', compact('practice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $practice = Practice::find($id);
        return view('practices.edit', compact('practice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'logo' => 'image|dimensions:min_width=100,min_height=100',
            'url' => 'nullable|url'
        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation);
        }

        $data = ['name' => $request->name, 'email'=> $request->email , 'website_url'=>$request->url];

        // return $request->id;

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path() . '/images';
            $file->move($destinationPath, $fileName);
            $data['logo'] = $fileName;
        }

        $practice = DB::table('practices')->where('id', $request->id)->update($data);

        
        return redirect()->back()->withSuccess('Operation Successful');
  

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        Practice::destroy($id);
        return redirect()->back()->withSuccess('Operation Successful');

    }

}
