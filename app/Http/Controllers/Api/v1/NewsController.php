<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\news;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function index_all()
    {
        $news = news::all();
        return $news;
    }
    public function destroy($id)
    {       
        $news = news::find($id);
        $news->delete();        
        return [
            'status' => true            
        ];

    }
    public function update(Request $request, $id)
    {
        if(strtotime($request->date_publish) > strtotime("now")){
            $publish = false;
        }else{
            $publish = true;
        }
        $news = news::find($id);
        $news->name = $request->name;
        $news->text = $request->text;
        $news->date_publish = strtotime($request->date_publish);        
        $news->publish = $publish;
        $news->save();
        return [
            'status' => true
        ];
    }
    public function index()
    {
        $news_no_pyblishs = news::where('publish','=', false)->get();        
        foreach($news_no_pyblishs as $news_no_pyblish){
            if($news_no_pyblish->date_publish <= strtotime("now")){
                $publish = true;
                $new = news::find($news_no_pyblish->id);
                $new->publish = $publish;               
                $new->save();
            }
        }
            
        $news = news::where('publish','=', true)->get();
        foreach($news as $new){  
            $user = User::where('id','=',$new->user_id)->get(['name']);
            $new->author=$user[0]['name'];
            $new->date_publish=date('d.m.y', $new->date_publish);
        }   
        return $news;
    }
    public function store(Request $request)
    {
        if(strtotime($request->date_publish) > strtotime("now")){
            $publish = false;
        }else{
            $publish = true;
        }
        $userId = User::find(Auth::user()->id);
        news::create([
            'name' => $request->name,
            'text' => $request->text,
            'date_publish' => strtotime($request->date_publish),
            'user_id'=>$userId->id,
            'publish'=>$publish
        ]);             
        return [
            'status' => true
        ];
    }
}
