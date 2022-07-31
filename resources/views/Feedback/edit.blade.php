<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- use boostrap5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <title>留言版系統</title>


    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <h2 class="navbar-brand" href="/">留言板系統</h2>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('index') }}">首頁</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('registerpage') }}">註冊</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('logout') }}">登出</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <h4 class = "text-center">編輯留言</h4>
            <br>
            <form action="{{ route('update', $record->id ) }}" method="post">
                @csrf
                @method("put")
                <div class="form-group">
                    <label for="name">使用者</label>
                    <div class="alert alert-info" role="alert">
                        {{ Session::get("user_name") }}
                    </div>
                </div>
                
                <!-- <div class="form-group">
                    <label for="title">留言標題</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="請輸入您的留言標題" value="{{ $record->title }}">
                </div> -->

                <div class="form-group">
                    <label for="content">留言內容</label>
                    <textarea class="form-control" name="content" rows="5" placeholder="在這裡輸入您的留言內容">{{ $record->content }}</textarea>
                </div>
                <br>
                <button type="submit" class="btn btn-secondary">提交</button>
            </form>
        </div>
    </body>
</html>