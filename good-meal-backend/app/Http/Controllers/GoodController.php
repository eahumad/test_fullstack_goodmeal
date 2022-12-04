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
  public function save(Request $request): Good {
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
  public function list(): \Illuminate\Database\Eloquent\Collection {
    return Good::get();
  }

  /**
   * Get good by id
   *
   * @param int $id
   * @return App\Models\Good
   */
  public function get(int $id): Good {
    return Good::findOrFail($id);
  }

  /**
   * update an exising good on BD
   *
   * @param Illuminate\Http\Request $request
   * @param int $id
   */
  public function update(Request $request, $id) : void {
    $request->validate([
      'name' => 'required|max:255|unique:goods,name,'.$id,
      'brand' => 'required|max:255',
      'category' => 'required|max:255',
    ]);

    $good = Good::findOrFail($id);

    $good->name = $request->name;
    $good->brand = $request->brand;
    $good->category = $request->category;

    $good->save();
  }
}
