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
      'longitude' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
      'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'cover' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ]);


    $fileNames = $this->storeLogoAndCover($request);

    $market = new Market($request->all());
    $market->logo = $fileNames['logoName'];
    $market->cover = $fileNames['coverName'];

    $market->save();

    return $market;
  }

  /**
   * move to storage logo and cover file and return an associative array with logoName and coverName
   *
   * @param Illuminate\Http\Request $request
   * @return Array
   *
   */
  private function storeLogoAndCover(Request $request) : Array {
    $logo = $request->file('logo');
    $cover = $request->file('cover');


    $logoName = uniqid().'.'.$logo->getClientOriginalExtension();
    $coverName = uniqid().'.'.$cover->getClientOriginalExtension();

    $logo->storeAs('public/markets',$logoName);
    $cover->storeAs('public/markets',$coverName);

    return [
      'logoName' => $logoName,
      'coverName' => $coverName,
    ];
  }

  /**
   * List all markets
   *
   * @return \Illuminate\Database\Eloquent\Collection
   */
  public function list() : \Illuminate\Database\Eloquent\Collection {
    return Market::get();
  }

  /**
   * Get market by id on route
   *
   * @param Illuminate\Http\Request $request
   * @return  App\Models\Market
   */
  public function get(Request $request) : Market {
    return Market::findOrFail($request->id);
  }

  /**
   * Update market by id on route
   *
   * @param Illuminate\Http\Request $request
   * @param int $id
   * @return void
   *
   */
  public function update(Request $request,int $id) : void {

    $request->validate([
      'name' => 'required|max:255|unique:markets,name,'.$id,
      'address' => 'required|max:255',
      'latitude' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
      'longitude' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/']
    ]);

    $market = Market::findOrFail($id);

    $market->name = $request->name;
    $market->address = $request->address;
    $market->latitude = $request->latitude;
    $market->longitude = $request->longitude;

    $market->save();
  }
}
