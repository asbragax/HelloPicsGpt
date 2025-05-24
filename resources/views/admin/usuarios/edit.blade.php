@extends('layouts.admin')
@section('title', 'Editar Administrador')

@section('content')
<h1 class="page-header">Editar Administrador</h1>

<form method="POST" action="{{ route('admin.usuarios.update', $usuario) }}">
    @csrf
    @method('PUT')

    @include('admin.usuarios.form', ['usuario' => $usuario])
</form>
@endsection
