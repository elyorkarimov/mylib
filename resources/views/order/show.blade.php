@extends('layouts.app')

@section('template_title')
    {{ $order->name ?? __('Show') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Order') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/orders') }}">{{ __('Order') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span> {{ $booksType->title ?? __('Show') }}
            </p>
        </div>
        <div>
        <a href="{{ url(app()->getLocale() . '/admin/orders') }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>{{ __('Order Date') }}:</strong>
                            {{ $order->order_date }}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Order Number') }}:</strong>
                            {{ $order->order_number }}
                        </div> 
                        <div class="form-group">
                            <strong>{{ __('Status') }}:</strong>
                            {!! App\Models\Order::GetStatus($order->status) !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Reader') }}:</strong>
                            {!! $order->reader ? $order->reader->name : '' !!}
                            <br>
                            <b>{{ __('Email') }}</b>: <a href="mailTo:{!! $order->reader ? $order->reader->email : '' !!}">{!! $order->reader ? $order->reader->email : '' !!}</a>
                            <br>
                            <b>{{ __('Phone Number') }}: </b><a href="tel:{!! $order->reader ? $order->reader->profile->phone_number : '' !!}">{!! $order->reader ? $order->reader->profile->phone_number : '' !!}</a>
                        </div>
                         
                    </div>
                    @if($order->orderDetails != null && $order->orderDetails->count()>0)
                    <div class="card-body">
                        <div class="table-responsive">
    
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                            <th>{{ __('Book') }}</th>
                                            <th>{{ __('Book face image') }}</th>
                                            <th>{{ __('Status') }}</th> 
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderDetails as $orderDet)
                                        <tr>
                                            <td>{{ $orderDet->id }}</td>
                                            <td>{!!\App\Models\Book::GetBibliographicById($orderDet->book_id )!!}
                                            
                                            </td>
                                            <td>
                                                @if ($orderDet->book->image_path)
                                                    <img src="/storage/{{ $orderDet->book->image_path}}" width="100px">
                                                @endif
                                            </td>
                                            <td>{!! App\Models\Order::GetStatus($orderDet->status) !!}</td>
                                            <td>
                                                {{-- <a class="btn btn-sm btn-primary " href="{{ route('orders.show', [app()->getLocale(), $orderDet->id]) }}"> {{ __('Show') }}</a>     --}}
                                            </td>
                                        </tr>
                                    @endforeach                                    
                                </tbody>
                            </table>
                        </div> 
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
