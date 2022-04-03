@extends('admin.layout')
@section('content')
<div class="card mb-4">
    <h2 class="mt-4 mb-4 mx-4">Welcome to Booking Hotel: {{$user ? $user->name : ''}}</h2>
</div>
@endsection 