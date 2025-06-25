@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Mis Pedidos</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($orders->isEmpty())
        <p>No tienes pedidos todavía.</p>
    @else
        @foreach($orders as $order)
            <div class="card mb-3">
                <div class="card-header">
                    Pedido #{{ $order->id }} | Estado: <strong>{{ ucfirst($order->status) }}</strong> | Total: ${{ number_format($order->total, 2) }}
                </div>
                <div class="card-body">
                    <ul>
                        @foreach($order->items as $item)
                            <li>
                                <strong>{{ $item->package->title ?? 'Paquete eliminado' }}</strong> x {{ $item->quantity }}<br>
                                Precio unitario: ${{ number_format($item->price, 2) }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer text-muted">
                    Realizado el {{ $order->created_at->format('d/m/Y H:i') }}
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection 