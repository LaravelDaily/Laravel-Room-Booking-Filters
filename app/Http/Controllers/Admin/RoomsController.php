<?php

namespace App\Http\Controllers\Admin;

use App\Hotel;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRoomRequest;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Room;
use App\RoomType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RoomsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Room::with(['hotel', 'room_type'])->select(sprintf('%s.*', (new Room)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'room_show';
                $editGate      = 'room_edit';
                $deleteGate    = 'room_delete';
                $crudRoutePart = 'rooms';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->addColumn('hotel_name', function ($row) {
                return $row->hotel ? $row->hotel->name : '';
            });

            $table->addColumn('room_type_name', function ($row) {
                return $row->room_type ? $row->room_type->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'hotel', 'room_type']);

            return $table->make(true);
        }

        return view('admin.rooms.index');
    }

    public function create()
    {
        abort_if(Gate::denies('room_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hotels = Hotel::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $room_types = RoomType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.rooms.create', compact('hotels', 'room_types'));
    }

    public function store(StoreRoomRequest $request)
    {
        $room = Room::create($request->all());

        return redirect()->route('admin.rooms.index');
    }

    public function edit(Room $room)
    {
        abort_if(Gate::denies('room_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hotels = Hotel::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $room_types = RoomType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $room->load('hotel', 'room_type');

        return view('admin.rooms.edit', compact('hotels', 'room_types', 'room'));
    }

    public function update(UpdateRoomRequest $request, Room $room)
    {
        $room->update($request->all());

        return redirect()->route('admin.rooms.index');
    }

    public function show(Room $room)
    {
        abort_if(Gate::denies('room_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $room->load('hotel', 'room_type', 'roomBookings');

        return view('admin.rooms.show', compact('room'));
    }

    public function destroy(Room $room)
    {
        abort_if(Gate::denies('room_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $room->delete();

        return back();
    }

    public function massDestroy(MassDestroyRoomRequest $request)
    {
        Room::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
