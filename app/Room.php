<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use SoftDeletes;

    public $table = 'rooms';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'hotel_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'room_type_id',
    ];

    public function roomBookings()
    {
        return $this->hasMany(Booking::class, 'room_id', 'id');
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }

    public function room_type()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }

    public function scopeFilters($query)
    {
        return $query
            ->when(request()->input('hotel'), function ($query) {
                $query->where('hotel_id', request()->input('hotel'));
            })
            ->when(request()->input('room_type'), function ($query) {
                $query->where('room_type_id', request()->input('room_type'));
            })
            ->when(request()->input('room'), function ($query) {
                $query->where('name', 'LIKE', '%'.request()->input('room').'%');
            });
    }
}
