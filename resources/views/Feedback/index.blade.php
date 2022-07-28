<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>留言板系統</title>
        <link rel="shortcut icon" type="image/x-icon" href="https://img.malajiang.com/assets/web/img/favicon.png"/>
        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
        <link rel="stylesheet" href="plugins/bootstrap.css"> <!--宣告 CSS-->
        <script src="plugins/bootstrap.bundle.min.js"></script> <!--宣告 JS-->
    </head>
    <body>
        <div class="container">
            <h2 class="text-center">留言板系統</h2>
            @if(Session::has("message"))
            <div class = "alert alert-success" role="alert">{{ Session::get("message") }}</div>
            @endif
            <br>
            <form action="{{ route('store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="title">留言標題</label>
                    <textarea class="form-control" name="content" rows="5" placeholder="在這裡輸入您的留言"></textarea>

                </div>
            <br>
            <button type="submit" class="btn btn-default">提交</button>
            </form>
            <h4>已經有留言({{ $records->total() }} 條)</h4>
            <br>
            <table class="table table-bordered">
                <thead>
                    <!-- <tbody> -->
                        <tr>
                            <th width="10">ID</th>
                            <th width="80">留言者</th>
                            <th width="150">標題</th>
                            <th>內容</th>
                            <th width="100">留言時間</th>
                            <th width="100">操作</th>
                        </tr>
                </thead>
                <tbody>
                @forelse($records as $record)
                    <tr>
                        <td>{{ $record->id }}</td>
                        <td>{{ $record->name }}</td>
                        <td>{{ $record->title }}</td>
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
                        <!-- <td></td> -->
                    </tr>
                    @empty
                    <tr>
                        <td colspan="100" class="text-center">暫無留言</td>
                    </tr>

                @endforelse
                </tbody>
                <!-- </thead> -->
            </table>
            {{ $records->links() }}
        </div>
    </body>
</html>
