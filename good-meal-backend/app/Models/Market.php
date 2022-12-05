<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\URL;

class Market extends Model {
  use HasFactory;

  protected $fillable = ['name', 'address', 'latitude', 'longitude'];

  protected $appends = array('logo_url','cover_url');


  protected function getLogoUrlAttribute() : String {
    return URL::to('/').'/storage/markets/'.$this->logo;
  }

  protected function getCoverUrlAttribute() : String {
    return URL::to('/').'/storage/markets/'.$this->cover;
  }
}
