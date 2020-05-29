@extends('home_parts.home_app')

@section('content')

	@foreach($products as $product)
	<section id="hero_2" style="background: url('/image/product_image/{{$image->image_name}}');">
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

				<div class="col-3 bs-wizard-step complete">
					<div class="text-center bs-wizard-stepnum">Your details</div>
					<div class="progress">
						<div class="progress-bar"></div>
					</div>
					<a href="/product/payment/{{$product->id}}/{{$product_qty}}" class="bs-wizard-dot"></a>
				</div>

				<div class="col-3 bs-wizard-step active">
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
					<form action="/product/transaction/store" method="POST">
						{{ csrf_field() }}
						<div class="form_title">
							<h3><strong>2</strong>Choose @foreach($couriers as $courier_name) {{ $courier_name->courier }} @endforeach Courier Service</h3>
							<p>
								Insert your billing address for the product shipping
							</p>
						</div>
						<div class="step">
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label>@foreach($couriers as $courier_name) {{ $courier_name->courier }} @endforeach Courier Service</label>
										<select class="form-control" name="shipping_cost" id="shipping_cost">
											@foreach ($shippingCost as $shipCost) 
									            @foreach ($shipCost->costs as $costs) 
									                <option value="@foreach ($costs->cost as $cost) {{ $cost->value }} @endforeach">{{ $costs->service }} - {{ $costs->description }}</option>
									            @endforeach
									        @endforeach
										</select>
									</div>
								</div>								
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label>Street line address</label>
										<input type="text" id="street_1" name="address" class="form-control">
									</div>
								</div>
							</div>
						</div>

						<?php 
							foreach ($costs->cost as $cost) {
								$shipping_cost = $cost->value;
							}
							$sub_total = $product->price * $product_qty;
							$total = $product->price * $product_qty + $shipping_cost;
							foreach ($couriers as $courier_name) {
								$courier_id = $courier_name->id;
							}
						 ?>	
						<input type="hidden" name="timeout" id="transaction_timeout">	
						<input type="hidden" name="regency" value="{{ $regency }}">	
						<input type="hidden" name="province" value="{{ $province }}">				
						<input type="hidden" name="sub_total" value="{{ $sub_total }}">
						<input type="hidden" name="total" value="{{ $total }}">
						<input type="hidden" name="shipping_temporary" value="0">
						<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
						<input type="hidden" name="status" value="unverified">						
						<input type="hidden" name="product_id" value="{{ $product->id }}">
						<input type="hidden" name="product_qty" value="{{ $product_qty }}">
						<input type="hidden" name="courier_id" value="{{ $courier_id }}">
						<input type="hidden" name="selling_price" value="{{ $product->price }}">

						<div id="policy">
							<!-- <h4>Cancellation policy</h4>
							<div class="form-group">
								<label>
									<input type="checkbox" name="policy_terms" id="policy_terms">I accept terms and conditions and general policy.</label>
							</div> -->
							<button class="btn_1 green medium" value="submit">buy now</button>
						</div>
					</form>
				</div>

				<aside class="col-lg-4">
					<div class="box_style_1">
						<h3 class="inner">- Summary -</h3>
						<table class="table table_summary">
							<tbody>

								@foreach($products as $product)
								<tr>
									<td>
										{{ $product->product_name }}
									</td>
									<td class="text-right">
										{{ $product_qty }}
									</td>
								</tr>
								@endforeach

								<tr class="total">
									<td>
										Sub Total
									</td>
									<td class="text-right">
										<?php 
											$total_price = $product->price * $product_qty;
										 ?>
										{{ $total_price }}
									</td>
								</tr>
							</tbody>
						</table>
						<a class="btn_full_outline" href="product/{{ $product->id }}"><i class="icon-right"></i> Modify your search</a>
					</div>
				</aside>

			</div>
			<!--End row -->
		</div>
		<!--End container -->
	</main>
	<!-- End main -->
	<script type="text/javascript">
	    function makeLink(){
	        var qtyValue = document.getElementById("quantity").value;
	        window.location.href = "/product/payment/{{ $product->id }}/"+qtyValue;
	    }
	</script>

	@endforeach
@endsection