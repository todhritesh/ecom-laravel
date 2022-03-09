<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<nav class="p-3 navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container">
        <a href="#" class="navbar-brand">Manage Users</a>
        <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="{{route('logout')}}">Logout</a>
            </li>
          </ul>
    </div>

</nav>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 mx-auto table-responsive">
            <table class="table table-toggle">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Registred</th>
                    <th>Change Role</th>
                </tr>
                @foreach ($users as $u)
                <tr>
                    <td>{{$u->name}}</td>
                    <td>{{$u->email}}</td>
                    <td>{{$u->role}}</td>
                    <td>{{ \Carbon\Carbon::parse($u->created_at)->diffForHumans()}}</td>
                    <td>
                        <form action="{{route('manageUsers')}}" method="post">
                            <input name='userId' type="text" hidden value={{$u->id}}>
                            <button class='btn btn-success'>@php
                               echo  $u->role==='user' ? 'Retailer' : "User"
                            @endphp</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
</body>
</html>
