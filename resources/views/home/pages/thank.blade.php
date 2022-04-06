@extends('home.layout-home')
@section('content')

<h1>{{$msg ? $msg : 'Something went wrong'}} </h1>
<h2>Go to <a href="{{route('home')}}">Homepage</a></h2>
@endsection