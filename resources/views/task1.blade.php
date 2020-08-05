@extends('main')

@section('content')
    <div class="title m-b-md">
    </div>
    <div id="blockB">

    </div>
    <div>
        <button id="send-request">Send</button>
    </div>
@endsection

@push('footerJS')
    <script src="{{ asset('js/task1.js')}}"></script>
@endpush
