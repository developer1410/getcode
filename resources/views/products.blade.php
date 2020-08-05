@extends('main')

@section('content')
    <table>
        <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Created at</th>
            <th>Updated at</th>
        </thead>
        <tbody>
        @if ($products->count() == 0)
            <tr>
                <td colspan="4">No products has been imported.</td>
            </tr>
        @endif

        @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td><a href="/products/{{ $product->id }}">{{ $product->name }}</a></td>
                <td>{{ $product->created_at }}</td>
                <td>{{ $product->updated_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $products->links() }}

    <p>
        Is shown {{$products->count()}} of {{ $products->total() }} product(s).
    </p>
@endsection
