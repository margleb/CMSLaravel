@extends('layouts.app')
@section('content')
    <h1>Cтраница контактов</h1>

    @if(count($people))
        <ul>
            @foreach($people as $person)
                <li>{{ $person }}</li>
            @endforeach
        </ul>
    @endif

@stop
@section('footer')
    <script>alert('Привет, посетитель!')</script>
@stop