<?php

namespace App\Http\Controllers;


use Auth;
use View;
use App\Category;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class LoginController extends Controller
{
    public function __construct()
    {
        View::composer('partials.nav', function($view) // composer(): méthode de l'objet View; injecter des données dans un template
        {
            $categories = Category::lists('title', 'id');  // retourner une collection qui contient un tableau avec id et title
            //dd($categories);

            $view->with(compact('categories'));  // with(): injecter des catégories dans $view
        });
    }

    public function login(Request $request)
    {
        if($request->isMethod('post'))
        {
            //dd($request->all());

            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required',
                'remember' => 'in:true',  // in:true => le string reçu dans 'remember' doit être 'true'
            ]);

            $remember = !empty($request->input('remember')) ? true : false;
            if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $remember))
            {
                $user = Auth::user();
                if($user->role == 'administrator' || $user->role == 'editor')
                {
                    return redirect()->intended('product');
                } else
                {
                    return redirect()->intended('/');
                }
            } else
            {
                return back()->withInput($request->only('email', 'remember'))->with([
                    'message' => trans('app.noAuth'),
                    'alert'   => 'warning'
                ]);
            }
        } else
        {
            $title = 'Login';
            return view('auth.login', compact('title'));
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
        //return redirect()->home();
    }
}