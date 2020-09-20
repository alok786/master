<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

use function GuzzleHttp\json_decode;

class DataController extends Controller
{
    //
    public function getUserAjaxDatatable(Request $request){
        
        $users = DB::table('user')->get();
        $users = json_decode(json_encode($users),true);
        $userCollection = new Collection();

        foreach ($users as $key => $user) {
            $userimagePath =  empty($user['image'])?"/uploads/images/default.png":$user['image'];

            $userCollection->push([
                'checkbox' => '<input type="checkbox" data-id="'.$user['id'].'" class="deleterow" >',
                'name' => '<span id="editname'.$user['id'].'">'.$user['name'].'</span>',
                'phone' => '<span id="editphone'.$user['id'].'">'.$user['phone'].'</span>',
                'hobbies' =>   '<span id="edithobbies'.$user['id'].'">'.$user['hobbies'].'</span>',
                'category' =>  '<span id="editcategory'.$user['id'].'">'. $user['category'].'</span>',
              
                'image' => '<img id="image'.$user['id'].'" src="/'.$userimagePath.'" style="height:100px;width:100px;border-radius:50%">',
                'action' => '<button class="btn btn-outline-primary edit"  id="edit" data-id="'.$user['id'].'">Edit</button>
                            <button class="btn btn-outline-success" id="save" data-id="'.$user['id'].'" style="display:none">save</button>
                            <button class="btn btn-outline-danger delete" id="delete" data-id="'.$user['id'].'">Delete</button>
                            '
            ]);


        }
        return DataTables::of($userCollection)->rawColumns(['checkbox','name','phone','hobbies','category','image','action'])->make(true);

    }

    public function userEdit(Request $request){
        
       
        $data = [];
        if($request->hasFile('file')){
            $path = 'UserImage';
            $file =  $request->file('file');
            $file_name = $file->getClientOriginalName();
            $imagepath = $path.'/'.time().'_'.$file_name;
            $file->move(public_path($path), time().'_'.$file_name);
            $data['image'] = $imagepath;
        }
        $data['name'] = $request->get('name');
        $data['phone'] = $request->get('contact_number');
        if($request->get('hobbies')!= null)
        $data['hobbies'] = $request->get('hobbies');
        if($request->get('category')!=null)
        $data['category'] = $request->get('category');
        $update = DB::table('user')->where('id',$request->get('id'))->update($data);
        if($update){
            return response()->json(['status'=>200,'message'=>'User has been updated successfully.']);
        }else{
            return response()->json(['status'=>500,'message'=>'Something wrong while updating user.']);

        }
    }

    public function userDelete(Request $request){
       $rowId =  $request->all()['row_id'];
       $query = DB::table('user');
        
       if(is_array($rowId)){
        $query->whereIn('id',$rowId);
       }else{
        $query->where('id',$rowId);
       }
       $status = $query->delete();
       if($status){
        return response()->json(['status'=>200,'message'=>'Row has been deleted successfully.']);
        }else{
            return response()->json(['status'=>500,'message'=>'Something wrong while updating user.']);

        }
    }
}
