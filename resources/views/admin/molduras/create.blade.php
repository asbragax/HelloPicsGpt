@extends('layouts.admin')

@section('content')
@include('admin-header')
@include('admin-sidebar')

<div id="content" class="app-content">
    <h1 class="page-header">Nova Moldura</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.molduras.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label>Nome *</label>
                    <input type="text" name="nome" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Descrição</label>
                    <textarea name="descricao" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label>Imagem</label>
                    <input type="file" name="imagem" class="form-control">
                </div>

                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="{{ route('admin.molduras.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
