@extends('layouts.admin_with_modal')
@section('judul','Admin | Produk Page')
@section('content')

  @foreach($transactions as $transaction)
    <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">List Produk</h4>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <tbody>
                        <tr>
                          <td>Timeout</td>
                          <td>{{ $transaction->timeout }}</td>
                        </tr>
                        <tr>
                          <td>Address</td>
                          <td>{{ $transaction->address }}</td>
                        </tr>
                        <tr>
                          <td>Regency</td>
                          <td>{{ $transaction->regency }}</td>
                        </tr>
                        <tr>
                          <td>Province</td>
                          <td>{{ $transaction->province }}</td>
                        </tr>
                        <tr>
                          <td>Courier</td>
                          <td>{{ $transaction->courier->courier }}</td>
                        </tr>
                        <tr>
                          <td>Total</td>
                          <td>{{ $transaction->total }}</td>
                        </tr>
                        <tr>
                          <td>Status</td>
                          <td>{{ $transaction->status }}</td>
                        </tr>
                      </tbody>
                    </table>
                    <br>
                    <span>
                    <a href="#" class="btn-sm btn-info" data-toggle="modal" data-target="#myReview">Change Status</a>
                  </span>
                  </div>
                </div>
                <div class="card-body">
                  <h4 class="card-title">Proof of Payment</h4>
                    <div class="container">
                      <div class="row">
                        <div class="col-md-4">
                          <div class="thumbnail">
                            @if($transaction->proof_of_payment != "")
                              <img class="img-fluid-left img-thumbnail" src="/images/{{ $transaction->proof_of_payment }}" alt="light">
                            @else
                              <p>None</p>
                            @endif  
                          </div>
                        </div>
                      </div>
                    </div>    
                </div>
              </div>
                
            </div>
    @endforeach          
@endsection

    