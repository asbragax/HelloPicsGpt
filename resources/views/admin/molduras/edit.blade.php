@extends('layouts.admin')

@section('content')
@include('admin-header')
@include('admin-sidebar')

<div id="content" class="app-content">
    <h1 class="page-header">Editar Moldura</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.molduras.update', $moldura) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Nome *</label>
                    <input type="text" name="nome" value="{{ $moldura->nome }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Descrição</label>
                    <textarea name="descricao" class="form-control">{{ $moldura->descricao }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Imagem Atual</label><br>
                    @if($moldura->imagem)
                        <img src="{{ asset('storage/' . $moldura->imagem) }}" alt="imagem" width="120">
                    @else
                        <span class="text-muted">Sem imagem</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label>Nova Imagem</label>
                    <input type="file" name="imagem" class="form-control">
                </div>

                <button type="submit" class="btn btn-success">Atualizar</button>
                <a href="{{ route('admin.molduras.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
