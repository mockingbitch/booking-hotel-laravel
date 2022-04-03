@extends('admin.layout')
@section('content')
<div class="card mb-4">
        @if (count($bookings) >= 1)          
            <div class="card-header pb-0">
              <h6>Bookings table</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Guest</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Booking Handler</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Booking date</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($bookings as $booking)                          
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$booking->guest->name}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs text-secondary mb-0">
                          {{$booking->admin->name}}
                        </p>
                      </td>
                      <td>
                        <p class="text-xs text-secondary mb-0">
                          {{$booking->total}}
                        </p>
                      </td>
                      <td class="align-middle text-center text-sm">
                            <h6 class="mb-0 text-sm">{{date('d-m-Y', $booking->date)}}</h6>
                      </td>
                      <td class="align-middle text-center text-sm">
                            <h6 class="mb-0 text-sm">
                              @foreach ($codes as $code)
                                  {{$code->key == $booking->status ? $code->value_vi : ''}}
                              @endforeach  
                            </h6>
                      </td>
                      <td class="align-middle" style="font-size:20px">
                        <a href="{{route('room.show',['id'=>$booking->id])}}" class="text-secondary mx-1 font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          <i style="font-size:20px" class="fa-solid fa-eye"></i>
                        </a>
                      </td>
                    </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        @else 
        <h2 class="my-4 mx-4">No booking found</h2>
        @endif

@endsection