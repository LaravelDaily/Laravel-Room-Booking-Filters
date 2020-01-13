<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
            ],
            [
                'id'    => '17',
                'title' => 'hotel_create',
            ],
            [
                'id'    => '18',
                'title' => 'hotel_edit',
            ],
            [
                'id'    => '19',
                'title' => 'hotel_show',
            ],
            [
                'id'    => '20',
                'title' => 'hotel_delete',
            ],
            [
                'id'    => '21',
                'title' => 'hotel_access',
            ],
            [
                'id'    => '22',
                'title' => 'room_type_create',
            ],
            [
                'id'    => '23',
                'title' => 'room_type_edit',
            ],
            [
                'id'    => '24',
                'title' => 'room_type_show',
            ],
            [
                'id'    => '25',
                'title' => 'room_type_delete',
            ],
            [
                'id'    => '26',
                'title' => 'room_type_access',
            ],
            [
                'id'    => '27',
                'title' => 'room_create',
            ],
            [
                'id'    => '28',
                'title' => 'room_edit',
            ],
            [
                'id'    => '29',
                'title' => 'room_show',
            ],
            [
                'id'    => '30',
                'title' => 'room_delete',
            ],
            [
                'id'    => '31',
                'title' => 'room_access',
            ],
            [
                'id'    => '32',
                'title' => 'booking_create',
            ],
            [
                'id'    => '33',
                'title' => 'booking_edit',
            ],
            [
                'id'    => '34',
                'title' => 'booking_show',
            ],
            [
                'id'    => '35',
                'title' => 'booking_delete',
            ],
            [
                'id'    => '36',
                'title' => 'booking_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
