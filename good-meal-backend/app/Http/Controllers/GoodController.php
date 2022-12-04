<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Good;

class GoodController extends Controller {

  /**
   * Save a new good on DB
   *
   * @param Illuminate\Http\Request $request
   * @return  App\Models\Market
   */
  public function save(Request $request) : Good {
    $request->validate([
      'name' => 'required|max:255|unique:goods',
      'brand' => 'required|max:255',
      'category' => 'required|max:255',
    ]);

    $good = new Good($request->all());
    $good->save();

    return $good;
  }

  /**
   * List all goods
   *
   * @return Illuminate\Database\Eloquent\Collection
   */
  public function list() : \Illuminate\Database\Eloquent\Collection {
    return Good::get();
  }
}
