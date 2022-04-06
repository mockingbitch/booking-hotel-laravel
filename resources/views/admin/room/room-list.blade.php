@extends('admin.layout')
@section('content')
<div class="create-btn mx-3 my-3">
    <button onclick="create()" class="btn btn-primary "style="all: unset; cursor: pointer; font-size:20px; color: green; z-index: 1999"><i class="fa-solid fa-circle-plus">Add new</i></button>
</div>
<span style="font-size:20px; color: green">{{$msg ? $msg : ''}}</span>
<div id="create-form" style="display: none" class="card mb-4">
   <form class="mx-4 pt-4" method="post" enctype="multipart/form-data">
    @csrf
  <div class="form-group mt-4">
    <label for="inputName">Room name</label>
    <input type="text" name="name" class="form-control" id="inputName" aria-describedby="nameHelp" placeholder="Enter room name">
  </div>
  <div class="form-group mt-4">
    <label for="inputName">Description</label>
    <input type="text" name="description" class="form-control" id="inputName" aria-describedby="nameHelp" placeholder="Enter description">
  </div>
   <div class="form-group mt-4">
    <label for="inputName">Allstock</label>
    <input type="number" name="allstock" class="form-control" id="inputName" aria-describedby="nameHelp" placeholder="Enter number of stock">
  </div>
  <div class="form-group">
    <label for="inputCity">Type</label>
    <select name="type" class="form-control">
        @foreach ($types as $type)
            <option value="{{$type->key}}">{{$type->value_vi}}</option>
        @endforeach
    </select>
  </div>
   <div class="form-group">
    <label for="inputHotline">Hotel</label>
        <select name="hotel_id" class="form-control">
            @foreach ($hotels as $hotel)
                <option value="{{$hotel->id}}">{{$hotel->name}}</option>
            @endforeach
        </select>  
    </div>
  <div class="form-group">
    <label for="inputImage">Image</label>
    <input type="file" class="form-control" name="image" id="inputImage" placeholder="Upload image">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<div class="card mb-4">
        @if (count($rooms) >= 1)          
            <div class="card-header pb-0">
              <h6>Rooms table</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Room</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Type</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Allstock</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hotel</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Set Availability</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Set Amount</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($rooms as $room)                          
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="{{asset('uploads/rooms/'.$room->image)}}" class="avatar avatar-lg me-3" alt="user1">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$room->name}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs text-secondary mb-0">
                          @foreach ($types as $type)
                              {{$type->key == $room->type ? $type->value_vi : ''}}
                          @endforeach
                        </p>
                      </td>
                      <td>
                        <p class="text-xs text-secondary mb-0">
                          {{$room->allstock}}
                        </p>
                      </td>
                      <td class="align-middle text-center text-sm">
                            <h6 class="mb-0 text-sm">{{$room->hotel->name}}</h6>
                      </td>
                      <td class="align-middle text-center text-sm">
                          <a href="{{route('availability.set', ['id'=>$room->id])}}" class="text-secondary mx-1 font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          <i style="font-size:20px" class="fa-solid fa-calendar-check"></i>
                        </a>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <a href="{{route('amount.set',['id'=>$room->id])}}" class="text-secondary mx-1 font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                         <i style="font-size:20px" class="fa-solid fa-money-bill-transfer"></i>
                        </a>
                      </td>
                      <td class="align-middle" style="font-size:20px">
                        <a href="{{route('room.show',['id'=>$room->id])}}" class="text-secondary mx-1 font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          <i style="font-size:20px" class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a onclick="return confirm('Are you sure you want to delete this?')" href="{{route('room.delete',['id'=>$room->id])}}" class="text-secondary mx-1 font-weight-bold text-xs" data-toggle="tooltip">
                          <i style="font-size:20px" class="fa-solid fa-trash"></i>
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
        <h2 class="my-4 mx-4">No room found</h2>
        @endif
<script>
 function create() {
  var x = document.getElementById("create-form");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>
@endsection