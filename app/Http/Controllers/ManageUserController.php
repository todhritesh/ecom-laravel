<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ManageUserController extends Controller
{
    function index(){
        $timeFormate = new  Carbon();
        $users = User::where('role','!=','admin')->get();
        return view('ManageUser',['users' => $users ]);
    }

    function changeRole(Request $req){
        $user = User::find($req->userId);
        $user->role = $user->role == 'user' ? 'retialer' : 'user';
        $user->save();
        return redirect()->route('manageUsers');
    }
}
