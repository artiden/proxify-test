<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dream extends Model
{
    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = [
        'short_description', 'link', 'description', 'needed',
    ];

    /**
     * Get a creator of the dream
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Return collected percentage money
     * 
     * @return float
     */
    public function getCollectedPercentageAttribute() : float
    {
        return round(100 * $this->collected / $this->needed, 2);
    }
}
