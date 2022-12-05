<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Good;
use App\Models\GoodMarket;
use App\Http\Controllers\GoodController;

class GoodMarketController extends Controller {

  public function addGoodToMarket(Request $request, int $market_id) : JsonResponse {
    $request->validate([
      'name' => 'required|max:255',
      'brand' => 'max:255',
      'category' => 'max:255',
      'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'normal_price' => 'required|integer',
      'good_meal_price' => 'required|integer',
      'stock' => 'required|integer',
    ]);

    //validar si el producto ya existe
    $good = Good::where('name',$request->name)->first();
    if( empty($good) ) {
      $good = (new GoodController())->save($request);
    } else { //validar si ya está asociado a la tienda
      $goodMarket = GoodMarket::where('market_id',$market_id)
        ->where('good_id',$good->id)
        ->first();

      if( !empty($goodMarket) ) {

        return Response()
          ->json(['message'=>'the product already exists on the market'],403);
      }
    }

    $goodMarket = new GoodMarket();
    $goodMarket->market_id = $market_id;
    $goodMarket->good_id = $good->id;
    $goodMarket->normal_price = $request->normal_price;
    $goodMarket->good_meal_price = $request->good_meal_price;
    $goodMarket->stock = $request->stock;

    $goodMarket->save();

    return Response()
      ->json($goodMarket);
  }


  public function addExistingGoodToMarket(Request $request, int $market_id, int $good_id) : JsonResponse {
    $request->validate([
      'normal_price' => 'required|integer',
      'good_meal_price' => 'required|integer',
      'stock' => 'required|integer',
    ]);

    $goodMarket = GoodMarket::where('market_id',$market_id)
      ->where('good_id',$good_id)
      ->first();

    if( !empty($goodMarket) ) {
      return Response()
          ->json(['message'=>'the product already exists on the market'],403);
    }

    $goodMarket = new GoodMarket();
    $goodMarket->market_id = $market_id;
    $goodMarket->good_id = $good_id;
    $goodMarket->normal_price = $request->normal_price;
    $goodMarket->good_meal_price = $request->good_meal_price;
    $goodMarket->stock = $request->stock;

    $goodMarket->save();

    return Response()
      ->json($goodMarket);
  }

  public function updateGoodMarket(Request $request, int $market_id, int $good_id) : JsonResponse {
    $request->validate([
      'normal_price' => 'required|integer',
      'good_meal_price' => 'required|integer',
      'stock' => 'required|integer',
    ]);

    $goodMarket = GoodMarket::where('market_id',$market_id)
      ->where('good_id',$good_id)
      ->firstOrFail();

    $goodMarket->normal_price = $request->normal_price;
    $goodMarket->good_meal_price = $request->good_meal_price;
    $goodMarket->stock = $request->stock;

    return Response()->json($goodMarket);
  }
}
