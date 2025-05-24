@extends('layouts.admin')
@section('title', 'Pedido #' . $pedido->id)

@section('content')
<h1 class="page-header">Pedido #{{ $pedido->id }}</h1>

<div class="card">
    <div class="card-body">

        <h4>Informações do Cliente</h4>
        <p><strong>Nome:</strong> {{ $pedido->user->name }}</p>
        <p><strong>Email:</strong> {{ $pedido->user->email }}</p>

        <hr>

        <h4>Produtos do Pedido</h4>

        @if ($pedido->produtos->isEmpty())
            <p>Nenhum pack encontrado neste pedido.</p>
        @else
            <div class="table-responsive mb-4">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Pack</th>
                            <th>Tamanho</th>
                            <th>Fotos</th>
                            <th>Legenda</th>
                            <th>Moldura</th>
                            <th>Qtd</th>
                            <th>Preço</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedido->produtos as $produto)
                            <tr>
                                <td>{{ $produto->name }}</td>
                                <td>{{ $produto->size }}</td>
                                <td>{{ $produto->photo_limit }}</td>
                                <td>{{ $produto->includes_caption ? 'Sim' : 'Não' }}</td>
                                <td>{{ $produto->includes_mold ? 'Sim' : 'Não' }}</td>
                                <td>{{ $produto->pivot->quantidade }}</td>
                                <td>R$ {{ number_format($produto->pivot->preco_unitario, 2, ',', '.') }}</td>
                                <td>
                                    R$ {{ number_format($produto->pivot->quantidade * $produto->pivot->preco_unitario, 2, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <hr>

        <h4>Entrega das Fotos</h4>
        <p><strong>Método:</strong> {{ ucfirst($pedido->photo_delivery_type) }}</p>
        @if($pedido->photo_link)
            <p><strong>Link:</strong> <a href="{{ $pedido->photo_link }}" target="_blank">{{ $pedido->photo_link }}</a></p>
        @endif

        <hr>

        <h4>Status do Pedido</h4>
        <form method="POST" action="{{ route('admin.pedidos.update', $pedido->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <select name="status" class="form-select">
                    @foreach(['aguardando_pagamento', 'pago', 'em_producao', 'enviado', 'entregue', 'cancelado'] as $status)
                        <option value="{{ $status }}" {{ $pedido->status === $status ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('_', ' ', $status)) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary">Atualizar Status</button>
            <a href="{{ route('admin.pedidos.index') }}" class="btn btn-secondary">Voltar</a>
        </form>

        <hr>
        <h4>Fotos por Pack</h4>

        @forelse ($pedidoProdutos as $pp)
            <div class="mb-4">
                <h5>{{ $pp->produto->name }} ({{ $pp->produto->size }})</h5>

                @if ($pp->fotos->isEmpty())
                    <p><em>Nenhuma foto enviada para este pack.</em></p>
                @else
                    <div class="row">
                        @foreach ($pp->fotos as $foto)
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <img src="{{ asset('uploads/' . $foto->filename) }}" class="card-img-top" alt="Foto {{ $foto->id }}">
                                    <div class="card-body">
                                        <p class="card-text">
                                            <strong>#{{ $foto->position + 1 }}</strong><br>
                                            {{ $foto->caption ?? 'Sem legenda' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @empty
            <p>Nenhum pack encontrado neste pedido.</p>
        @endforelse


    </div>
</div>
@endsection
