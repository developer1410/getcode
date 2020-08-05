@extends('main')

@section('content')
    <ul>
        <li>ID: {{ $product->id }}</li>
        <li>Name: <a href="/products/{{ $product->id }}">{{ $product->name }}</a></li>
        <li>URL: {{ $product->url }}</li>
        <li>Images: {{ implode(', ', $product->images) }}</li>
        <li>Brand: {{ $product->brand }}</li>
        <li>Category ID: {{ $product->category_id }}</li>
        <li>Created at: {{ $product->created_at }}</li>
        <li>Updated at: {{ $product->updated_at }}</li>
    </ul>
@endsection

