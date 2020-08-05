@extends('main')

@section('content')
    <form id="formSend">
        @csrf
        <div>
            <label for="resource_link">Enter text</label>
            <input id="resource_link" name="resource" type="text">
        </div>
        <div>
            <button type="submit">Load product</button>
        </div>
    </form>
@endsection

@push('footerJS')
    <script src="{{ asset('js/load-resource.js')}}"></script>
@endpush


