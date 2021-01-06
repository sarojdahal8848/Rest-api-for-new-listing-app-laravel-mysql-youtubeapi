<?php

namespace App\Http\Controllers;

use App\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Constraint\Count;

class MediaController extends Controller
{
    public function index()
    {
        $media= Media::all();
        return response(['message'=>'sucess','data'=>$media]);
    }
 
    public function show($id)
    {
        $media = Media::find($id);
        return response()->json($media, 200);
    }

    public function store(Request $request)
    {
        // $user_id = Auth::id();
            $request->validate([
                'name'=>'required|string|unique:media',
                'image_url'=>'required|string',
                'type'=>'required|string',
                // 'user_id'=>auth()->id()
            ]);
            $request['user_id']=auth()->id();
            $media = Media::create($request->toArray());
            return response()->json($media, 201);
    }

    public function update(Request $request, $id)
    {
        $item = Media::where('id',$id)->first();
        $user_id =Auth::id();
        // if($request['name']!=$item['name']){
        //     $validatedData=$request->validate([
        //         'name'=>'required|string|unique:categories',
        //         'image_url'=>'required|string',
        //         'type'=>'required'
        //     ]);
        // }
        if($user_id!=$item['user_id']){
            return response(['error'=>'you are not permitted']);
        }
        
        Media::where('id',$id)->update(['name'=>$request['name'],'image_url'=>$request['image_url'],'type'=>$request['type']]);
        $update =Media::all();

        return response(['message'=>'success','data'=>$update],201);
    }

    public function delete(Request $request, $id)
    {
        $item = Media::where('id',$id)->first();
        $user_id =Auth::id();
        if($user_id!=$item['user_id']){
            return response(['error'=>'you are not permitted']);
        }
        $delete = Media::findOrFail($id);
        $delete->delete();

        return response(['message'=>$delete],204);
    }

    public function national(){
        return DB::select('select * from media where type = ?', ['National']);
    }
    public function regional(){
        return DB::select('select * from media where type = ?', ['Regional']);
    }
}
