@extends('layouts.admin')

@section('content')
@include('admin-header')
@include('admin-sidebar')

<div id="content" class="app-content">
    <h1 class="page-header">Molduras</h1>

    <div class="mb-3">
        <a href="{{ route('admin.molduras.create') }}" class="btn btn-primary">Nova Moldura</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Imagem</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($molduras as $moldura)
                        <tr>
                            <td>
                                @if($moldura->imagem)
                                    <img src="{{ asset('storage/'.$moldura->imagem) }}" alt="" width="80">
                                @else
                                    <span class="text-muted">Sem imagem</span>
                                @endif
                            </td>
                            <td>{{ $moldura->nome }}</td>
                            <td>{{ $moldura->descricao }}</td>
                            <td>
                                <a href="{{ route('admin.molduras.edit', $moldura) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route('admin.molduras.destroy', $moldura) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Tem certeza que deseja excluir?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @if($molduras->isEmpty())
                        <tr>
                            <td colspan="4">Nenhuma moldura cadastrada.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
