@extends('home.layout-home')
@section('content')
<div class="search-page">
	<div class="container">	
		<div class="search-grids">
			<div class="col-md-3 search-grid-left">
				<div class="search-hotel">
					<h3 class="sear-head">Name contains</h3>
					<form>
						<input type="text" value="Hotel name..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Hotel name...';}" required="">
						<input type="submit" value=" ">
					</form>
				</div>
				
				<div class="range">
					<h3 class="sear-head">Average nightly rate</h3>
							<ul class="dropdown-menu6">
								<li>
									                
									<div id="slider-range"></div>							
										<input type="text" id="amount" style="border: 0; color: #ffffff; font-weight: normal;" />
									</li>			
							</ul>
							<!---->
							<script type='text/javascript'>//<![CDATA[ 
							$(window).load(function(){
							 $( "#slider-range" ).slider({
										range: true,
										min: 0,
										max: 9000,
										values: [ 50, 6000 ],
										slide: function( event, ui ) {  $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
										}
							 });
							$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );

							});//]]>  

							</script>
							
				</div>
				<div class="range-two">
					<h3 class="sear-head">Distance from</h3>
						<select class="sel">
							<option value="">Enter City Center</option>
							<option value="">Park View Center</option>
							<option value="">E Park Road</option>
							<option value="">Silver City</option>   
						</select>

							<ul class="dropdown-menu5">
								<li>
									               
									<div id="slider-range1"></div>							
										<input type="text" id="amount1" style="border: 0; color: #ffffff; font-weight: normal;" />
									</li>			
							</ul>
							<!---->
							<script type="text/javascript" src="js/jquery-ui.js"></script>
							
							<script type='text/javascript'>//<![CDATA[ 
							$(window).load(function(){
							 $( "#slider-range1" ).slider({
										range: true,
										min: 0,
										max: 6000,
										values: [ 50, 5000 ],
										slide: function( event, ui ) {  $( "#amount1" ).val( "KM-" + ui.values[ 0 ] + " - KM-" + ui.values[ 1 ] );
										}
							 });
							$( "#amount1" ).val( "KM-" + $( "#slider-range1" ).slider( "values", 0 ) + " - KM-" + $( "#slider-range1" ).slider( "values", 1 ) );

							});//]]>  

							</script>
				</div>
				<div class="single-star-bottom">
					<h3 class="sear-head">Star rating</h3>
						
							<input type="checkbox"  id="nike" value="">
							<label for="nike"><span></span><b><img src="images/st2.png" alt="" /></b></label>
						
						
							<input type="checkbox"  id="nike1" value="">
							<label for="nike1"><span></span> <b><img src="images/st3.png" alt="" /></b></label>
					
					
							<input type="checkbox"  id="nike2" value="">
							<label for="nike2"><span></span><b><img src="images/st4.png" alt="" /></b></label>
				
				
							<input type="checkbox"  id="nike3" value="">
							<label for="nike3"><span></span> <b><img src="images/st5.png" alt="" /></b></label>
				
						
							<input type="checkbox"  id="nike4" value="">
							<label for="nike4"><span></span><b><img src="images/st.png" alt="" /></b></label>
						
				</div>
				
				<div class="menu-grid">
					<ul class="menu_drop">
						<li class="item1"><a href="#"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>Features</a>
							<ul>
								<li class="subitem1"><a href="#">Roll-in shower </a></li>
								<li class="subitem2"><a href="#">Comfortable bathroom</a></li>
								<li class="subitem3"><a href="#">WI-FI facility</a></li>
							</ul>
						</li>
						<li class="item2"><a href="#"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>Facilities</a>
							<ul>
								<li class="subitem1"><a href="#">Childcare </a></li>
								<li class="subitem2"><a href="#">Gym</a></li>
								<li class="subitem3"><a href="#">Bar</a></li>
							</ul>
						</li>
						<li class="item3"><a href="#"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>Accommodation type</a>
							<ul>
								<li class="subitem1"><a href="#">Resort</a></li>
								<li class="subitem2"><a href="#">Hostel</a></li>
								<li class="subitem3"><a href="#">Apartment</a></li>
							</ul>
						</li>
						<li class="item4"><a href="#"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>Landmarks</a>
							<ul>
								<li class="subitem1"><a href="#">Mexican City</a></li>
								<li class="subitem2"><a href="#">Park View Center</a></li>
								<li class="subitem3"><a href="#">Land Park Center</a></li>
							</ul>
						</li>
						<li class="item5"><a href="#"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>Neighbourhood</a>
							<ul>
								<li class="subitem1"><a href="#">Diamond Park Colony</a></li>
								<li class="subitem2"><a href="#">E Park Road</a></li>
								<li class="subitem3"><a href="#">lake View Center</a></li>
							</ul>
						</li>
					</ul>
					<!-- script for tabs -->
						<script type="text/javascript">
							$(function() {
							
								var menu_ul = $('.menu_drop > li > ul'),
									   menu_a  = $('.menu_drop > li > a');
								
								menu_ul.hide();
							
								menu_a.click(function(e) {
									e.preventDefault();
									if(!$(this).hasClass('active')) {
										menu_a.removeClass('active');
										menu_ul.filter(':visible').slideUp('normal');
										$(this).addClass('active').next().stop(true,true).slideDown('normal');
									} else {
										$(this).removeClass('active');
										$(this).next().stop(true,true).slideUp('normal');
									}
								});
							
							});
						</script>
					<!-- script for tabs -->

				</div>
			</div>
			<div class="col-md-9 search-grid-right">
                @foreach ($hotels as $hotel)
				<div class="hotel-rooms">
					<div class="hotel-left">
						<a href="single.html"><span class="glyphicon glyphicon-bed" aria-hidden="true"></span>{{$hotel->name}}</a>
						<p>{{$hotel->description}}</p>
						<div class="hotel-left-grids">
							<div class="hotel-left-one">
								<a href="single.html"><img src="{{asset('uploads/hotels/'.$hotel->image)}}" alt="" /></a>
							</div>
							<div class="hotel-left-two">
								<div class="rating text-left">
									<span>☆</span>
									<span>☆</span>
									<span>☆</span>
									<span>☆</span>
									<span>☆</span>
								</div>
								<a href="single.html"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>{{$hotel->city}}</a>
								<p><strong>Hotline: </strong>{{$hotel->hotline}} <span> Address Detail</span></p>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="hotel-right text-right">
						<h4>=></h4>
						<br/>
						<a href="{{route('hotel.room.list', ['id' => $hotel->id])}}">Continue</a>
					</div>
					<div class="clearfix"></div>
				</div>
                @endforeach
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
@endsection