@extends('home_parts.home_khusus_detail')

@section('content')

	@foreach($products as $product)
	<section class="parallax-window" style="background-image: url('/image/product_image/{{$image->image_name}}');">
	<!-- <section class="parallax-window" data-parallax="scroll" data-image-src="img/single_hotel_bg_1.jpg" data-natural-width="1400" data-natural-height="470"> -->
		<div class="parallax-content-2">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<span class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class=" icon-star-empty"></i></span>
						<h1>{{ $product->product_name }}</h1>
						<span>Kategori</span>
					</div>
					<div class="col-md-4">
						<div id="price_single_main" class="hotel">
							<span><sup>Rp</sup>{{ $product->price }}</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End section -->

	<main>
		<div class="container margin_60">
			<div class="row">
				<div class="col-lg-8" id="single_tour_desc">					
					<!-- Map button for tablets/mobiles -->
					<div id="Img_carousel" class="slider-pro">
						<div class="sp-slides">

							@foreach($images as $img)
							<div class="sp-slide">
								<img alt="Image" class="sp-image" src="/image/product_image/{{$img->image_name}}" data-src="/image/product_image/{{$img->image_name}}" data-small="/image/product_image/{{$img->image_name}}" data-medium="/image/product_image/{{$img->image_name}}" data-large="/image/product_image/{{$img->image_name}}" data-retina="/image/product_image/{{$img->image_name}}">
							</div>
							@endforeach
						</div>
						<div class="sp-thumbnails">
							@foreach($images as $img)
								<img alt="Image" class="sp-thumbnail" src="/image/product_image/{{$img->image_name}}">
							@endforeach
						</div>
					</div>

					<hr>

					<div class="row">
						<div class="col-lg-3">
							<h3>Description</h3>
						</div>
						<div class="col-lg-9">
							<p>
								{{ $product->description }}
							</p>
						</div>
						<!-- End col-md-9  -->
					</div>
					<!-- End row  -->

					<hr>

					<div class="row">
						<div class="col-lg-3">
							<h3>Reviews</h3>
							<a href="#" class="btn_1 add_bottom_30" data-toggle="modal" data-target="#myReview">Leave a review</a>
						</div>
						<div class="col-lg-9">
							<!-- End general_rating -->
							@foreach($product_review as $review)
								<div class="review_strip_single">
									<img src="/images/{{ $review->user->profile_image }}" alt="Image" class="rounded-circle" width="80" height="80">
									<small> - {{ $review->created_at }} -</small>
									<h4>{{ $review->user->name }}</h4>
									<p>
										"{{ $review->content }}"
									</p>
									<div class="rating">
										@for ($i = 0; $i < 5; $i++)
											@if($i < $review->rate)
										    	<i class="icon-smile voted"></i>
										    @else
										    	<i class="icon-smile"></i>
										    @endif
										@endfor
											<!-- <i class="icon-smile voted"></i>
											<i class="icon-smile voted"></i>
											<i class="icon-smile voted"></i>
											<i class="icon-smile"></i>
											<i class="icon-smile"></i> -->
									</div>

									@foreach($response as $row_resp)
										@if($row_resp->review_id == $review->id)
											<div class="review_strip_single" style="margin-left: 50px;">
												<img src="/images/{{ $row_resp->admin->profile_image }}" alt="Image" class="rounded-circle" width="80" height="80">
												<small> - {{ $row_resp->created_at }} -</small>
												<h4>{{ $row_resp->admin->name }}</h4>
												<p>
													"{{ $row_resp->content }}"
												</p>
											</div>											
										@endif										
									@endforeach

								</div>
							@endforeach
							<!-- End review strip -->
						</div>
					</div>
				</div>
				<!--End  single_tour_desc-->

				<aside class="col-lg-4">
					<form>
						<div class="box_style_1 expose">
							<h3 class="inner">Check Availability</h3>
							<div class="row">
								<div class="col-12">
									<div class="form-group">
										<label>Quantity</label>
										<div class="numbers-row">
											<input type="text" value="1" id="quantity" class="qty2 form-control" name="quantity">
										</div>
									</div>
								</div>
							</div>
							<br>

							<!-- <button class="btn_full" value="submit">
								Buy Now
							</button> -->
							<a class="btn_full" onclick="makeLink()" style="color: #fff">Buy Now</a>
							<a class="btn_full_outline" onclick="makeCartLink()"><i class=" icon-cart"></i> Add to Cart</a>
						</div>
					</form>
					<!--/box_style_1 -->
				</aside>
			</div>
			<!--End row -->
		</div>
		<!--End container -->
        
        <div id="overlay"></div>
		<!-- Mask on input focus -->
    
	</main>
	<!-- End main -->

	<script type="text/javascript">
	    function makeLink(){
	        var qtyValue = document.getElementById("quantity").value;
	        window.location.href = "/product/payment/{{ $product->id }}/"+qtyValue;
	    }
	    function makeCartLink(){
	        var qtyValue = document.getElementById("quantity").value;
	        window.location.href = "/cart/{{ $product->id }}/"+qtyValue+"/{{ Auth::user()->id }}";
	    }
	</script>
	@endforeach
@endsection