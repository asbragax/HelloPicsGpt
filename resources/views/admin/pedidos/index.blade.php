@extends('layouts.admin')
@section('title', 'Pedidos')

@section('content')
<h1 class="page-header">Pedidos</h1>

<div class="table-responsive">
    <table id="tabela-pedidos" class="table table-striped table-bordered align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Pack</th>
                <th>Total</th>
                <th>Enviado por</th>
                <th>Status</th>
                <th>Data</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedidos as $pedido)
            <tr>
                <td>{{ $pedido->id }}</td>
                <td>{{ $pedido->user->name }}</td>
                <td>{{ $pedido->produtos->count() }} pack(s)</td>
                <td>R$ {{ number_format($pedido->total_price, 2, ',', '.') }}</td>
                <td>{{ ucfirst($pedido->photo_delivery_type) }}</td>
                <td><span class="badge bg-secondary">{{ str_replace('_', ' ', $pedido->status) }}</span></td>
                <td>{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <a href="{{ route('admin.pedidos.show', $pedido->id) }}" class="btn btn-sm btn-info">Ver</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#tabela-pedidos').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json'
            },
            pageLength: 10
        });
    });
</script>
@endpush
