@extends('admin.layout')
@section('content')
<div class="card mb-4">
        @if (count($users) >= 1)          
            <div class="card-header pb-0">
              <h6>Users table</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Phone</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">CCCD</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Verify</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Position</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($users as $item)                          
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$item->name}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs text-secondary mb-0">
                          {{$item->email}}
                        </p>
                      </td>
                      <td>
                        <p class="text-xs text-secondary mb-0">
                          {{$item->phone}}
                        </p>
                      </td>
                      <td class="align-middle text-center text-sm">
                            <h6 class="mb-0 text-sm">{{$item->cccd}}</h6>
                      </td>
                      <td class="align-middle text-center text-sm">
                            <h6 class="mb-0 text-sm">
                              @foreach ($codes as $code)
                                  {{$code->key == $item->isVerify ? $code->value_vi : ''}}
                              @endforeach  
                            </h6>
                      </td>
                      <td class="align-middle text-center text-sm">
                            <h6 class="mb-0 text-sm">
                              @foreach ($codes as $code)
                                  {{$code->key == $item->position ? $code->value_vi : ''}}
                              @endforeach
                            </h6>
                      </td>
                      <td class="align-middle" style="font-size:20px">
                        <a href="{{route('room.show',['id'=>$item->id])}}" class="text-secondary mx-1 font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          <i style="font-size:20px" class="fa-solid fa-pen-to-square"></i>
                        </a>
                        @if ($user->position == 'AD')
                          <a onclick="return confirm('Are you sure you want to delete this?')" href="{{route('room.delete',['id'=>$item->id])}}" class="text-secondary mx-1 font-weight-bold text-xs" data-toggle="tooltip">
                          <i style="font-size:20px" class="fa-solid fa-trash"></i>
                        </a>
                        @endif
                      </td>
                    </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        @else 
        <h2 class="my-4 mx-4">No user found</h2>
        @endif

@endsection