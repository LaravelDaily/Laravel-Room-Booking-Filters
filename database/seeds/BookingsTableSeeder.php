<?php

use App\Booking;
use App\Room;
use Illuminate\Database\Seeder;
use Carbon\CarbonPeriod;

class BookingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bookings = [];
        $rooms = Room::pluck('id');
        $period = CarbonPeriod::create(now(), now()->addDays(90));
        $dates = $period->toArray();

        foreach(range(1,1000) as $id)
        {
            array_push($bookings, [
                'id' => $id,
                'room_id' => $rooms->random(),
                'booking_date' => $dates[array_rand($dates, 1)]->format('Y-m-d')
            ]);
        }

        Booking::insert($bookings);
    }
}
