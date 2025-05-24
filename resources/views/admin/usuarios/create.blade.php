@extends('layouts.admin')
@section('title', 'Novo Administrador')

@section('content')
<h1 class="page-header">Novo Administrador</h1>

<form method="POST" action="{{ route('admin.usuarios.store') }}">
    @csrf

    @include('admin.usuarios.form', ['usuario' => null])
</form>
@endsection
