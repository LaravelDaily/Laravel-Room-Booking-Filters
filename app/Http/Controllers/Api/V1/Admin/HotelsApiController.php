<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Hotel;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHotelRequest;
use App\Http\Requests\UpdateHotelRequest;
use App\Http\Resources\Admin\HotelResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HotelsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('hotel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HotelResource(Hotel::all());
    }

    public function store(StoreHotelRequest $request)
    {
        $hotel = Hotel::create($request->all());

        return (new HotelResource($hotel))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Hotel $hotel)
    {
        abort_if(Gate::denies('hotel_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HotelResource($hotel);
    }

    public function update(UpdateHotelRequest $request, Hotel $hotel)
    {
        $hotel->update($request->all());

        return (new HotelResource($hotel))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Hotel $hotel)
    {
        abort_if(Gate::denies('hotel_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hotel->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
