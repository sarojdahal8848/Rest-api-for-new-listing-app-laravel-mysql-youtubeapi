<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index()
    {
        $data = Setting::all();
        return response(['message'=>'success','data'=>$data],200);
    }
    
    public function show($id)
    {
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'app_name'=>'required|string',
            'rate_us_link'=>'required|string',
            'share_link'=>'required|string',
            'share_subject'=>'required|string',
            'image_url'=>'required|string',
            'privacy_policy_link'=>'required|string',
            'terms_condition_link'=>'required|string',
            'disclaimer_link'=>'required|string'
        
        ]);
        // return $request;
        if(count(Setting::all())>=1){
            return response(['error'=>'settings data already present']);
        }
        $request['user_id']=auth()->id();
        $setting = Setting::create($request->toArray());
        return response(['message'=>'success','data'=>$setting],201);
    }

    public function update(Request $request, $id)
    {
        $item = Setting::where('id',$id)->first();
        $user_id =Auth::id();
        
        if($user_id!=$item['user_id']){
            return response(['error'=>'you are not permitted']);
        }
        // return $request->all();
        
        // ['app_name'=>$request['app_name'],'rate_us_link'=>$request['rate_us_link'],'share_link'=>$request['share_link'],'share_subject'=>$request['share_subject'],'image_url'=>$request['app_name'],'privacy_policy_link'=>$request['privacy_policy_link'],'terms_condition_link'=>$request['terms_condition_link'],'disclaimer_link'=>$request['disclaimer_link'],]
        Setting::where('id',$id)->update($request->all());
        $update =Setting::all();

        return response(['message'=>'success updated','data'=>$update],201);
        
    }

    public function delete(Request $request, $id)
    {
        
    }
}

