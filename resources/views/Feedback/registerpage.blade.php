<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- use boostrap5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        
        <title>留言板系統</title>
</head>

<body>
    <div class="container">
        <h2 class="text-center">留言板系統</h2>
        <h3><small class="text-muted">註冊介面</small></h3>
        @if(Session::has("message"))
            <div class = "alert alert-success" role="alert">{{ Session::get("message") }}</div>
        @endif
        <br>
        <form action = " {{ route('register') }} " method="post">
            @csrf
            <div class = "mb-3">
                <label for="user_name" class="form-label">User Name</label>
                <input type = "user_name" class="form-control" name="user_name" id="user_name" placeholder="please enter your user name">
            </div>
            <div class = "mb-3">
                <label for="password" class="form-label">Password</label>
                <input type = "password" class="form-control" name="password" id="password" placeholder="please enter your password">
            </div>
            <br>
            <button type="submit" class="btn btn-primary">註冊</button>
            <br><br>
            <small class="text-muted">已有帳號?   </small>
            <button type="button" class="btn btn-warning"><a href = "{{ route('loginpage') }}">登入</a></button>
        </form>
    </div>


</body>





</html>