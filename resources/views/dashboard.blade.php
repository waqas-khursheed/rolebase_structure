<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('') }}</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="{{ url('/') }}"><b></b></a>
    </div>
    <!-- /.login-logo -->
            <h1> WelCome To Custom Auth Dashboard</h1>

            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">id</th>
                    <th scope="col">NAme</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">{{$data->id}}</th>   
                    <td>{{$data->name}}</td>
                    <td>{{$data->email}}</td>
                    <td><a href="logout">Logout</a></td>
                    </tr>

                    </tr>
                </tbody>
            </table>

  
        </div>
        <!-- /.login-card-body -->
    </div>

</div>
<!-- /.login-box -->

<script src="{{ asset('js/app.js') }}" defer></script>

</body>
</html>
