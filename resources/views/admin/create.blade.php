@extends('layouts.admin')

@section('content')
    <form method="POST" action="{{url('product')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="fl">
            <div class="form-text">
                <label class="label" for="name">{{trans('app.prodName')}}: </label>
                <input class="input-text" id="name" name="name" type="text" value="{{old('name')}}"><br>
                @if ($errors->has('name'))
                    <span class="error">{{$errors->first('name')}}</span>
                @endif
            </div>
            <div class="form-text">
                <label class="label" for="slug">{{trans('app.slugName')}}: </label>
                <input class="input-text" id="slug" name="slug" type="text" value="{{old('slugName')}}"><br>
                @if ($errors->has('slug'))
                    <span class="error">{{$errors->first('slug')}}</span>
                @endif
            </div>
            <div class="form-text">
                <label class="label" for="price">{{trans('app.price')}}: </label>
                <input class="input-text" id="price" name="price" type="text" value="{{old('price')}}"><br>
                @if ($errors->has('price'))
                    <span class="error">{{$errors->first('price')}}</span>
                @endif
            </div>
            <div class="form-text">
                <label class="label" for="quantity">{{trans('app.quantity')}}: </label>
                <input class="input-text" id="quantity" name="quantity" type="text" value="{{old('quantity')}}"><br>
                @if ($errors->has('quantity'))
                    <span class="error">{{$errors->first('quantity')}}</span>
                @endif
            </div>
            <div class="content">
                <label class="label" for="abstract">{{trans('app.abstract')}}: </label><br>
                <textarea row="50" cols="50" name="abstract">{{old('abstract')}}</textarea><br>
                @if ($errors->has('abstract'))
                    <span class="error">{{$errors->first('abstract')}}</span>
                @endif
            </div>
            <br>
            <div class="content">
                <label class="label" for="content">{{trans('app.content')}}: </label><br>
                <textarea row="50" cols="50" name="content">{{old('content')}}</textarea><br>
                @if ($errors->has('content'))
                    <span class="error">{{$errors->first('content')}}</span>
                @endif
            </div>
        </div>
        <div class="fr">
            <div class="form-text">
                <label class="label" for="category_id">{{trans('app.category')}}: </label>
                <select name="category_id" id="category_id">
                    <option value="" selected disabled></option>
                    @foreach($categories as $id => $title)
                        <option value="{{$id}}">{{$title}}</option>
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
                    <option value="" selected disabled></option>
                    @foreach($tags as $id => $name)
                        <option value="{{$id}}">{{$name}}</option>
                    @endforeach
                    <option value="">{{trans('app.noTag')}}</option>
                </select>
                @if ($errors->has('tag'))
                    <span class="error">{{$errors->first('tag')}}</span>
                @endif
            </div>
            <div class="form-text">
                <label class="label" for="published_at">{{trans('app.published_at')}}: </label>
                <input class="input-text" id="published_at" name="published_at" type="text" placeholder="ex: 26/03/1982 03:30:18"><br>
                @if ($errors->has('published_at'))
                    <span class="error">{{$errors->first('published_at')}}</span>
                @endif
            </div>
            <div class="form-text">
                <label class="label" for="thumbnail">{{trans('app.addImage')}}</label>
                <input class="file" name="thumbnail" type="file"><br>
                @if ($errors->has('thumbnail'))
                    <span class="error">{{$errors->first('thumbnail')}}</span>
                @endif
            </div>
            <div class="form-text">
                <label class="label" for="status">{{trans('app.status')}}: </label>
                <input id="opened" name="status" type="radio" value="opened">opened
                <input id="closed" name="status" type="radio" value="closed">closed
                </div>
            </div>
            <div class="form-submit fr">
                <input class="button" type="submit" value="{{trans('app.create')}}">
            </div>
        </div>
    </form>
@stop