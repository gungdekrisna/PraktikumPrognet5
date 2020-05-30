@extends('home_parts.home_app')

@section('content')
        <!-- <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in as regular User (Pembeli)!
                    <br><img src="{{ URL::to('/') }}/images/{{ Auth::user()->profile_image }}" width="120" height="auto">
                </div>
            </div>
        </div> -->

        <main style="width: 100%">
            <!-- <div id="position">
                <div class="container">
                    <ul>
                        <li><a href="#">Home</a>
                        </li>
                        <li><a href="#">Category</a>
                        </li>
                        <li>Page active</li>
                    </ul>
                </div>
            </div> -->
            <!-- Position -->

            <div class="collapse" id="collapseMap">
                <div id="map" class="map"></div>
            </div>
            <!-- End Map -->

            <div class="container">
                <div class="row">
                    @include('home_parts.tools_sidebar')

                    <div class="col-lg-9">

                        <div id="tools">
                            <div class="row">
                                <div class="col-md-3 col-sm-4 col-6">
                                    <div class="styled-select-filters">
                                        <select name="sort_price" id="sort_price">
                                            <option value="" selected>Sort by price</option>
                                            <option value="lower">Lowest price</option>
                                            <option value="higher">Highest price</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-6">
                                    <div class="styled-select-filters">
                                        <select name="sort_rating" id="sort_rating">
                                            <option value="" selected>Sort by ranking</option>
                                            <option value="lower">Lowest ranking</option>
                                            <option value="higher">Highest ranking</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-4 d-none d-sm-block text-right">
                                    <a href="#" class="bt_filters"><i class="icon-th"></i></a> <a href="all_hotels_list.html" class="bt_filters"><i class=" icon-list"></i></a>
                                </div>
                            </div>
                        </div>
                        <!--End tools -->
                        
                        <div class="row">
                            @foreach($products as $product)
                            <?php 
                                /*$servername = "localhost";
                                $username = "username";
                                $password = "password";
                                $dbname = "myDB";*/

                                // Create connection
                                $conn = new mysqli("localhost", "root", "gungkrisna", "db_paktikum_prognet");
                                // Check connection
                                if ($conn->connect_error) {
                                  die("Connection failed: " . $conn->connect_error);
                                }

                                $sql = "SELECT * FROM product_images WHERE product_id = ". $product->id ." LIMIT 1";
                                $result = $conn->query($sql);

                                while ($row = $result->fetch_assoc()) {
                                    $product_image = $row["image_name"];
                                }
                            ?>
                            <div class="col-md-6 wow zoomIn" data-wow-delay="0.1s">
                                <div class="hotel_container">
                                    <div class="img_container">
                                        <a href="single_hotel.html">
                                            <img src="/image/product_image/{{$product_image}}" width="800" height="533" class="img-fluid" alt="Image">
                                        </a>
                                    </div>
                                    <div class="hotel_title">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h3><strong>{{ $product->product_name }}</strong></h3>
                                                <div class="rating">
                                                    <i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star-empty"></i>
                                                </div>
                                            </div>  
                                            <div class="col-md-6">
                                                <div class="price"><sup>Rp</sup>{{ $product->price }}</div>
                                            </div> 
                                        </div>     

                                        <div class="row" style="margin-top: 15px;">
                                            <div class="col-md-12">
                                                <a class="btn_full" href="product/{{ $product->id }}" style="color: #fff">DETAILS</a>
                                            </div>
                                            <!-- <div class="col-md-6">
                                                <a class="btn_full_outline" style="color: #85c99d">
                                                    <i class=" icon-cart"></i> ADD TO CART
                                                </a>
                                            </div> -->
                                        </div>                                        
                                    </div>
                                </div>
                                <!-- End box tour -->
                            </div>
                            <!-- End col-md-6 -->
                            @endforeach
                        </div>
                        <!-- End row -->

                        <hr>
                        
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item active"><span class="page-link">1<span class="sr-only">(current)</span></span>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <!-- end pagination-->

                    </div>
                    <!-- End col lg 9 -->
                </div>
                <!-- End row -->
            </div>
            <!-- End container -->
        </main>
        <!-- End main -->
@endsection
