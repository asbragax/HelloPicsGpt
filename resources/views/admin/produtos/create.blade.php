@extends('layouts.admin')

@section('title', 'Novo Produto')

@section('content')
<h1 class="page-header">Novo Produto</h1>

<form method="POST" action="{{ route('admin.produtos.store') }}">
    @csrf

    @include('admin.produtos.form', ['produto' => null])
</form>
@endsection
