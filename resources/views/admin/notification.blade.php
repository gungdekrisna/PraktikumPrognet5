@extends('layouts.admin')
@section('judul','Admin | Home Page')

@section('content')

<div class="col-md-12 grid-margin stretch-card" id="review">
        <div class="card">
          <div class="card-body">
                
                <h4>All Notification</h4>
                <div class="table-responsive">
                    <table class="table">
                        <tr>     
                            <th>Message</th>
                            <th>Time</th>
                            <th>Action</th>
                        </tr>
                        @foreach (Auth::guard('admin')->user()->Notifications as $notification)
                            @if ($notification->type != "App\Notifications\NotifyAdminReview" && isset($notification->read_at) )
                                <tr>
                                    <td>
                                        <a class="text-decoration-none text-black" href="/transactions-show/{{$notification->data['notrans']}}">
                                            {{$notification->data['content']}} {{$notification->data['name']}}</td>
                                        </a>
                                    <td>{{$notification->created_at}}</td>
                                </tr>
                            @elseif($notification->type != "App\Notifications\NotifyAdminReview" && !isset($notification->read_at))
                                <tr>
                                    <td>
                                        <a class="text-decoration-none text-black" href="/transactions-show/{{$notification->data['notrans']}}">
                                            {{$notification->data['content']}} {{$notification->data['name']}}
                                        </a>    
                                    </td>
                                    <td>{{$notification->created_at}}</td>
                                    <td><a href='/admin/mark/{{$notification->id}}'>Mark As Read</a></td>
                                </tr>
                            @elseif($notification->type = "App\Notifications\NotifyAdminReview" && !isset($notification->read_at) )
                                <tr>
                                    <td>
                                        <a class="text-decoration-none text-black" href="/response-show/{{$notification->data['noprod']}}">
                                            {{$notification->data['content']}} {{$notification->data['name']}}
                                        </a>
                                    </td>
                                    <td>{{$notification->created_at}}</td>
                                    <td><a href='/admin/mark/{{$notification->id}}'>Mark As Read</a></td>
                                <tr>
                            @elseif($notification->type = "App\Notifications\NotifyAdminReview" && isset($notification->read_at) )
                                <tr>
                                    <td>
                                        <a class="text-decoration-none text-black" href="/response-show/{{$notification->data['noprod']}}">
                                            {{$notification->data['content']}} {{$notification->data['name']}}
                                        <a class="text-decoration-none text-black" href="/response-show/{{$notification->data['noprod']}}">
                                    </td>
                                    <td>{{$notification->created_at}}</td>
                                <tr>
                            @endif
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <form action="/admin/read/{{ Auth::user()->id }}" method="GET">
                                @csrf
                                    <input type="submit" class="btn btn-primary btn-rounded" value="Mark All Read"> 
                                     
                                    </input>
                                </form>
                            </td>
                        </tr>
                    </table>
                </div>
          </div>
        </div>
</div>
<br><br><br><br><br><br><br>                     
                                    
@endsection