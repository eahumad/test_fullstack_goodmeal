<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

class GoodMarket extends Model {
  use HasFactory;

  protected $table = 'good_market';

  /**
   * Get the market that owns the GoodMarket
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function market(): BelongsTo {
    return $this->belongsTo(Market::class, 'market_id', 'id');
  }

  /**
   * Get the good that owns the GoodMarket
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function good(): BelongsTo
  {
      return $this->belongsTo(Good::class, 'good_id', 'id');
  }
}
