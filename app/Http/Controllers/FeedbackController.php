<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function index(){

        $records = Feedback::orderby('id','DESC')->paginate(10);
        return view("Feedback.index")->with("records", $records);
    }

    public function store(){
        Feedback::create([
            "name" => Request::get("name"),
            "title" => Request::get("title"),
            "content" => Request::get("content"),
        ]);
        return \Redirect::back()->with("message", "Successful feedback!");
    }

    public function edit($id){
        $record = Feedback::find($id);
        return view("Feedback.edit")->with("record",$record);
    }

    public function update($id){
        $record = Feedback::find($id);
        $record->name = Request::get("name");
        $record->title = Request::get("title");
        $record->content = Request::get("content");

        $record->save();
        return \Redirect::back()->with("message","編輯成功!");
    }

    public function destroy($id){
        Feedback::destroy($id);
        return \Redirect::back()->with("message","刪除成功");
    }
}
