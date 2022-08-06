<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Request;
use DB;
// use Session;
use App\Models\Feedback;
use App\Models\AccountInfo;

class FeedbackController extends Controller
{
    public function index(){
        if(!session()->exists("user_name")){
            return redirect("/loginpage")->with("warning","請先登入");
        }
        $user_name = session("user_name");
        $records = Feedback::orderby('id','DESC')->paginate(10);
        return view("Feedback.index")->with("records", $records)->with("user_name",$user_name);
    }

    public function store(){
        $user_name = session("user_name");
        $content_str = Request::get("content");
        if(strpos($content_str, ";") || stripos($content_str, "<script>")!==false){
            $user = AccountInfo::where("user_name",$user_name)->first();
            $user->violate_count +=1;
            $user->save();
            if($user->violate_count>=3){
                session()->forget("user_name");
                return redirect("/loginpage")->with("warning","違規留言三次以上，您的帳號已遭停權");
            }
            return \Redirect::back()->with("alert","禁止輸入違規語句, 違規三次您的帳號將遭停權");
        }
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
        $record->user_name = session("user_name");
        $record->title = Request::get("title");
        $record->content = Request::get("content");
        if(strpos($record->content, ";") || stripos($record->content, "<script>")!==false){
            $user = AccountInfo::where("user_name",$record->user_name)->first();
            $user->violate_count +=1;
            $user->save();
            if($user->violate_count>=3){
                session()->forget("user_name");
                return redirect("/loginpage")->with("warning","違規留言三次以上，您的帳號已遭停權");
            }
            return \Redirect::back()->with("alert","禁止輸入違規語句, 違規三次您的帳號將遭停權");
        }
        $record->save();
        return redirect("/")->with("message","編輯成功");
        // return \Redirect::back()->with("message","編輯成功!");
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
