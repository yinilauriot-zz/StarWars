<?php

namespace App\Http\Controllers;

use App\Customer;
use View;
use App\User;
use App\Category;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    public function __construct()
    {
        View::composer('partials.nav', function($view)
        {
            $categories = Category::lists('title', 'id');
            $view->with(compact('categories'));
        });
    }

    public function register()
    {
        $title = "Register";
        return view('auth.register', compact('title'));
    }

    public function storeUser(RegisterRequest $request)
    {
        $user = [
            'name'     => $request->input('name'),
            'email'    => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role'     => 'visitor'
        ];

        User::create($user);

        return redirect('login')->with([
            'message' => trans('app.registerSuccess'),
            'alert'   => 'success'
        ]);
    }

    public function customer()
    {
        $title = "Register customer information";
        return view('auth.registerCustomer', compact('title'));
    }

    public function storeCustomer(Request $request)
    {
        $this->validate($request, [
            'address' => 'required|max:200',
            'number_card' => 'required|numeric|digits:16',
        ]);

        $customer = [
            'user_id' => Auth::user()->id,
            'address' => $request->input('address'),
            'number_card' => $request->input('number_card'),
            'number_command' => 0
        ];

        Customer::create($customer);

        return redirect('validateCart')->with([
            'message' => trans('app.customerSuccess'),
            'alert'   => 'success'
        ]);
    }
}
