@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Dashboard
                </div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form class="form-inline">
                        <select class="custom-select mb-2 mr-sm-2" id="week" name="week">
                            <option value="">Choose week</option>
                            @foreach($weeks as $week)
                                <option
                                    value="{{ $week[0]->format('Y-m-d') }} - {{ $week[1]->format('Y-m-d') }}"
                                    {{ request()->input('week') === $week[0]->format('Y-m-d').' - '.$week[1]->format('Y-m-d') ? 'selected' : ''  }}
                                >{{ $week[0]->format('m/d/Y') }} - {{ $week[1]->format('m/d/Y') }}</option>
                            @endforeach
                        </select>

                        <select class="custom-select mb-2 mr-sm-2" id="hotel" name="hotel">
                            <option value="">Choose hotel</option>
                            @foreach($hotels as $id=>$name)
                                <option value="{{ $id }}" {{ request()->input('hotel') == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>

                        <select class="custom-select mb-2 mr-sm-2" id="room_type" name="room_type">
                            <option value="">Choose room type</option>
                            @foreach($roomTypes as $id=>$name)
                                <option value="{{ $id }}" {{ request()->input('room_type') == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>

                        <input
                            type="text"
                            class="form-control mb-2 mr-sm-2"
                            id="room"
                            name="room"
                            placeholder="Room"
                            value="{{ request()->input('room') }}"
                        >

                        <button type="submit" class="btn btn-primary mb-2">Submit</button>
                    </form>
                    @if($rooms !== null)
                        <div class="table-responsive">
                            <table class=" table table-bordered table-striped table-hover datatable datatable-Hotel">
                                <thead>
                                    <tr>
                                        <th>
                                            Hotel
                                        </th>
                                        <th>
                                            Room Type
                                        </th>
                                        <th>
                                            Room
                                        </th>
                                        @foreach($selectedWeek as $day)
                                            <th>
                                                {{ $day->format('m/d/Y') }}
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rooms as $room)
                                        <tr>
                                            <td>
                                                {{ $room->hotel->name }}
                                            </td>
                                            <td>
                                                {{ $room->room_type->name }}
                                            </td>
                                            <td>
                                                {{ $room->name }}
                                            </td>
                                            @foreach($selectedWeek as $day)
                                                <td>
                                                    <div class="form-check">
                                                        <input
                                                            class="form-check-input booking-checkbox"
                                                            type="checkbox"
                                                            {{ $room->roomBookings->where('booking_date', $day->format('m/d/Y'))->first() ? 'checked' : '' }}
                                                            data-booked="{{ optional($room->roomBookings->where('booking_date', $day->format('m/d/Y'))->first())->id ?? '' }}"
                                                            data-day="{{ $day->format('m/d/Y') }}"
                                                            data-room="{{ $room->id }}"
                                                        >
                                                    </div>
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>
                            Your filter returns more than 100 rooms. Please choose more options to narrow down your search.
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
$(document).ready(() => {
    $('.booking-checkbox').change(function() {
        var checkbox = this;
        if(this.checked) {
            $.ajax({
                url: "{{ route('api.bookings.store') }}",
                method: "post",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: {
                    room_id: $(this).data('room'),
                    booking_date: $(this).data('day')
                }
            }).done(({data}) => {
                $(this).prop("checked", true);
                $(this).attr('data-booked', data.id);
                Swal.fire(
                    'Good job!',
                    'Booking for room '+data.room.name+' on '+data.booking_date+' is added',
                    'success'
                );
            }).fail(function(data) {
                console.log(data);
                Swal.fire(
                    'Whoops!',
                    'There was an error! Check console',
                    'error'
                );
            });
        }
        else
        {
            $.ajax({
                url: "{{ route('api.bookings.destroy', "") }}/"+$(this).attr('data-booked'),
                method: "delete",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            }).done(({data}) => {
                console.log(data);
                $(this).prop("checked", false);
                $(this).attr('data-booked', '');
                Swal.fire(
                    'Good job!',
                    'Booking for room '+data.room.name+' on '+data.booking_date+' is deleted',
                    'success'
                );
            }).fail(function(data) {
                console.log(data);
                Swal.fire(
                    'Whoops!',
                    'There was an error! Check console',
                    'error'
                );
            });
        }
    });
});
</script>
@endsection
