<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>编辑留言</title>


    </head>
    <body>
        <div class="container">
            <h4>編輯留言 <a href="{{ route('index') }}">返回留言</a></h4>
            @if(Session::has("message"))
            <div class="alert alert-success" role="alert">{{ Session::get("message") }}</div>
            @endif
            <br>
            <form action="{{ route('update', $record->id ) }}" method="post">
                @csrf
                @method("put")
                <div class="form-group">
                    <label for="name">您的姓名</label>
                    <input type="text" name="name" class="form-control form-inline" id="name" placeholder="請輸入您的姓名" value="{{ $record->name }}">
                </div>
                
                <div class="form-group">
                    <label for="title">留言標題</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="請輸入您的留言標題" value="{{ $record->title }}">
                </div>

                <div class="form-group">
                    <label for="content">留言內容</label>
                    <textarea class="form-control" name="content" rows="5" placeholder="在這裡輸入您的留言內容">{{ $record->content }}</textarea>
                </div>
                <br>
                <button type="submit" class="btn btn-default">提交</button>
            </form>
        </div>
    </body>
</html>