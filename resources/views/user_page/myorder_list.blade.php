@extends('home_parts.home_app')

@section('content')

    <main>
        <div class="container margin_60">
            <div class="row">
                <div class="col-lg-12">

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

                    @foreach($transactions as $transaction)
                        <div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.1s" style="height: 190px;">
                            <div class="row">
                                <div class="col-lg-1 col-md-1">
                                    @if($transaction->status == "canceled" || $transaction->status == "expired" || $transaction->status == "unverified")
                                        <div class="ribbon_3 popular"><span>{{ $transaction->status }}</span>
                                        </div>
                                    @else
                                        <div class="ribbon_3"><span>{{ $transaction->status }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-9">
                                    <div class="tour_list_desc">
                                        <p>Transaction #{{ $transaction->id }}</p>
                                        <h3><strong>Expired in <span style="color: #e74c3c">{{ $transaction->timeout }}</span></strong></h3>
                                        <p><strong style="color: #333">Courier : </strong><br>{{ $transaction->courier->courier }}</p>
                                        <p><strong style="color: #333">Shipping Address : </strong><br>{{ $transaction->address }}, {{ $transaction->regency }}, {{ $transaction->province }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-2">
                                    <div class="price_list">
                                        <div><sup style="color: #777; margin-bottom: 10px;">Total</sup><br><sup>Rp.</sup>{{ $transaction->total }}<span class="normal_price_list"></span>
                                            <p><a href="/product/payment-confirmation/{{ $transaction->id }}" class="btn_1">Details</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

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
                <!-- End col lg-9 -->
            </div>
            <!-- End row -->
        </div>
        <!-- End container -->
    </main>

@endsection
