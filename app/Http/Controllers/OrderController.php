<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Package;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Mostrar los pedidos del usuario autenticado
    public function index()
    {
        $orders = Auth::user()->orders()->with('items.package')->latest()->get();
        return view('orders.index', compact('orders'));
    }

    // Procesar el pago y crear el pedido
    public function store(Request $request)
    {
        // Decodificar JSON si la petición es application/json
        if ($request->isJson()) {
            $data = json_decode($request->getContent(), true);
            $request->merge($data);
        }

        $cart = $request->input('cart');
        if (!is_array($cart) || count($cart) === 0) {
            return response()->json(['error' => 'El carrito está vacío.'], 422);
        }

        $total = 0;
        $orderItems = [];
        foreach ($cart as $item) {
            $package = Package::find($item['package_id']);
            if (!$package) {
                return response()->json(['error' => 'Paquete no encontrado.'], 404);
            }
            $subtotal = $package->price * ($item['quantity'] ?? 1);
            $total += $subtotal;
            $orderItems[] = [
                'package_id' => $package->id,
                'quantity' => $item['quantity'] ?? 1,
                'price' => $package->price,
                'package_title' => $package->title,
                'service_type' => $item['service_type'] ?? ($package->service_type ?? null),
            ];
        }

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => Auth::id(),
                'total' => $total,
                'status' => 'pendiente',
                'card_name' => $request->input('card_name'),
                'card_number' => $request->input('card_number'),
                'card_expiry' => $request->input('card_expiry'),
                'card_cvc' => $request->input('card_cvc'),
            ]);

            foreach ($orderItems as $item) {
                $item['order_id'] = $order->id;
                OrderItem::create($item);
                // Crear la reserva para el usuario
                Booking::create([
                    'user_id' => Auth::id(),
                    'package_id' => $item['package_id'],
                    'status' => 'pending',
                    'booking_date' => now(),
                ]);
            }

            DB::commit();
            return response()->json(['success' => true, 'order_id' => $order->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error al guardar el pedido: ' . $e->getMessage()], 500);
        }
    }
} 