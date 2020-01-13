@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.room.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.rooms.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.room.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.room.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="hotel_id">{{ trans('cruds.room.fields.hotel') }}</label>
                <select class="form-control select2 {{ $errors->has('hotel') ? 'is-invalid' : '' }}" name="hotel_id" id="hotel_id" required>
                    @foreach($hotels as $id => $hotel)
                        <option value="{{ $id }}" {{ old('hotel_id') == $id ? 'selected' : '' }}>{{ $hotel }}</option>
                    @endforeach
                </select>
                @if($errors->has('hotel_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hotel_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.room.fields.hotel_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="room_type_id">{{ trans('cruds.room.fields.room_type') }}</label>
                <select class="form-control select2 {{ $errors->has('room_type') ? 'is-invalid' : '' }}" name="room_type_id" id="room_type_id" required>
                    @foreach($room_types as $id => $room_type)
                        <option value="{{ $id }}" {{ old('room_type_id') == $id ? 'selected' : '' }}>{{ $room_type }}</option>
                    @endforeach
                </select>
                @if($errors->has('room_type_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('room_type_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.room.fields.room_type_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection