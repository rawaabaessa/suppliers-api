<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;

class OrderSeeder extends Seeder
{
    public function run(): void
    {

        $orders = [
            [
                'user_id' => 4,
                'farmer_id' => 1,
                'delivery_slot_id' => 1,
                'total_price' => 150,
                'status' => 'completed',
                'order_date' => now(),

                'items' => [
                    [
                        'product_id' => 1,
                        'quantity' => 10,
                        'price' => 50,
                    ],
                    [
                        'product_id' => 2,
                        'quantity' => 5,
                        'price' => 100,
                    ],
                ]
            ],


            [
                'user_id' => 5,
                'farmer_id' => 2,
                'delivery_slot_id' => 2,
                'total_price' => 200,
                'status' => 'pending',
                'order_date' => now(),

                'items' => [
                    [
                        'product_id' => 3,
                        'quantity' => 20,
                        'price' => 200,
                    ],
                ]
            ],


            [
                'user_id' => 6,
                'farmer_id' => 3,
                'delivery_slot_id' => 3,
                'total_price' => 80,
                'status' => 'processing',
                'order_date' => now(),

                'items' => [
                    [
                        'product_id' => 4,
                        'quantity' => 8,
                        'price' => 80,
                    ],
                ]
            ],
        ];


        foreach ($orders as $orderData) {

            $items = $orderData['items'];

            unset($orderData['items']);


            $order = Order::create($orderData);


            foreach ($items as $item) {

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);

            }
        }
    }
}