<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index($id)
    {
        return DB::select('select Distinct id,media_id,title,news_url from categories where media_id = ?', [$id]);
        // $category = DB::table('categories')->where('media_id',1);
        // return $category;
    }
    
    public function show($id)
    {
        $category = Category::find($id);
        return response()->json($category, 200);
    }

    public function store(Request $request)
    {
        // $title = $request['title'];
        // $row = DB::select('select * from categories where title = ?', [$title]);
        // if(Count($row)<1){
        //     $category = Category::create($request->all());
        // }else{
        //     $category = "Category Already Exists";
        // }
        // return response()->json($category, 201);
        // $user_id = Auth::id();
        $request->validate([
            'title'=>'required|string',
            'news_url'=>'required|string',
            'media_id'=>'required',
            // 'user_id'=>auth()->id()
        ]);
        $request['user_id']=auth()->id();
        $category = Category::create($request->toArray());
        return Response(['message'=>'success','data'=>$category,],201);
    }

    public function update(Request $request, $id)
    {

        $item = Category::where('id',$id)->first();
        $user_id =Auth::id();
        if($request['title']!=$item['title']){
            $validatedData=$request->validate([
                'title'=>'required|string',
                'news_url'=>'required|string',
                'media_id'=>'required'
            ]);
        }
        if($user_id!=$item['user_id']){
            return response(['error'=>'you are not permitted']);
        }
        if($request['media_id']!=$item['media_id']){
            return response(['error'=>'you are not allowed to touch this category category']);
        }
        
        Category::where('id',$id)->update(['title'=>$request['title'],'news_url'=>$request['news_url']]);
        $category =Category::find($id);

        return response(['message'=>'success','data'=>$category],201);
    }

    public function delete(Request $request, $id)
    {
        $item = Category::where('id',$id)->first();
        $user_id =Auth::id();
        if($user_id!=$item['user_id']){
            return response(['error'=>'you are not permitted']);
        }
        
        $category = Category::findOrFail($id);
        $category->delete();

        return 204;
    }
}
