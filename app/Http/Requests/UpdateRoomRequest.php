<?php

namespace App\Http\Requests;

use App\Room;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateRoomRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('room_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name'         => [
                'required',
            ],
            'hotel_id'     => [
                'required',
                'integer',
            ],
            'room_type_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
