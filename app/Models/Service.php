<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'services';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'room_id',
        'description'
    ];

    /**
     * @return void
     */
    public function room() 
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
