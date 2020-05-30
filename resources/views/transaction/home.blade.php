@extends('layouts.admin')
@section('judul','Admin | Produk Page')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">List Transaksi</h4>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                         Timeout
                          </th>
                          <th>
                            Address
                          </th>
                          <th>
                            Regency
                          </th>
                          <th>
                            Province
                          </th>
                          <th>
                            Courier
                          </th>
                          <th>
                            Total
                          </th>
                          <th>
                            Proof of Payment
                          </th>
                          <th>
                            Status
                          </th>
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($transactions as $transaction)
                        <tr>
                          <td>{{ $transaction->timeout }}</td>
                          <td>{{ $transaction->address }}</td>
                          <td>{{ $transaction->regency }}</td>
                          <td>{{ $transaction->province }}</td>
                          <td>{{ $transaction->courier->courier }}</td>
                          <td>{{ $transaction->total }}</td>
                          <td>
                            @if($transaction->proof_of_payment != "")
                              <img src="images/{{ $transaction->proof_of_payment }}">
                            @else
                              <p>None</p>
                            @endif
                          </td>
                          <td>{{ $transaction->status }}</td>
                          <td>
                              <a class="btn-sm btn-info" href="{{ route('transaction.show',$transaction->id) }}">Details</a>
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