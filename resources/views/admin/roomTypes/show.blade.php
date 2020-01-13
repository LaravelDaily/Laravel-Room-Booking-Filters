@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.roomType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.room-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.roomType.fields.id') }}
                        </th>
                        <td>
                            {{ $roomType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.roomType.fields.name') }}
                        </th>
                        <td>
                            {{ $roomType->name }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.room-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#room_type_rooms" role="tab" data-toggle="tab">
                {{ trans('cruds.room.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="room_type_rooms">
            @includeIf('admin.roomTypes.relationships.roomTypeRooms', ['rooms' => $roomType->roomTypeRooms])
        </div>
    </div>
</div>

@endsection