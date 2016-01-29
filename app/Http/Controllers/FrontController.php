<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Mail;
use View;
use App\Tag;
use App\History;
use App\Product;
use App\Category;
use App\Customer;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class FrontController extends Controller
{
    protected $paginate = 5;

    public function __construct()
    {
        View::composer('partials.nav', function($view) // composer(): méthode de l'objet View; injecter des données dans un template
        {
            $categories = Category::lists('title', 'id');  // retourner une collection qui contient un tableau avec id et title
            //dd($categories);

            $view->with(compact('categories'));  // with(): injecter des catégories dans $view
        });
    }

    public function index(Request $request)
    {
        //$products = Product::paginate(5);

        //                         trois noms de relation dans Product.php
        $products = Product::with('tags', 'category', 'picture')
                             ->online()
                             ->orderBy('published_at', 'desc')
                             ->paginate($this->paginate);

        $lastPage = $products->lastPage();



        $title = "Welcome Home Page";

        if ($request->ajax()) {
            return response()->json([
                'html' => view('front.blocProd', ['products' => $products, 'lastPage' => $lastPage, 'title' => $title])->render()
            ]);
        }

        return view('front.index', compact('products', 'lastPage', 'title'));  // compact('products'): créer un tableau associatif à partir de la variable $products(ligne 15), égaler à ['products' => $products]
    }

    public function showProductByCategory($id, $slug='')    // $slug='' => optionnel
    {
        $category = Category::findOrFail($id);
        $products = $category->products()->with('tags', 'picture')->paginate($this->paginate);;

        $title = "Category {$category->title}";
        return view('front.category', compact('products', 'title'));
    }

    public function showProductByTag($id, $slug='')
    {
        $tag = Tag::findOrFail($id);
        $products = $tag->products()->with('category', 'picture')->paginate($this->paginate);;

        $title = "Tag {$tag->name}";
        return view('front.tag', compact('products', 'tag', 'title'));
    }

    public function showProduct($id, $slug='')
    {
        /*try {

            $product = Product::findOrFail($id);

        } catch (\Exception $e) {

            //dd($e->getMessage());  // dd: var_dump customisé + die

            return view('front.noProduct');
        }*/

        $bests = Product::orderBy('score', 'desc')->orderBy('price', 'desc')->take(4)->get();
        //dd($bests);

        $product = Product::findOrFail($id);  // fondOrFail(): si on met un id qui n'existe pas(ex: 1000), on aura la page 404

        $title = "Product {$product->name}";
        return view('front.prod', compact('product', 'bests', 'title', 'customer_id'));
    }

    public function showContact()
    {
        $title = "Contact";
        return view('front.contact', compact('title'));
    }

    public function storeContact(Request $request)
    {
        /*var_dump($_POST);
        dd($request->all());*/

        // $request->all(): toutes les données du formulaire
        /*$validator = Validator::make($request->all(), [
            'email' => 'required|email',  // 'field du formulaire' => 'champ_obligatoire|syntaxe d'email'
            'content' => 'required|max:200'
        ]);*/

        //if ($validator->fails())  return back()->withInput()->withErrors($validator);  // withInput(): remettre le texte dans le champ; withErrors(): afficher les erreurs

        $this->validate($request, [             // $this: FrontController
            'email' => 'required|email',
            'content' => 'required|max:255'
        ]);

        // récupérer le message saisi par le client
        $content = $request->input('content');
        //                                    content: c'est $content qui est dans emails\contact.blade.php
        Mail::send('emails.contact', compact('content'), function($m) use($request){
            $m->from($request->input('email'), 'Client');     // $request->input('email'): récupérer l'email saisi par le client
            $m->to(env('EMAIL_TECH'), 'admin')->subject('Contact e-boutique');  // Il envoie un mail à EMAIL_TECH que en prod non en dev
        });

        // on peut faire aussi return redirect('contact')->with(); back() égale à redirect('contact')
        // with(): Laravel met tous ce qui sont dans with() dans l'objet Session, donc tous qui sont dans with() sont les variables de la session
        return back()->with([
            'message' => trans('app.contactSuccess'),
            'alert'   => 'success'      // css pour les différentes alertes de nos messages
        ]);
        // Laravel fait supprimer automatiquement les variables de la session une fois qu'on quitte ou rafraîchir la page contact

        // méthode with sur la redirection est équivalent à, en PHP natif:
        //session_start();
        //$_SESSION['laravel']['message'] = trans('app.contactSuccess');
        //$_SESSION['laravel']['alert'] = 'success';
    }

    public function mentions(){
        $title = "Mentions";
        return view('front.mention', compact('title'));
    }

    public function account()
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $customer = $user->customer;
//        $histories = $customer->histories->paginate($this->paginate);
        $histories = History::where('customer_id', $customer->id)->orderBy('command_id', 'desc')->paginate(10);

        $title = "My account";
        return view('front.account', compact('user', 'customer', 'histories', 'title'));
    }

    public function storeCart(Request $request)
    {
        if(Session::has('cart')) {
            $cart = Session::get('cart');
        } else {
            $cart = [];
        }

        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');
        $cart[$product_id] = $quantity;
        //dd($cart);

        Session::put('cart', $cart);
        //dd(Session::get('cart');

        return redirect('/')->with([
            'message' => trans('app.commandSuccess'),
            'alert'   => 'success'
        ]);
    }

    public function showCart()
    {
        $carts = $this->productCart();
        $total = $this->totalPrice();

        $title = "Cart";
        return view('front.cart', compact('carts', 'total', 'title'));
    }

    public function removeCart($id)
    {
        if(Session::has('cart')) {
            $cart = Session::get('cart');
            //dd($cart);
            unset($cart[$id]);
            Session::put('cart', $cart);
            //dd($cart);
        }

        if(!empty($cart)) {
            return redirect('cart')->with([
                'message' => trans('app.removeSuccess'),
                'alert'   => 'success'
            ]);
        } else {
            Session::forget('cart');
            return redirect('cart')->with([
                'messageEmpty' => trans('app.emptyCart'),
                'alert'   => 'success'
            ]);
        }
    }

    public function validateCart()
    {
        $carts = $this->productCart();
        $total = $this->totalPrice();

        $title = "Confirm your cart";
        return view('front.confirm', compact('carts', 'total', 'title'));
    }

    public function confirmCart()
    {
        $command_id = History::all()->max('command_id');
        $command_id++;
        //dd($command_id);

        if(Session::has('cart')) {
            $cart = Session::get('cart');
            //dd($cart);
            foreach($cart as $id => $quantity) {
                $product = Product::find($id);

                $command = [
                    'command_id'     => $command_id,
                    'product_id'     => $id,
                    'customer_id'    => Auth::user()->id,
                    'price'          => $product->price*$quantity,
                    'quantity'       => (int)$quantity,
                    'command_at'     => date('Y-m-d H:i:s'),
                    'status'         => 'unfinalized',
                ];
                //dd($command);

                History::create($command);

                $product->score++;
                $product->quantity-=$quantity ;
                $product->save();
            }
        }

        Session::forget('cart');

        $customer = Customer::find(Auth::user()->id);
        $customer->increment('number_command');

        return redirect('/')->with([
            'message' => trans('app.finishSuccess'),
            'alert'   => 'success'
        ]);

    }



    /*
     * Mettre à jour les quantités et les prix dans la page pannier
     */
    public function updateQuantity(Request $request)
    {
        // récupérer les valeurs envoyées via POST par ajax
        $product_id = $request->product_id;
        $quantity = $request->quantity;

        if(Session::has('cart')) {
            $cart = Session::get('cart');

            $product = Product::find($product_id);
            $price = $product->price*$quantity;

            $cart[$product_id] = $quantity;

            Session::put('cart', $cart);
        }

        $total = $this->totalPrice();

        return response()->json([
            'product_id' => $product_id,
//            'quantity'   => $quantity,
            'price'      => $price,
            'total'      => $total,
        ]);
    }


    /*
     * Récupérer les détails de chaque produit qui se trouve dans la session
     */
    private function productCart()
    {
        if(Session::has('cart')) {
            $cart = Session::get('cart');
            //dd($cart);
            foreach($cart as $id => $quantity) {
                $product = Product::find($id);
                $carts[] = [
                    'id'             => $product->id,
                    'picture'        => $product->picture->uri,
                    'name'           => $product->name,
                    'slug'           => $product->slug,
                    'quantity'       => $quantity,
                    'total_quantity' => $product->quantity,
                    'price'          => $product->price,
                    'total_price'    => $product->price*$quantity,
                ];
            }
        } else {
            $carts = [];
        }
        //dd($carts);

        return $carts;
    }


    /*
     * Calculer le prix total du pannier
     */
    private function totalPrice()
    {
        if(Session::has('cart')) {
            $cart = Session::get('cart');
            $total = 0;
            foreach($cart as $id => $quantity) {
                $product = Product::find($id);
                $total += $product->price*$quantity;
            }
        } else {
            $total = 0;
        }
        //dd($total);

        return $total;
    }
}