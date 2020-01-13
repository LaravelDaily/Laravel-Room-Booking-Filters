<?php

use App\Hotel;
use App\RoomType;
use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hotels = Hotel::all();
        $roomTypes = RoomType::pluck('id');

        foreach($hotels as $hotel)
        {
            for($i = 1; $i <= mt_rand(100,500); $i++)
            {
                $hotel->hotelRooms()->create([
                    'name' => mt_rand(100,999),
                    'room_type_id' => $roomTypes->random()
                ]);
            }
        }
    }
}
