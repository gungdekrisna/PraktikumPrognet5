@extends('home_parts.home_app')

@section('content')

	<main>
		<div id="position">
			<div class="container">
				<ul>
					<li><a href="#">Home</a>
					</li>
					</li>
					<li>myCart</li>
				</ul>
			</div>
		</div>
		<!-- End Position -->
		
		<div class="container margin_60">
			<div class="cart-section">
				<table class="table table-striped cart-list shopping-cart">
					<thead>
						<tr>
							<th>
								Product
							</th>
							<th>
								Price
							</th>
							<th>
								Quantity
							</th>
							<th>
								Total
							</th>
							<th>
								Remove
							</th>
						</tr>
					</thead>
					<tbody>
						<?php $total_order = 0; ?>
						@foreach($carts as $cart)
							<tr>
								<td>
									<!-- <div class="thumb_cart">
										<a href="#"><img src="img/products/thumb-3.jpg" alt="">
										</a>
									</div> -->
									<a href="/product/{{ $cart->product->id }}" style="margin: 0;">{{ $cart->product->product_name }}</a>
								</td>
								<td>
									<strong>{{ $cart->product->price }}</strong>
								</td>
								<td>
									<div class="numbers-row">
										<input type="text" value="{{ $cart->qty }}" id="quantity_1" class="qty2 form-control" name="quantity_1">
									</div>
								</td>
								<td>
									<?php 
										$total = $cart->product->price * $cart->qty;
										$total_order = $total_order + $total;
									 ?>
									<strong>{{ $total }}</strong>
								</td>
								<td class="options">
									<a href="/cancel-cart/{{ $cart->id }}"><i class=" icon-trash"></i></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>

				<div class="cart-options clearfix">
					<div class="float-md-right fix_mobile">
						<a href="/home" class="btn_cart_outine">Update Cart</a>
					</div>
				</div>
				<div class="row justify-content-end">
					<div class="column col-lg-4 col-md-6">
						<ul class="totals-table">

							<li class="clearfix total"><span class="col">Order Total</span><span class="col">{{ $total_order }}</span>
							</li>
						</ul>
						<a href="/cart-checkout/{{ Auth::user()->id }}" class="btn_full">Proceed to Checkout <i class="icon-left"></i></a>
					</div>
				</div>
			</div>
		</div>
		<!-- End Container -->
	</main>

@endsection