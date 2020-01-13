@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.booking.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.bookings.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="room_id">{{ trans('cruds.booking.fields.room') }}</label>
                <select class="form-control select2 {{ $errors->has('room') ? 'is-invalid' : '' }}" name="room_id" id="room_id" required>
                    @foreach($rooms as $id => $room)
                        <option value="{{ $id }}" {{ old('room_id') == $id ? 'selected' : '' }}>{{ $room }}</option>
                    @endforeach
                </select>
                @if($errors->has('room_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('room_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.booking.fields.room_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="booking_date">{{ trans('cruds.booking.fields.booking_date') }}</label>
                <input class="form-control date {{ $errors->has('booking_date') ? 'is-invalid' : '' }}" type="text" name="booking_date" id="booking_date" value="{{ old('booking_date') }}" required>
                @if($errors->has('booking_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('booking_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.booking.fields.booking_date_helper') }}</span>
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