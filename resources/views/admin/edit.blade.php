@extends('layouts.admin')

@section('content')
    <form method="POST" action="{{url('product', $product->id)}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="fl">
            <div class="form-text">
                <label class="label" for="name">{{trans('app.prodName')}}: </label>
                <input class="input-text" id="name" name="name" type="text" value="{{$product->name}}"><br>
                @if ($errors->has('name'))
                    <span class="error">{{$errors->first('name')}}</span>
                @endif
            </div>
            <div class="form-text">
                <label class="label" for="slug">{{trans('app.slugName')}}: </label>
                <input class="input-text" id="slug" name="slug" type="text" value="{{$product->slug}}"><br>
                @if ($errors->has('slug'))
                    <span class="error">{{$errors->first('slug')}}</span>
                @endif
            </div>
            <div class="form-text">
                <label class="label" for="price">{{trans('app.price')}}: </label>
                <input class="input-text" id="price" name="price" type="text" value="{{$product->price}}"><br>
                @if ($errors->has('price'))
                    <span class="error">{{$errors->first('price')}}</span>
                @endif
            </div>
            <div class="form-text">
                <label class="label" for="quantity">{{trans('app.quantity')}}: </label>
                <input class="input-text" id="quantity" name="quantity" type="text" value="{{$product->quantity}}"><br>
                @if ($errors->has('quantity'))
                    <span class="error">{{$errors->first('quantity')}}</span>
                @endif
            </div>
            <div class="content">
                <label class="label" for="abstract">{{trans('app.abstract')}}: </label><br>
                <textarea row="50" cols="50" name="abstract">{{$product->abstract}}</textarea><br>
                @if ($errors->has('abstract'))
                    <span class="error">{{$errors->first('abstract')}}</span>
                @endif
            </div>
            <br>
            <div class="content">
                <label class="label" for="content">{{trans('app.content')}}: </label><br>
                <textarea row="50" cols="50" name="content">{{$product->content}}</textarea><br>
                @if ($errors->has('content'))
                    <span class="error">{{$errors->first('content')}}</span>
                @endif
            </div>
        </div>
        <div class="fr">
            <div class="form-text">
                <label class="label" for="category_id">{{trans('app.category')}}: </label>
                <select name="category_id" id="category_id">
                    <option value="" disabled></option>
                    @foreach($categories as $id => $title)
                        <option value="{{$id}}" {{$product->category_id==$id ? 'selected' : ''}}>{{$title}}</option>
                    @endforeach
                    <option value="0">{{trans('app.noCategory')}}</option>
                </select>
                @if ($errors->has('category_id'))
                    <span class="error">{{$errors->first('category_id')}}</span>
                @endif
            </div>
            <div class="form-text">
                <label class="label" for="tag">{{trans('app.tag')}}: </label>
                <select name="tags[]" id="tag" multiple>
                    <option value="" disabled></option>
                    @foreach($tags as $id => $name)
                        {{--<option value="{{$id}}" @if (in_array($id, $tagsProduct)) selected @endif>{{$name}}</option>--}}
                        <option value="{{$id}}" {{$product->hasTag($id)? 'selected' : ''}}>{{$name}}</option>
                    @endforeach
                    <option value="">{{trans('app.noTag')}}</option>
                </select>
                @if ($errors->has('tag'))
                    <span class="error">{{$errors->first('tag')}}</span>
                @endif
            </div>
            <div class="form-text">
                <label class="label" for="thumbnail">{{trans('app.addImage')}}</label>
                <input class="file" name="thumbnail" type="file"><br>
                @if ($product->picture)
                    <img class="inbl edit-image" src="{{url('uploads', $picture->uri)}}" width="100" height="100"><br>
                    <input class="edit-image" id="remove" name="remove" type="radio" value="true">{{trans('app.removeImage')}}
                @endif
            </div>
            <div class="form-text">
                <label class="label" for="status">{{trans('app.status')}}: </label>
                <input id="opened" name="status" type="radio" value="opened" {{($product->status == 'opened')? 'checked' : ''}}>opened
                <input id="closed" name="status" type="radio" value="closed" {{($product->status == 'closed')? 'checked' : ''}}>closed
            </div>
            <div class="form-text">
                <label class="label" for="published_at">{{trans('app.published_at')}}: </label>
                <input class="input-text" id="published_at" name="published_at" type="text" value="{{$product->published_at}}"><br>
                @if ($errors->has('published_at'))
                    <span class="error">{{$errors->first('published_at')}}</span>
                @endif
            </div>
            <div class="form-submit fr">
                <input class="button" type="submit" value="{{trans('app.update')}}">
            </div>
        </div>
    </form>
@stop