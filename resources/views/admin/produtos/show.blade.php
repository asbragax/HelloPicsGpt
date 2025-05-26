@extends('layouts.admin')

@section('title', 'Ver produto - ' . $produto->nome)

@section('content')
<div id="content" class="app-content">
    <h1 class="page-header">Produto: {{ $produto->nome }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Descrição:</strong> {{ $produto->descricao ?? '—' }}</p>
            <p><strong>Preço:</strong> R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
            <p><strong>Limite de fotos:</strong> {{ $produto->photo_limit }}</p>
            <p><strong>Permite moldura:</strong> {{ $produto->includes_mold ? 'Sim' : 'Não' }}</p>
            <a href="{{ route('admin.produtos.edit', $produto->id) }}" class="btn btn-warning mt-2">Editar Produto</a>
        </div>
    </div>

    <h4>Gerenciar Fotos</h4>

    <form action="{{ route('admin.produtos.fotos.store', $produto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <input type="file" name="fotos[]" multiple class="form-control" required>
        </div>
        <button class="btn btn-primary">Enviar Fotos</button>
    </form>

    <hr>

    <div class="row">
        @foreach($produto->fotos as $foto)
            <div class="col-md-3 text-center mb-4">
                <img src="{{ asset('storage/' . $foto->caminho) }}" class="img-fluid rounded" style="height: 120px; object-fit: cover;"><br>

                @if($foto->principal)
                    <span class="badge bg-success d-block my-2">Principal</span>
                @else
                    <form action="{{ route('admin.produtos.fotos.principal', $foto->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-sm btn-outline-success my-2">Marcar como principal</button>
                    </form>
                @endif

                <form action="{{ route('admin.produtos.fotos.destroy', $foto->id) }}" method="POST" onsubmit="return confirm('Excluir esta foto?');">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Excluir</button>
                </form>
            </div>
        @endforeach
    </div>
</div>
@endsection
