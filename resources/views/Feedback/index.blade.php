<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>留言板系統</title>
        
        <!-- use boostrap5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <style>
            .pagination{
                float: right;
                margin-top: 10px;
            }
        </style>
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

            <h2 class="text-center">留言板</h2>
            @if(Session::has("message"))
            <div class = "alert alert-success" role="alert">{{ Session::get("message") }}</div>
            @endif
            
            @if(Session::has("alert"))
            <script>
                alert("{{ session()->get('alert') }}");
            </script>
            @endif
            <br>
            <!-- <span class="badge bg-light text-dark">使用者名稱: {{ $user_name }}</span> -->
            <figure class="text-end">
                <blockquote class="blockquote">
                    <p class="text-end">使用者: {{ $user_name }}</p>
                </blockquote>
            </figure>
            <form action="{{ route('store') }}" method="post">
                @csrf
                <div class="form-group">
                    <!-- <label for="title">留言標題</label> -->
                    <textarea class="form-control" name="content" rows="5" placeholder="在這裡輸入您的留言" required></textarea>

                </div>
            <br>
            <button type="submit" class="btn btn-secondary">提交</button>
            </form>
            <h4>已經有留言({{ $records->total() }} 條)</h4>
            <br>
            <table class="table table-bordered">
                <thead>
                        <tr>
                            <th width="10">ID</th>
                            <th width="80">留言者</th>
                            <!-- <th width="150">標題</th> -->
                            <th>內容</th>
                            <th width="100">留言時間</th>
                            <th width="100">操作</th>
                        </tr>
                </thead>
                <tbody>
                @forelse($records as $record)
                    <tr>
                        <td>{{ $record->id }}</td>
                        <td>{{ $record->user_name }}</td>
                        <!-- <td>{{ $record->title }}</td> -->
                        <td>{{ $record->content }}</td>
                        <td>{{ $record->created_at }}</td>
                        <td>
                            <a href="{{ route('edit', $record->id) }}" class="btn btn-primary">編輯</a>
                            <form action="{{ route('destroy' , $record->id )}}" method="post">
                                @csrf
                                @method("delete")
                                <button type="submit" class="btn btn-danger" onclick="return confirm('確認刪除?')">刪除</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="100" class="text-center">暫無留言</td>
                    </tr>

                @endforelse
                </tbody>
            </table>
            {{ $records->links() }}
        </div>
    </body>
</html>
