<?php

namespace App\Http\Controllers\Admin;

use App\Hotel;
use App\Room;
use App\RoomType;
use Carbon\CarbonPeriod;

class HomeController
{
    public function index()
    {
        $now = now()->subWeeks(5);
        $weeks = [];
        foreach(range(1,10) as $index)
        {
            $startOfWeek = $now->copy()->startOfWeek();
            $endOfWeek = $now->copy()->endOfWeek();
            array_push($weeks, [ $startOfWeek, $endOfWeek ]);
            $now->addWeek();
        }

        $selectedWeek = [];
        $weekInput = explode(' - ', request()->input('week'));
        if(count($weekInput) === 2)
        {
            $period = CarbonPeriod::create($weekInput[0], $weekInput[1]);
        }
        else
        {
            $period = CarbonPeriod::create(now()->startOfWeek(), now()->endOfWeek());
        }
        $selectedWeek = $period->toArray();

        $rooms = Room::filters()
            ->with(['hotel', 'room_type', 'roomBookings' => function($query) use ($weekInput) {
                $query->whereBetween('booking_date', count($weekInput) === 2 ? $weekInput : [ now()->startOfWeek(), now()->endOfWeek() ]);
            }])
            ->take(101)
            ->get();

        $hotels = Hotel::pluck('name', 'id');
        $roomTypes = RoomType::pluck('name', 'id');

        if($rooms->count() > 100)
        {
            $rooms = null;
        }

        return view('home', compact('rooms', 'hotels', 'roomTypes', 'weeks', 'selectedWeek'));
    }
}
