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
                            <strong>Order Date:</strong>
                            {{ $order->order_date }}
                        </div>
                        <div class="form-group">
                            <strong>Order Number:</strong>
                            {{ $order->order_number }}
                        </div>
                        <div class="form-group">
                            <strong>Type:</strong>
                            {{ $order->type }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $order->status }}
                        </div>
                        <div class="form-group">
                            <strong>Reader Id:</strong>
                            {{ $order->reader_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
