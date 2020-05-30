@extends('layouts.admin_with_modal_response')
@section('judul','Admin | Review Page')
@section('content')

  @foreach($product_review as $review)
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Review</h4>
          <div class="table-responsive" style="padding: 10px;">
            <table class="table table-striped">
              <tbody>
                <tr>
                  <td>Product</td>
                  <td>{{ $review->product->product_name }}</td>
                </tr>
                <tr>
                  <td>User</td>
                  <td>{{ $review->user->name }}</td>
                </tr>
                <tr>
                  <td>Rate</td>
                  <td>{{ $review->rate }}</td>
                </tr>
                <tr>
                  <td>Content</td>
                  <td>{{ $review->content }}</td>
                </tr>
                <tr>
                  <td>Date</td>
                  <td>{{ $review->created_at }}</td>
                </tr>
              </tbody>
            </table>
            <br>
            <span>
            <a href="#" class="btn-sm btn-info" data-toggle="modal" data-target="#myReview">Leave a Response</a>
          </span>
          </div>
        </div>

        <div class="card-body">
          <h4 class="card-title">Response</h4>
            <div class="container">
              <div class="row">
                <div class="col-md-4">
                  <div class="thumbnail">
                    @foreach($response as $respon)
                      <table class="table table-striped">
                        <tbody>
                          <tr>
                            <td>Response done by</td>
                            <td>{{ $respon->admin->name }}</td>                            
                          </tr>
                          <tr>
                            <td>Response</td>
                            <td>{{ $respon->content }}</td>
                          </tr>
                          <tr>
                            <td>Response at</td>
                            <td>{{ $respon->created_at }}</td>
                          </tr>
                        </tbody>
                      </table>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>    
        </div>

      </div>
    </div>
    @endforeach          
@endsection

    