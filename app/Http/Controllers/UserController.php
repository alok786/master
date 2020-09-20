<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function GuzzleHttp\json_decode;
use DataTables;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        //
        $category = DB::table('category')->get();
        $category = json_decode(json_encode($category),true);

        return view('users',['category'=>$category]);
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
    public function store(Request $request)
    {
        //
        $imagepath = null;
        if($request->hasFile('file')){
            $path = 'UserImage';
            $file =  $request->file('file');
            $file_name = $file->getClientOriginalName();
            $imagepath = $path.'/'.time().'_'.$file_name;
            $file->move(public_path($path), time().'_'.$file_name);
        }
        

        $insert = DB::table('user')->insert([
            'name'=> $request->get('name'),
            'hobbies'=> $request->get('hobbies'),
            'category'=> $request->get('category'),
            'image'=> $imagepath,
            'phone'=> $request->get('contact_number')
        ]);
        if($insert){
            return response()->json(['status'=>200,'message'=>'User has been created successfully.']);
        }else{
            return response()->json(['status'=>500,'message'=>'Something wrong while creating user.']);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

   
}
