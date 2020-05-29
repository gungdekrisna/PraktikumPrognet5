@extends('home_parts.home_app')

@section('content')

@foreach($transactions as $transaction)
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

				<div class="col-3 bs-wizard-step complete">
					<div class="text-center bs-wizard-stepnum">Your details</div>
					<div class="progress">
						<div class="progress-bar"></div>
					</div>
					<a href="" class="bs-wizard-dot"></a>
				</div>

				<div class="col-3 bs-wizard-step complete">
					<div class="text-center bs-wizard-stepnum">Courier Service</div>
					<div class="progress">
						<div class="progress-bar"></div>
					</div>
					<a href="#" class="bs-wizard-dot"></a>
				</div>

				<div class="col-3 bs-wizard-step active">
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

					<div class="form_title">
						<h3><strong><i class="icon-ok"></i></strong>Pay and upload proof of payment immediately!</h3>
						<p>
							Upload proof of payment before timeout.
						</p>
					</div>					
					<div class="step" style="font-size: 15px;">
					This order will be expire in ...<div id="demo" style="font-size: 25px"></div>						
					</div>
					<!--End step -->

					<div class="form_title">
						<h3><strong><i class="icon-tag-1"></i></strong>Order summary</h3>
						<p>
							See the order summary.
						</p>
					</div>
					<div class="step">
						<table class="table table-striped confirm">
							<thead>
								<tr>
									<th colspan="2">
										Shipping destination
									</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<strong>Address</strong>
									</td>
									<td>
										{{ $transaction->address }}
									</td>
								</tr>
								<tr>
									<td>
										<strong>Regency</strong>
									</td>
									<td>
										{{ $transaction->regency }}
									</td>
								</tr>
								<tr>
									<td>
										<strong>Province</strong>
									</td>
									<td>
										{{ $transaction->province }}
									</td>
								</tr>
								<tr>
									<td>
										<strong>Courier</strong>
									</td>
									<td>
										@foreach($couriers as $courier)
											{{ $courier->courier }}
										@endforeach
									</td>
								</tr>
								<tr>
									<td>
										<strong>Shipping Cost</strong>
									</td>
									<td>
										Rp. {{ $transaction->shipping_cost }}
									</td>
								</tr>
								<tr>
									<td>
										<strong>Total</strong>
									</td>
									<td>
										Rp. {{ $transaction->total }}
									</td>
								</tr>
								<tr>
									<td>
										<strong>Status</strong>
									</td>
									<td>
										{{ $transaction->status }}
									</td>
								</tr>
							</tbody>
						</table>
						<?php $hitung = 1; ?>
						@foreach($transaction_details as $transaction_detail)
							<table class="table table-striped confirm">
								<thead>
									<tr>
										<th colspan="2">
											Item {{ $hitung }}
										</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<strong>Product</strong>
										</td>
										<td>
											{{ $transaction_detail->product->product_name }}
										</td>
									</tr>
									<tr>
										<td>
											<strong>Quantity</strong>
										</td>
										<td>
											{{ $transaction_detail->qty }}
										</td>
									</tr>
									<tr>
										<td>
											<strong>Selling Price</strong>
										</td>
										<td>
											{{ $transaction_detail->selling_price }}
										</td>
									</tr>
								</tbody>
							</table>
							<?php $hitung++ ?>
						@endforeach
					</div>
					<!--End step -->
				</div>
				<!--End col -->

				<aside class="col-lg-4">
					<div class="box_style_1">
						<h3 class="inner">Upload Proof of Payment</h3>
						<p>
							Upload your proof of payment here before the order period is expired.
							<br>
							If you want to cancel the order, you can cancel it only if you have not yet upload the proof of payment.
						</p>
						<hr>
						<form action="">
							<input type="file" name="proof_of_payment">
							<div class="row">
								<div class="col-lg-12">
									<button class="btn_1 green medium" value="submit" style="width: 100%; margin-top: 10px; margin-bottom: 10px;">upload</button>
								</div>
								<div class="col-lg-12">
									<button class="btn_1 medium" value="submit" style="width: 100%; background-color: #ef4b4b;">cancel order</button>
								</div>
							</div>							
						</form>						
					</div>
				</aside>

			</div>
			<!--End row -->
		</div>
		<!--End container -->
	</main>
	<!-- End main -->
	<script type="text/javascript">
		// Set the date we're counting down to
		var countDownDate = new Date("2020-05-30 22:02:47").getTime();

		// Update the count down every 1 second
		var x = setInterval(function() {

		  // Get today's date and time
		  var now = new Date().getTime();

		  // Find the distance between now and the count down date
		  var distance = countDownDate - now;

		  // Time calculations for days, hours, minutes and seconds
		  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

		  // Display the result in the element with id="demo"
		  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
		  + minutes + "m " + seconds + "s ";

		  // If the count down is finished, write some text
		  if (distance < 0) {
		    clearInterval(x);
		    document.getElementById("demo").innerHTML = "EXPIRED";
		  }
		}, 1000);
	</script>
@endforeach

@endsection