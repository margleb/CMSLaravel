@extends('layouts.app')
@section('content')
    <h1>Cтраница поста {{ $id }}, Имя: {{ $name }}</h1>
@stop
@section('footer')
    <script>alert('Привет, посетитель!')</script>
@stop