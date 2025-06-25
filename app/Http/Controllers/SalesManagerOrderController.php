<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesManagerOrderController extends Controller
{
    // Mostrar todos los pedidos
    public function index(Request $request)
    {
        $status = $request->query('status');
        $ordersQuery = DB::table('orders')
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.name as user_name', 'users.email as user_email')
            ->when($status, function($query) use ($status) {
                $query->where('orders.status', $status);
            })
            ->orderByDesc('orders.created_at');
        $orders = $ordersQuery->get();

        // Para cada pedido, obtener los items y los paquetes asociados
        foreach ($orders as $order) {
            $order->items = DB::table('order_items')
                ->where('order_id', $order->id)
                ->leftJoin('packages', 'order_items.package_id', '=', 'packages.id')
                ->select('order_items.*',
                    'packages.title as package_title',
                    'packages.destination as package_destination',
                    'packages.description as package_description',
                    'packages.duration as package_duration',
                    'packages.price as package_price',
                    'packages.includes_flights',
                    'packages.includes_hotel',
                    'packages.location as package_location',
                    'packages.status as package_status'
                )
                ->get();
        }

        return view('sales_manager.orders.index', compact('orders', 'status'));
    }

    // Cambiar el estado de un pedido
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pendiente,pagado,cancelado',
        ]);
        $order->status = $request->input('status');
        $order->save();
        return back()->with('success', 'Estado del pedido actualizado.');
    }
} 