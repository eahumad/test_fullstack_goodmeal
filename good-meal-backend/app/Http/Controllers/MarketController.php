<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Market;

class MarketController extends Controller {

  /**
   * Store a new market on DB
   *
   * @param Illuminate\Http\Request $request
   * @return  App\Models\Market
   *
   */
  public function save(Request $request) : Market {

    $request->validate([
      'name' => 'required|unique:markets|max:255',
      'address' => 'required|max:255',
      'latitude' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
      'longitude' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/']
    ]);

    //TODO: cargar fotos

    $market = new Market($request->all());

    $market->save();

    return $market;
  }

  /**
   * List all markets
   *
   * @return Array
   */
  public function list() : array {
    return Market::get();
  }

  /**
   * Get market by id on request
   *
   * @param Illuminate\Http\Request $request
   * @return  App\Models\Market
   */
  public function get(Request $request) : Market {
    return Market::findOrFail($request->id);
  }
}
