@extends('layouts.admin')

@section('title', 'Produtos')

@section('content')
<h1 class="page-header">Produtos (Packs)</h1>

<a href="{{ route('admin.produtos.create') }}" class="btn btn-success mb-3">
    <i class="fa fa-plus"></i> Novo Produto
</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Nome</th>
                <th>Tamanho</th>
                <th>Fotos</th>
                <th>Legenda</th>
                <th>Moldura</th>
                <th>Preço</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($produtos as $produto)
            <tr>
                <td>{{ $produto->name }}</td>
                <td>{{ $produto->size }}</td>
                <td>{{ $produto->photo_limit }}</td>
                <td>{{ $produto->includes_caption ? 'Sim' : 'Não' }}</td>
                <td>{{ $produto->includes_mold ? 'Sim' : 'Não' }}</td>
                <td>R$ {{ number_format($produto->price, 2, ',', '.') }}</td>
                <td>
                    <span class="badge bg-{{ $produto->status ? 'success' : 'secondary' }}">
                        {{ $produto->status ? 'Ativo' : 'Inativo' }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.produtos.show', $produto->id) }}" class="btn btn-sm btn-info">Visualizar</a>
                    <a href="{{ route('admin.produtos.edit', $produto) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('admin.produtos.destroy', $produto) }}" method="POST" class="d-inline" onsubmit="return confirm('Deseja excluir?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Excluir</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8">Nenhum produto cadastrado.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $produtos->links() }}
@endsection
