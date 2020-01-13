<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRoomTypeRequest;
use App\Http\Requests\StoreRoomTypeRequest;
use App\Http\Requests\UpdateRoomTypeRequest;
use App\RoomType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoomTypesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('room_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roomTypes = RoomType::all();

        return view('admin.roomTypes.index', compact('roomTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('room_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.roomTypes.create');
    }

    public function store(StoreRoomTypeRequest $request)
    {
        $roomType = RoomType::create($request->all());

        return redirect()->route('admin.room-types.index');
    }

    public function edit(RoomType $roomType)
    {
        abort_if(Gate::denies('room_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.roomTypes.edit', compact('roomType'));
    }

    public function update(UpdateRoomTypeRequest $request, RoomType $roomType)
    {
        $roomType->update($request->all());

        return redirect()->route('admin.room-types.index');
    }

    public function show(RoomType $roomType)
    {
        abort_if(Gate::denies('room_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roomType->load('roomTypeRooms');

        return view('admin.roomTypes.show', compact('roomType'));
    }

    public function destroy(RoomType $roomType)
    {
        abort_if(Gate::denies('room_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roomType->delete();

        return back();
    }

    public function massDestroy(MassDestroyRoomTypeRequest $request)
    {
        RoomType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
