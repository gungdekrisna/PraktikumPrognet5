@extends('layouts.admin_with_modal_response')
@section('judul','Admin | Review Page')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Review List</h4>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Product
                          </th>
                          <th>
                            User
                          </th>
                          <th>
                            Rate
                          </th>
                          <th>
                            Content
                          </th>
                          <th>
                            Date
                          </th>
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($product_review as $review)
                        <tr>
                          <td>{{ $review->product->product_name }}</td>
                          <td>{{ $review->user->name }}</td>
                          <td>{{ $review->rate }}</td>
                          <td>{{ $review->content }}</td>
                          <td>{{ $review->created_at }}</td>
                          <td><a class="btn-sm btn-info" href="{{ route('response.show',$review->id) }}">Details</a></td>
                          <td>
                              
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
@endsection
