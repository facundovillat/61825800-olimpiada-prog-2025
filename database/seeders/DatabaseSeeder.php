<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
        ]);

        // Crear usuario jefe de ventas
        $salesManager = \App\Models\User::firstOrCreate([
            'email' => 'jefedeventas@turisapp.com',
        ], [
            'name' => 'Jefe de Ventas',
            'password' => bcrypt('12345678'),
            'role' => 'jefe de ventas',
        ]);

        // Crear usuario cliente
        $cliente = \App\Models\User::firstOrCreate([
            'email' => 'cliente@demo.com',
        ], [
            'name' => 'Cliente Demo',
            'password' => bcrypt('12345678'),
            'role' => 'cliente',
        ]);

        // Crear 2 paquetes si no existen
        $paquete1 = \App\Models\Package::firstOrCreate([
            'title' => 'Paquete Demo 1',
        ], [
            'user_id' => $salesManager->id,
            'category_id' => 1,
            'destination' => 'Cancún',
            'description' => 'Vacaciones en Cancún',
            'duration' => '7 días',
            'price' => 1500,
            'location' => 'Buenos Aires',
            'includes_flights' => true,
            'includes_hotel' => true,
            'status' => 'available',
        ]);
        $paquete2 = \App\Models\Package::firstOrCreate([
            'title' => 'Paquete Demo 2',
        ], [
            'user_id' => $salesManager->id,
            'category_id' => 2,
            'destination' => 'Bariloche',
            'description' => 'Aventura en la montaña',
            'duration' => '5 días',
            'price' => 1200,
            'location' => 'Córdoba',
            'includes_flights' => false,
            'includes_hotel' => true,
            'status' => 'available',
        ]);

        // Crear pedido de prueba
        $order = \App\Models\Order::create([
            'user_id' => $cliente->id,
            'total' => 2700,
            'status' => 'pendiente',
        ]);
        \App\Models\OrderItem::create([
            'order_id' => $order->id,
            'package_id' => $paquete1->id,
            'quantity' => 1,
            'price' => 1500,
        ]);
        \App\Models\OrderItem::create([
            'order_id' => $order->id,
            'package_id' => $paquete2->id,
            'quantity' => 1,
            'price' => 1200,
        ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
