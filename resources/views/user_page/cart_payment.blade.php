@extends('home_parts.home_app')

@section('content')

	<section id="hero_2" style="background-color: #e04f67;">
		<div class="intro_title">
			<h1>Place your order</h1>
			<div class="bs-wizard row">

				<div class="col-3 bs-wizard-step complete">
					<div class="text-center bs-wizard-stepnum">Your cart</div>
					<div class="progress">
						<div class="progress-bar"></div>
					</div>
					<a href="cart_hotel.html" class="bs-wizard-dot"></a>
				</div>

				<div class="col-3 bs-wizard-step active">
					<div class="text-center bs-wizard-stepnum">Your details</div>
					<div class="progress">
						<div class="progress-bar"></div>
					</div>
					<a href="#" class="bs-wizard-dot"></a>
				</div>

				<div class="col-3 bs-wizard-step disabled">
					<div class="text-center bs-wizard-stepnum">Courier Service</div>
					<div class="progress">
						<div class="progress-bar"></div>
					</div>
					<a href="#" class="bs-wizard-dot"></a>
				</div>

				<div class="col-3 bs-wizard-step disabled">
					<div class="text-center bs-wizard-stepnum">Finish!</div>
					<div class="progress">
						<div class="progress-bar"></div>
					</div>
					<a href="confirmation_hotel.html" class="bs-wizard-dot"></a>
				</div>

			</div>
			<!-- End bs-wizard -->
		</div>
		<!-- End intro-title -->
	</section>
	<!-- End Section hero_2 -->

		<main>
		<div class="container margin_60">
			<div class="row">
				<div class="col-lg-8 add_bottom_15">
					<form action="/cart/buy" method="POST">
						{{ csrf_field() }}
						<div class="form_title">
							<h3><strong>1</strong>Billing Address</h3>
							<p>
								Insert your billing address for the product shipping
							</p>
						</div>
						<div class="step">
							<div class="row">
								<!-- <div class="col-sm-6">
									<div class="form-group">
										<label>Province</label>
										<select class="form-control" name="province" id="province">
											@foreach($provinces as $province)
											<option value="{{$province->province}}">{{$province->province}}</option>
											@endforeach
										</select>
									</div>
								</div> -->
								<div class="col-sm-12">
									<div class="form-group">
										<label>Regency</label>
										<select class="form-control" name="regency" id="regency">
											@foreach($regencies as $regency)
											<option value="{{$regency->city_id}}">{{$regency->city_name}}, {{$regency->province}}</option>
											@endforeach
										</select>
									</div>
								</div>								
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>Courier</label>
										<select class="form-control" name="courier_id" id="courier">
											@foreach($couriers as $courier)
											<option value="{{ $courier->courier_code }}">{{ $courier->courier }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>
						<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">						
						

						<div id="policy">
							<!-- <h4>Cancellation policy</h4>
							<div class="form-group">
								<label>
									<input type="checkbox" name="policy_terms" id="policy_terms">I accept terms and conditions and general policy.</label>
							</div> -->
							<button class="btn_1 green medium" value="submit">Next Step</button>
						</div>
					</form>
				</div>

				<aside class="col-lg-4">
					<div class="box_style_1">
						<h3 class="inner">- Summary -</h3>
						<table class="table table_summary">
							<tbody>
								<?php $total_order = 0; ?>
								@foreach($carts as $cart)
								<tr>
									<td>
										{{ $cart->qty }} {{ $cart->product->product_name }}
									</td>
									<td class="text-right">
										<?php $total_price = $cart->product->price * $cart->qty ?>
										Rp. {{ $total_price }}
										<?php $total_order = $total_order + $total_price; ?>
									</td>
								</tr>
								@endforeach

								<tr class="total">
									<td>
										Sub Total
									</td>
									<td class="text-right">
										Rp. {{ $total_order }}
									</td>
								</tr>
							</tbody>
						</table>
						<a class="btn_full_outline" href="myCart/"><i class="icon-right"></i> Modify your search</a>
					</div>
				</aside>

			</div>
			<!--End row -->
		</div>
		<!--End container -->
	</main>
	<!-- End main -->

@endsection