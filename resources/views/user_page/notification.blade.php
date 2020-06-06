@extends('home_parts.home_app')

@section('content')

<br><br><br>
<div class="col-md-12 grid-margin stretch-card" id="review">
        <div class="card">
          <div class="card-body">
                
                <h4>All Notifications</h4>
                <div class="table-responsive">
                    <table class="table">
                        <tr>     
                            <th>Message</th>
                            <th>Time</th>
                            <th>Action</th>
                        </tr>
                        @foreach (auth()->user()->Notifications as $notification)
                            @if ($notification->type != "App\Notifications\NotifyUserRespon" && isset($notification->read_at) )
                                <tr>
                                    <td><a href="/product/payment-confirmation/{{$notification->data['notrans']}}">{{$notification->data['content']}} {{$notification->data['notrans']}} {{$notification->data['status']}}</a></td>
                                    <td>{{$notification->created_at}}</td>
                                </tr>
                            @elseif($notification->type != "App\Notifications\NotifyUserRespon" && !isset($notification->read_at))
                                <tr>
                                    <td><a href="/product/payment-confirmation/{{$notification->data['notrans']}}">{{$notification->data['content']}} {{$notification->data['notrans']}} {{$notification->data['status']}}</a></td>
                                    <td>{{$notification->created_at}}</td>
                                    <td><a href='/mark/{{$notification->id}}'>Mark As Read</a></td>
                                </tr>
                            @elseif($notification->type = "App\Notifications\NotifyUserRespon" && !isset($notification->read_at) )
                                <tr>
                                    <td><a href="/product/{{$notification->data['noprod']}}">{{$notification->data['content']}} {{$notification->data['status']}}</a></td>
                                    <td>{{$notification->created_at}}</td>
                                    <td><a href='/mark/{{$notification->id}}'>Mark As Read</a></td>
                                <tr>
                            @elseif($notification->type = "App\Notifications\NotifyUserRespon" && isset($notification->read_at) )
                                <tr>
                                    <td><a href="/product/{{$notification->data['noprod']}}">{{$notification->data['content']}} {{$notification->data['status']}}</a></td>
                                    <td>{{$notification->created_at}}</td>
                                <tr>
                            @endif
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <form action="/baca" method="GET">
                                @csrf
                                    <input type="submit" class="btn btn-primary btn-rounded" style="background-color: #e04f67; border-color: #e04f67" value="Mark All Read" > 
                                    
                                    </input>
                                </form>
                            </td>
                        </tr>
                    </table>
                </div>
          </div>
        </div>
</div>
<br><br><br>                     
                                    
@endsection