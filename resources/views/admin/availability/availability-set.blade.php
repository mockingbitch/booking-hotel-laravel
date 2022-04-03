@extends('admin.layout')
@section('content')

<span style="font-size:20px; color: green">{{$msg ? $msg : ''}}</span>
<div id="create-form" class="card mb-4">
   <form class="mx-4 pt-4" method="post" enctype="multipart/form-data">
    @csrf
  <div class="form-group mt-4">
    <label for="inputName">Room name</label>
    <input type="text" name="name" class="form-control" readonly id="inputName" aria-describedby="nameHelp" value="{{$room->name}}">
  </div>
  <div class="form-group mt-4">
    <label for="inputName">Hotel</label>
    <input type="text" name="hotel" class="form-control" readonly id="inputName" aria-describedby="nameHelp" value="{{$room->hotel->name}}">
  </div>
  <div class="form-group mt-4">
    <label for="inputName">Stock</label>
    <input type="text" name="stock" class="form-control" id="inputName" aria-describedby="nameHelp" placeholder="Enter stock">
  </div>
  <div class="form-group mt-4 row">
    <div class="form-group col-6">
        <label for="inputName">Start date</label>
        <input type="date" name="start_date"  class="form-control" class="form-control"  id="inputName" aria-describedby="nameHelp">
    </div>
    <div class="form-group col-6">
        <label for="inputName">End date <small><i style="opacity: 0.7">( nullable )</i></small></label>
        <input type="date" name="end_date"  class="form-control"  id="inputName" aria-describedby="nameHelp" placeholder="Enter end date">
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection