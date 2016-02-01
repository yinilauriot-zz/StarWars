<?php

namespace App\Http\Controllers;

use Auth;
use Mail;
use View;
use App\Tag;
use App\User;
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
        View::composer('partials.nav', function($view)
        {
            $categories = Category::lists('title', 'id');
            $view->with(compact('categories'));
        });
    }

    /**
     * Display a listing of products under infinite scroll with pagination loading
     *
     * @param Request $request
     */
    public function index(Request $request)
    {
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

        return view('front.index', compact('products', 'lastPage', 'title'));
    }

    /**
     * Display a listing of products by each category
     *
     * @param $id
     * @param string $slug
     */
    public function showProductByCategory($id, $slug='')
    {
        $category = Category::findOrFail($id);
        $products = $category->products()->with('tags', 'picture')->paginate($this->paginate);;

        $title = "Category {$category->title}";
        return view('front.category', compact('products', 'title'));
    }

    /**
     * Display a listing of products by each tag
     *
     * @param $id
     * @param string $slug
     */
    public function showProductByTag($id, $slug='')
    {
        $tag = Tag::findOrFail($id);
        $products = $tag->products()->with('category', 'picture')->paginate($this->paginate);;

        $title = "Tag {$tag->name}";
        return view('front.tag', compact('products', 'tag', 'title'));
    }

    /**
     * Display the details and order form of a product
     *
     * @param $id
     * @param string $slug
     */
    public function showProduct($id, $slug='')
    {
        $bests = Product::orderBy('score', 'desc')->orderBy('price', 'desc')->take(4)->get();
        $product = Product::findOrFail($id);

        $title = "Product {$product->name}";
        return view('front.prod', compact('product', 'bests', 'title', 'customer_id'));
    }

    /**
     * Display the contact form
     */
    public function showContact()
    {
        $title = "Contact";
        return view('front.contact', compact('title'));
    }

    /**
     * Send the message to administrator
     * 
     * @param  Request $request
     */
    public function storeContact(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'content' => 'required|max:255'
        ]);

        $content = $request->input('content');
 
        Mail::send('emails.contact', compact('content'), function($m) use($request){
            $m->from($request->input('email'), 'Client'); 
            $m->to(env('EMAIL_TECH'), 'admin')->subject('Contact e-boutique'); 
        });

        return back()->with([
            'message' => trans('app.contactSuccess'),
            'alert'   => 'success'
        ]);
    }

    /**
     * Display the legal mentions
     */
    public function mentions(){
        $title = "Mentions";
        return view('front.mention', compact('title'));
    }

    /**
     * Display the customer details and his order histories
     */
    public function account()
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $customer = $user->customer;

        if($customer == null) {
            $title = "My account";
            return view('front.account', compact('user', 'title'));
        } else {
            $histories = History::where('customer_id', $customer->id)->orderBy('command_id', 'desc')->paginate(10);

            $title = "My account";
            return view('front.account', compact('user', 'customer', 'histories', 'title'));
        }
    }

    /**
     * Save the order of each product in session
     * 
     * @param  Request $request
     */
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

        Session::put('cart', $cart);

        return redirect('/')->with([
            'message' => trans('app.commandSuccess'),
            'alert'   => 'success'
        ]);
    }

    /**
     * Display a listing of orders by customer
     */
    public function showCart()
    {
        $carts = $this->productCart();
        $total = $this->totalPrice();

        $title = "Cart";
        return view('front.cart', compact('carts', 'total', 'title'));
    }

    /*
     * Update the quantity of each order in session
     */
    public function updateQuantity(Request $request)
    {
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
            'price'      => $price,
            'total'      => $total,
        ]);
    }

    /**
     * Remove a product from session
     * 
     * @param  int  $id
     */
    public function removeCart($id)
    {
        if(Session::has('cart')) {
            $cart = Session::get('cart');
            unset($cart[$id]);
            Session::put('cart', $cart);
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

    /**
     * Confirm the orders in session
     */
    public function validateCart()
    {
        $carts = $this->productCart();
        $total = $this->totalPrice();

        $title = "Confirm your cart";
        return view('front.confirm', compact('carts', 'total', 'title'));
    }

    /**
     * Save the orders in storage
     */
    public function confirmCart()
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $customer = $user->customer;

        if($customer == null) {
            return redirect('customer');
        } else {
            $command_id = History::all()->max('command_id');
            $command_id++;

            if(Session::has('cart')) {
                $cart = Session::get('cart');
                foreach($cart as $id => $quantity) {
                    $product = Product::find($id);
                    $command = [
                        'command_id'     => $command_id,
                        'product_id'     => $id,
                        'customer_id'    => $customer->id,
                        'price'          => $product->price*$quantity,
                        'quantity'       => (int)$quantity,
                        'command_at'     => date('Y-m-d H:i:s'),
                        'status'         => 'unfinalized',
                    ];

                    History::create($command);

                    $product->score++;
                    $product->quantity-=$quantity ;
                    $product->save();
                }
            }

            Session::forget('cart');

            $customer->increment('number_command');

            return redirect('/')->with([
                'message' => trans('app.finishSuccess'),
                'alert'   => 'success'
            ]);            
        }
    }

    /*
     * Retrieve the details of each product in session
     */
    private function productCart()
    {
        if(Session::has('cart')) {
            $cart = Session::get('cart');
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
        } else   $carts = [];

        return $carts;
    }

    /*
     * Calculate the total price of orders by customer
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
        } else   $total = 0;

        return $total;
    }
}