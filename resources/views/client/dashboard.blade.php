@extends('layouts.client')

@section('title', 'Painel do Cliente')

@section('content')
    <h1 class="text-2xl font-bold">Bem-vindo, {{ auth()->user()->name }}!</h1>
@endsection
