<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OrderStatus;


class OrderStatusSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    $orderStatus = new OrderStatus();
    $orderStatus->code = 'on_cart';
    $orderStatus->name = 'En el carrito';
    $this->saveOrderStatus($orderStatus);

    $orderStatus = new OrderStatus();
    $orderStatus->code = 'cancelled_cart';
    $orderStatus->name = 'Carrito cancelado';
    $this->saveOrderStatus($orderStatus);

    $orderStatus = new OrderStatus();
    $orderStatus->code = 'payed';
    $orderStatus->name = 'Pedido Pagado';
    $this->saveOrderStatus($orderStatus);
  }

  /**
   * Save order status checking if code exists on DB.
   * if code exist, just update de name value on DB, either, insert a new row on DB
   *
   * @param OrderStatus
   * @return void
   */
  private function saveOrderStatus(OrderStatus $orderStatus) : void {
    $orderStatusDB = OrderStatus::find($orderStatus->code);
    if( empty( $orderStatusDB ) ) {
      $orderStatus->save();
      return;
    }
    $orderStatusDB->name = $orderStatus->name;
  }
}
