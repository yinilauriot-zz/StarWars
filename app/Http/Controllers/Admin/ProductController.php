<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Session;
use View;
use App\Tag;
use App\Picture;
use App\Product;
use App\Category;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected $paginate = 10;

    public function __construct()
    {
        View::composer('partials.nav', function($view)
        {
            $categories = Category::lists('title', 'id');
            $view->with(compact('categories'));
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('tags', 'category')
                             ->orderBy('published_at', 'desc')
                             ->paginate($this->paginate);
        $title = 'All products';
        return view('admin.index', compact('products', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::lists('title', 'id');
        $tags = Tag::lists('name','id');

        $title = 'Create a product';
        return view('admin.create', compact('categories', 'tags', 'title'));
    }

    /**
     * @param Requests\ProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductRequest $request)
    {
        $product = Product::create($request->all());
        $product->tags()->attach($request->input('tags'));

        if (!is_null($request->file('thumbnail')))
            $this->upload($request, $product);

        return redirect('product')->with([
            'message' => trans('app.createSuccess'),
            'alert'   => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $title = "Product {$product->name}";
        return view('front.prod', compact('title', 'product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::lists('title', 'id');
        $tags = Tag::lists('name','id');

        $product = Product::find($id);
        $tagsProduct = $product->tags->lists('id')->toArray();

        $picture = $product->picture;

        $title = 'Edit a product';
        return view('admin.edit', compact('product', 'title', 'tags', 'categories', 'tagsProduct', 'catProduct', 'picture'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);

        if (!empty($request->input('tags'))) {
            $product->tags()->sync($request->input('tags'));
        } else {
            $product->tags()->detach();
        }

        if ($request->input('remove')=='true')
            $this->deleteImage($product);

        if (!is_null($request->file('thumbnail'))) {
            $this->deleteImage($product);
            $this->upload($request, $product);
        }

        $product->update($request->all());
        return redirect('product')->with([
            'message' => trans('app.updateSuccess'),
            'alert'   => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $picture = $product->picture;

        $this->deleteImage($product);
        $product->delete();

        if(Session::has('cart')) {
            $cart = Session::get('cart');
            unset($cart[$id]);
            Session::put('cart', $cart);
        }

        return redirect('product')->with([
            'message' => trans('app.deleteSuccess'),
            'alert'   => 'success'
        ]);
    }

    /**
     * Confirm the product remove from storage
     *
     * @param int $id
     */
    public function confirmRemove($id)
    {
        $product = Product::find($id);
        $title = "Remove";
        return view('admin.remove', compact('product', 'title'));
    }

    /**
     * Change the product status in storage
     *
     * @param int $id
     */
    public function changeStatus($id)
    {
        $product = Product::find($id);
        $product->status = ($product->status == 'opened') ? 'closed' : 'opened';
        $product->save();

        return back()->with([
            'message' => trans('app.changeStatus'),
            'alert'   => 'success'
        ]);
    }

    /**
     * Upload the image of a product
     *
     * @param Request $request
     * @param $product
     */
    private function upload(ProductRequest $request, $product)
    {
        $img = $request->file('thumbnail');

        // récupérer le nom de l'image
        $uri = $img->getClientOriginalName();

        // récupérer l'extension de l'image
        $ext = $img->getClientOriginalExtension();

        // exception renvoyée par le framework si problème
        $img->move(env('UPLOAD_PATH', './uploads'), $uri);

        // insérer une image dans la table pictures
        Picture::create([
            'product_id' => $product->id,
            'title'      => $product->name,
            'uri'        => $uri,
            'size'       => $img->getClientSize(),
            'type'       => $ext,
        ]);
    }

    /**
     * Delete the image of a product
     *
     * @param $product
     */
    private function deleteImage($product)
    {
        if (!is_null($product->picture)) {
            Storage::delete($product->picture->uri);    // supprimer l'image dans public/uploads
            $product->picture->delete();        // supprimer l'image dans la table pictures
        }
    }
}