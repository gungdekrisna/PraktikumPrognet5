<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>@yield('judul')</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/base/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">

</head>
<body class="index">
<div class="container-scroller">
<!-- partial:partials/_navbar.html -->
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex justify-content-center">
    <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">  
      <a class="navbar-brand brand-logo" href="index.html">E-Commerce</a>
      <a class="navbar-brand brand-logo-mini" href="index.html">EC</a>
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="mdi mdi-sort-variant"></span>
      </button>
    </div>  
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
    <ul class="navbar-nav mr-lg-4 w-100">
      <li class="nav-item nav-search d-none d-lg-block w-100">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="search">
              <i class="mdi mdi-magnify"></i>
            </span>
          </div>
          <input type="text" class="form-control" placeholder="Search now" aria-label="search" aria-describedby="search">
        </div>
      </li>
    </ul>
    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item dropdown mr-4">
        <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center notification-dropdown" id="notificationDropdown" href="#" data-toggle="dropdown">
          <i class="mdi mdi-bell mx-0"></i>
          @if (Auth::user()->unReadNotifications->count() != 0)
            <span class="count"></span>
          @endif
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="notificationDropdown">
          <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>

          <a class="dropdown-item" href="/admin/notif">
            <div class="item-thumbnail">
              <div class="item-icon bg-success">
                <i class="mdi mdi-information mx-0"></i>
              </div>
            </div>
            <div class="item-content">
              <h6 class="font-weight-normal">Show All Notifications</h6>
            </div>
          </a>

          @foreach (Auth::guard('admin')->user()->unReadNotifications as $notification)
            @if ($notification->type != "App\Notifications\NotifyAdminReview")

          <a class="dropdown-item" href="/transactions-show/{{$notification->data['notrans']}}">
            <div class="item-thumbnail">
              <div class="item-icon bg-warning">
                <i class="mdi mdi-settings mx-0"></i>
              </div>
            </div>
            <div class="item-content">
              <h6 class="font-weight-normal">{{$notification->data['content']}}</h6>
              <p class="font-weight-light small-text mb-0 text-muted">
                {{$notification->data['name']}}
              </p>
            </div>
          </a>

          @else

          <a class="dropdown-item" href="/response-show/{{$notification->data['noprod']}}">
            <div class="item-thumbnail">
              <div class="item-icon bg-info">
                <i class="mdi mdi-account-box mx-0"></i>
              </div>
            </div>
            <div class="item-content">
              <h6 class="font-weight-normal">{{$notification->data['content']}}</h6>
              <p class="font-weight-light small-text mb-0 text-muted">
                {{$notification->data['name']}}
              </p>
            </div>
          </a>

            @endif
          @endforeach

        </div>
      </li>
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
          <img src="{{ URL::to('/') }}/images/{{ Auth::user()->profile_image }}" alt="profile"/>
          <span class="nav-profile-name">
            {{ Auth::user()->name }}
          </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
          <a class="dropdown-item" href="/adminDetail">
            <i class="mdi mdi-account text-primary"></i>
            Akun
          </a>
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="mdi mdi-logout text-primary"></i>{{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </div>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>
<!-- partial -->
<div class="container-fluid page-body-wrapper">
  <!-- partial:partials/_sidebar.html -->
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="/admin">
          <i class="mdi mdi-home menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url("register/admin") }}">
          <i class="mdi mdi-account menu-icon"></i>
          <span class="menu-title">Buat Admin</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="mdi mdi-circle-outline menu-icon"></i>
          <span class="menu-title">Master Data</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('products.index') }}">Produk</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('categories.index') }}">Kategori</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('couriers.index') }}">Kurir</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('transactions.index') }}">Transaksi</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('response.index') }}">
          <i class="mdi mdi-account menu-icon"></i>
          <span class="menu-title">Ulasan Pembeli</span>
        </a>
      </li>
    </ul>
  </nav>

  <div class="main-panel">
        <div class="content-wrapper">
	@yield('content')
        </div>
  </div>

  <!-- Modal Review -->
    <div class="modal fade" id="myReview" tabindex="-1" role="dialog" aria-labelledby="myReviewLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myReviewLabel">Change Status</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div id="message-review">
                    </div>
                    <form method="post" action="/change-status">
                    {{ csrf_field() }}
                        <input name="transaction_id" type="hidden" value="@foreach($transactions as $transaction) {{ $transaction->id }} @endforeach">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Change Transaction Status</label>
                                    <select class="form-control" name="status" id="quality_review">
                                        <option value="canceled">Canceled</option>
                                        <option value="delivered">Delivered</option>
                                        <option value="expired">Expired</option>
                                        <option value="success">Success</option>
                                        <option value="unverified">Unverified</option>
                                        <option value="verified">Verified</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input class="btn-sm btn-info" type="submit" value="Submit" class="btn_1" id="submit-review">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End modal review -->

  <!-- plugins:js -->
  <script src="{{ asset('assets/admin/vendors/base/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="{{ asset('assets/admin/vendors/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('assets/admin/vendors/datatables.net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{ asset('assets/admin/js/off-canvas.js') }}"></script>
  <script src="{{ asset('assets/admin/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('assets/admin/js/template.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{ asset('assets/admin/js/dashboard.js') }}"></script>
  <script src="{{ asset('assets/admin/js/data-table.js') }}"></script>
  <script src="{{ asset('assets/admin/js/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/admin/js/dataTables.bootstrap4.js') }}"></script>
  <!-- End custom js for this page-->

  <!--Review modal validation -->
    <script src="{{ asset('good_assets/js/validate.js') }}"></script>
</body>
</html>