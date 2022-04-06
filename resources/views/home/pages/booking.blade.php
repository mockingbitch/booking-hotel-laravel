@extends('home.layout-home')
@section('content')

<div class="booking">
	<div class="container">
		<h2 class="tittle-one">BOOKING <strong>{{$room->name}}</strong></h2>
		<h3 class="tittle-one">{{$msg ?? ''}}</h3>
			<div class="reservation-form">
				<div class="col-md-3 reservation-left">
					<h3>Hotel: {{$room->hotel->name}}</h3>
					<ul>
						<li><a href="booking.html"><img src="{{asset('uploads/hotels/'.$room->hotel->image)}}" alt="" /></a></li>
					</ul>
                    <hr/>
                    <h3>Preview:</h3>
					<ul>
						<li><a href="booking.html"><img src="{{asset('uploads/rooms/'.$room->image)}}" alt="" /></a></li>
					</ul>
				</div>
				<div class="col-md-9 reservation-right">
					<form method="post">
						@csrf
						<h4>How many members?</h4>
						<div class="dropdown-button">           			
			            	<select name="members" class="dropdown" tabindex="10" data-settings='{"wrapperClass":"flat"}'>
									<option value="1">01 Member</option>
									<option value="2">02 Members</option>
									<option value="3">03 Members</option>
									<option value="4">04 Members</option>
									<option value="5">05 Members</option>
									<option value="6">06 Members</option>
									<option value="7">07 Members</option>
									<option value="8">08 Members</option>
									<option value="9">09 Members</option>
									<option value="9">10 Members</option>
									<option value="9">10+ Members</option>
 							</select>
						</div>
						<h4>Rooms</h4>
						<div class="dropdown-button">     
							<input type="hidden" name="room_id" value="{{$room->id}}"  />      			
			            	<input type="text" readonly value={{$room->type}}>
						</div>
						<h4>When would you like to come?</h4>
						<div class="book-pag">
							<div class="book-pag-frm">
								<label>Check In :</label>
								<input class="date" id="datepicker1" name="start_date" type="date" value="Date" required>
							</div>
							<div class="book-pag-frm">
								<label>Check Out:</label>
								<input class="date" id="datepicker2" name="end_date" type="date" value="Date" >
							</div>
							<div class="clearfix"></div>
						</div>	
						@if (isset($user))
							<h4>Contact details</h4>
						<input type="text" name="guest_name" value="{{$user->name}}" />
						<input type="text" name="guest_email" value="{{$user->email}}" />
						<input type="text" name="guest_phone" value="{{$user->phone}}" />
						<textarea name="note" placeholder="Message..."></textarea>
						<button class="btn1 btn-1 btn-1e" type="submit">RESERVE NOW</button>
						@else 
						<button class="btn1 btn-1 btn-1e"><a style="color: white" href="{{route('login')}}">PLEASE LOGIN TO CONTINUE</a></button>
						@endif
					</form>
					<!--strat-date-piker-->
					
					<script src="js/jquery-ui.js"></script>
							  <script>
									  $(function() {
									    $( "#datepicker,#datepicker1,#datepicker2" ).datepicker();
									  });
							  </script>
					<!--//End-date-piker-->
				</div>
				<div class="clearfix"></div>
			</div>
	</div>
</div>
@endsection