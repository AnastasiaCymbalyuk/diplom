@extends('layouts.app')

@section('content')
    @auth
        <head>
            <title>ИдёмВКино</title>
        </head>
        <admin />
    @endauth

    @guest
        <head>
            <title>ИдёмВКино</title>
        </head>
        <user />
    @endguest
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
@endsection
