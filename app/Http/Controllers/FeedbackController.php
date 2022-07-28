<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Request;
use DB;
// use Session;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function index(){
        if(!session()->exists("user_name")){
            return view("Feedback.loginpage");
        }
        $user_name = session("user_name");
        $records = Feedback::orderby('id','DESC')->paginate(10);
        return view("Feedback.index")->with("records", $records)->with("user_name",$user_name);
    }

    public function store(){
        $user_name = session("user_name");
        Feedback::create([
            "user_name" => session("user_name"),
            "title" => Request::get("title"),
            "content" => Request::get("content"),
        ]);
        return \Redirect::back()->with("message", "留言成功");
    }

    public function edit($id){
        $user_name = session("user_name");
        $record = Feedback::find($id);
        if($user_name !== $record->user_name){
            return redirect()->back() ->with('alert', '禁止編輯其他使用者之留言');
        }
        return view("Feedback.edit")->with("record",$record);
    }

    public function update($id){
        $record = Feedback::find($id);
        $record->user_name = Request::get("user_name");
        $record->title = Request::get("title");
        $record->content = Request::get("content");

        $record->save();
        return \Redirect::back()->with("message","編輯成功!");
    }

    public function destroy($id){
        $user_name = session("user_name");
        $record = Feedback::find($id);
        if($user_name !== $record->user_name){
            return redirect()->back() ->with('alert', '禁止刪除其他使用者之留言');
        }
        Feedback::destroy($id);
        return \Redirect::back()->with("message","刪除成功");
    }

    
}
