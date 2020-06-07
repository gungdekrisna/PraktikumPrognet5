@extends('layouts.admin')
@section('judul','Admin | Home Page')

@section('content')
      <!-- partial -->
      <!-- <div class="main-panel">
        <div class="content-wrapper"> -->
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                  <div class="mr-md-3 mr-xl-5">
                    <h2>Welcome back,</h2>
                    <p class="mb-md-0">Your analytics dashboard template.</p>
                  </div>
                  <div class="d-flex">
                    <i class="mdi mdi-home text-muted hover-cursor"></i>
                    <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                    <p class="text-primary mb-0 hover-cursor">Analytics</p>
                  </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                  <button type="button" class="btn btn-light bg-white btn-icon mr-3 d-none d-md-block ">
                    <i class="mdi mdi-download text-muted"></i>
                  </button>
                  <button type="button" class="btn btn-light bg-white btn-icon mr-3 mt-2 mt-xl-0">
                    <i class="mdi mdi-clock-outline text-muted"></i>
                  </button>
                  <button type="button" class="btn btn-light bg-white btn-icon mr-3 mt-2 mt-xl-0">
                    <i class="mdi mdi-plus text-muted"></i>
                  </button>
                  <button class="btn btn-primary mt-2 mt-xl-0">Download report</button>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Cash deposits</p>
                  <p class="mb-4">To start a blog, think of a topic about and first brainstorm party is ways to write details</p>
                  <div id="cash-deposits-chart-legend" class="d-flex justify-content-center pt-3"></div>
                  <canvas id="cash-deposits-chart"></canvas>
                </div>
              </div>
            </div> -->

            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Pendapatan Per Bulan</p>
                  <!-- <h1>$ 28835</h1>
                  <h4>Gross sales over the years</h4> -->
                  <p class="text-muted">Grafik pendapatan tiap bulan</p>
                  <div id="total-sales-chart-legend"></div>                  
                </div>
                <canvas id="chartMonth"></canvas>
              </div>
            </div>

            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Pendapatan Per Tahun</p>
                  <p class="text-muted">Grafik pendapatan tiap tahun</p>
                  <div id="total-sales-chart-legend"></div>                  
                </div>
                <!-- <canvas id="total-sales-chart"></canvas> -->
                <canvas id="chartYear"></canvas>
              </div>
            </div>

          </div>

          <div class="row">

            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Jumlah Transaksi Per Bulan</p>
                  <!-- <h1>$ 28835</h1>
                  <h4>Gross sales over the years</h4> -->
                  <p class="text-muted">Grafik jumlah transaksi tiap bulan</p>
                  <div id="total-sales-chart-legend"></div>                  
                </div>
                <canvas id="chartMonthJumlah"></canvas>
              </div>
            </div>

            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Jumlah Transaksi Per Tahun</p>
                  <p class="text-muted">Grafik jumlah transaksi tiap tahun</p>
                  <div id="total-sales-chart-legend"></div>                  
                </div>
                <!-- <canvas id="total-sales-chart"></canvas> -->
                <canvas id="chartYearJumlah"></canvas>
              </div>
            </div>

          </div>

          <div class="row">
            <div class="col-md-12 stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Jumlah Transaksi dan Pendapatan Tiap Bulan</p>
                  <div class="table-responsive">
                    <table id="recent-purchases-listing" class="table">
                      <thead>
                        <tr>
                            <th>Bulan</th>
                            <th>Jumlah</th>
                            <th>Pendapatan</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($transactions_per_month as $transaction_month)
                        <tr>
                            <td>
                              @if($transaction_month->bulan == 1)
                                Januari
                              @elseif($transaction_month->bulan == 2)
                                Februari
                              @elseif($transaction_month->bulan == 3)
                                Maret
                              @elseif($transaction_month->bulan == 4)
                                April
                              @elseif($transaction_month->bulan == 5)
                                Mei
                              @elseif($transaction_month->bulan == 6)
                                Juni
                              @elseif($transaction_month->bulan == 7)
                                Juli
                              @elseif($transaction_month->bulan == 8)
                                Agustus
                              @elseif($transaction_month->bulan == 9)
                                September
                              @elseif($transaction_month->bulan == 10)
                                Oktober
                              @elseif($transaction_month->bulan == 11)
                                November
                              @elseif($transaction_month->bulan == 12)
                                Desember
                              @else
                                Undefined
                              @endif
                            </td>
                            <td>{{ $transaction_month->jumlah }}</td>
                            <td>Rp. {{ $transaction_month->pendapatan }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row" style="margin-top: 30px;">
            <div class="col-md-12 stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Jumlah Transaksi dan Pendapatan Tiap Tahun</p>
                  <div class="table-responsive">
                    <table id="recent-purchases-listing" class="table">
                      <thead>
                        <tr>
                            <th>Tahun</th>
                            <th>Jumlah</th>
                            <th>Pendapatan</th>
                        </tr>
                      </thead>
                      <tbody>

                        @foreach($transactions_per_year as $transaction_year)
                        <tr>
                            <td>{{ $transaction_year->tahun }}</td>
                            <td>{{ $transaction_year->jumlah }}</td>
                            <td>Rp. {{ $transaction_year->pendapatan }}</td>
                        </tr>
                        @endforeach
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- </div> -->
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2020 Kelompok 5 Praktikum Prognet. Powered By<a href="#" target="_blank"> PineapplePremium</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i> by Kelompok 5 Praktikum Prognet</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  <!-- </div> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/js/bootstrap-select.min.js" charset="utf-8"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>
  <script>
  var url = "{{url('admin/chart')}}";
  var Jumlah = new Array();
  var Bulan = new Array();
  var Pendapatan = new Array();
  $(document).ready(function(){
    $.get(url, function(response){
      response.forEach(function(data){
          Jumlah.push(data.jumlah);
          if (data.bulan == 1) {
            Bulan.push("Januari");
          } else if(data.bulan == 2) {
            Bulan.push("Februari");
          } else if(data.bulan == 3) {
            Bulan.push("Maret");
          } else if(data.bulan == 4) {
            Bulan.push("April");
          } else if(data.bulan == 5) {
            Bulan.push("Mei");
          } else if(data.bulan == 6) {
            Bulan.push("Juni");
          } else if(data.bulan == 7) {
            Bulan.push("Juli");
          } else if(data.bulan == 8) {
            Bulan.push("Agustus");
          } else if(data.bulan == 9) {
            Bulan.push("September");
          } else if(data.bulan == 10) {
            Bulan.push("Oktober");
          } else if(data.bulan == 11) {
            Bulan.push("November");
          } else if(data.bulan == 12) {
            Bulan.push("Desember");
          } else {
            Bulan.push("not 1 - 12");
          }
          Pendapatan.push(data.pendapatan);
      });
      var ctx = document.getElementById("chartMonth").getContext('2d');
          var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels:Bulan,
                datasets: [{
                    label: 'Pendapatan per Bulan',
                    data: Pendapatan,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    });
  });
  </script>

  <script>
  var urlYear = "{{url('admin/chartYear')}}";
  var JumlahYear = new Array();
  var Tahun = new Array();
  var PendapatanYear = new Array();
  $(document).ready(function(){
    $.get(urlYear, function(response){
      response.forEach(function(data){
          JumlahYear.push(data.jumlahYear);
          Tahun.push(data.tahun);
          PendapatanYear.push(data.pendapatanYear);
      });
      var ctx = document.getElementById("chartYear").getContext('2d');
          var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels:Tahun,
                datasets: [{
                    label: 'Pendapatan per Tahun',
                    data: PendapatanYear,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    });
  });
  </script>

  <script>
  var urlJumlah = "{{url('admin/chart')}}";
  var JumlahJumlah = new Array();
  var BulanJumlah = new Array();
  var PendapatanJumlah = new Array();
  $(document).ready(function(){
    $.get(urlJumlah, function(response){
      response.forEach(function(data){
          JumlahJumlah.push(data.jumlah);
          BulanJumlah.push(data.bulan);
          PendapatanJumlah.push(data.pendapatan);
      });
      var ctx = document.getElementById("chartMonthJumlah").getContext('2d');
          var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels:Bulan,
                datasets: [{
                    label: 'Jumlah transaksi per Bulan',
                    data: JumlahJumlah,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    });
  });
  </script>

  <script>
  var urlYearJumlah = "{{url('admin/chartYear')}}";
  var JumlahYearJumlah = new Array();
  var TahunJumlah = new Array();
  var PendapatanYearJumlah = new Array();
  $(document).ready(function(){
    $.get(urlYearJumlah, function(response){
      response.forEach(function(data){
          JumlahYearJumlah.push(data.jumlahYear);
          TahunJumlah.push(data.tahun);
          PendapatanYearJumlah.push(data.pendapatanYear);
      });
      var ctx = document.getElementById("chartYearJumlah").getContext('2d');
          var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels:Tahun,
                datasets: [{
                    label: 'Jumlah transaksi per Tahun',
                    data: JumlahYearJumlah,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    });
  });
  </script>
  <!-- <script src="{{ asset('assets/admin/vendors/chart.js/Chart.min.js') }}"></script>
  <script>
    var url = "{{url('admin/chart')}}";
    var Jumlah = new Array();
    var Bulan = new Array();
    var Pendapatan = new Array();
    $.get(url, function(response){
      response.forEach(function(data){
          Jumlah.push(data.jumlah);
          Bulan.push(data.bulan);
          Pendapatan.push(data.pendapatan);
      });
    });

    var ctx = document.getElementById("chartMonth").getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [{
          label: '# of Votes',
          data: [12, 19, 3, 23, 2, 3],
          backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)'
          ],
          borderColor: [
          'rgba(255,99,132,1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero:true
            }
          }]
        }
      }
    });
  </script>

  <script>
    var ctx = document.getElementById("chartYear").getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [{
          label: '# of Votes',
          data: [12, 19, 3, 23, 2, 3],
          backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)'
          ],
          borderColor: [
          'rgba(255,99,132,1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero:true
            }
          }]
        }
      }
    });
  </script> -->
@endsection