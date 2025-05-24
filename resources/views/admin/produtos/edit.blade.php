@extends('layouts.admin')

@section('title', 'Editar Produto')

@section('content')
<h1 class="page-header">Editar Produto</h1>

<form method="POST" action="{{ route('admin.produtos.update', $produto) }}">
    @csrf
    @method('PUT')

    @include('admin.produtos.form', ['produto' => $produto])
</form>
@endsection
