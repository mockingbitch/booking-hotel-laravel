@extends('admin.layout')
@section('content')
<div class="card mb-4">
   <form class="mx-4 pt-4" method="post" enctype="multipart/form-data">
    @csrf
  <div class="form-group mt-4">
    <label for="inputName">Room name</label>
    <input type="text" name="name" class="form-control" id="inputName" aria-describedby="nameHelp" value="{{$room->name}}">
  </div>
    <div class="form-group mt-4">
    <label for="inputName">Description</label>
    <input type="text" name="description" class="form-control" id="inputName" aria-describedby="nameHelp" value="{{$room->description}}">
  </div>
  <div class="form-group mt-4">
    <label for="inputName">Allstock</label>
    <input type="number" name="allstock" class="form-control" id="inputName" aria-describedby="nameHelp" value="{{$room->allstock}}">
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
@endsection