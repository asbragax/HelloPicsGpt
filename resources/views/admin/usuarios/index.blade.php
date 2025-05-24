@extends('layouts.admin')
@section('title', 'Usuários')

@section('content')
<h1 class="page-header">Usuários</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<ul class="nav nav-tabs">
    <li class="nav-item">
        <a href="#admins" data-bs-toggle="tab" class="nav-link active">Administradores</a>
    </li>
    <li class="nav-item">
        <a href="#clientes" data-bs-toggle="tab" class="nav-link">Clientes</a>
    </li>
</ul>

<div class="tab-content pt-3">
    <!-- Admins -->
    <div class="tab-pane fade show active" id="admins">
        <a href="{{ route('admin.usuarios.create') }}" class="btn btn-success mb-3">
            <i class="fa fa-plus"></i> Novo Administrador
        </a>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $usuario)
                    <tr>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>
                            <a href="{{ route('admin.usuarios.edit', $usuario) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('admin.usuarios.destroy', $usuario) }}" method="POST" class="d-inline" onsubmit="return confirm('Excluir este admin?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @if($admins->isEmpty())
                        <tr><td colspan="3">Nenhum administrador cadastrado.</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Clientes -->
    <div class="tab-pane fade" id="clientes">
        <div class="table-responsive mt-3">
            <table id="tabela-clientes" class="table table-striped table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Data de cadastro</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->name }}</td>
                        <td>{{ $cliente->email }}</td>
                        <td>{{ $cliente->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#tabela-clientes').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json'
            },
            pageLength: 10
        });
    });
</script>
@endpush
