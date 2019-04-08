<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <h1>登录</h1>

        <table>
            <tr>
                <td>账号：<input type="text" name="u_name"></td>
            </tr>
            <tr>
                <td>密码：<input type="password" name="u_pwd"></td>
                <input type="hidden" value="{{$redirect}}" name="redirect">
            </tr>
        
        </table>
        <button  type="submit"> 登录</button>
    </form>
</body>
</html>