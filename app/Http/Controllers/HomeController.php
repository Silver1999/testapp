<?php

namespace App\Http\Controllers;

use App\Permission;
use App\User;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function report()
    {
        if (auth()->check() && auth()->user()->hasPermissionTo('report-section')) {
            $haspermission = 1;
        } else {
            $haspermission = 0;
        }

        return view('pages.report')->with('haspermission', $haspermission);
    }

    public function config()
    {
        if (auth()->check() && auth()->user()->hasPermissionTo('config-section')) {
            $haspermission = 1;
        } else {
            $haspermission = 0;
        }
        return view('pages.config')->with('haspermission', $haspermission);
    }
    public  function  create(Request $request){
        $request->validate([
            'name' => 'required',
            'password' => 'required|min:8',
            'email'=>'required|email|unique:users',
            'option'=>'required'
        ] ) ;
        if ($request->option=='employer'){
            $employer = Permission::where('slug','report-section')->first();
            $user1=User::create(['name'=>$request->name,'password'=>bcrypt($request['password']),'email'=>$request->email]);
            $user1->permissions()->attach($employer);
            return redirect()->back()->with('success', 'User with employer permission was successfully created,now you can log-out and login as this user');
        }
        if ($request->option=='admin'){
            $admin = Permission::where('slug','config-section')->first();
            $user2=User::create(['name'=>$request->name,'password'=>bcrypt($request['password']),'email'=>$request->email]);
            $user2->permissions()->attach($admin);
            return redirect()->back()->with('success', 'User with admin permission was successfully created,now you can log-out and login as this user');
        }



    }
}
