@extends('layouts.app')

@section('template_title')
    {{ __('Order') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Order') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Order') }}
            </p>
        </div>
        <div>
            <a href="{{ route('orders.create', app()->getLocale()) }}" class="btn btn-primary float-right">
                {{ __('Create') }}  
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="ec-vendor-list card card-default">
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>
                                    
										<th>Order Date</th>
										<th>Order Number</th>
										<th>Type</th>
										<th>Status</th>
										<th>Reader Id</th>


                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        
											<td>{{ $order->order_date }}</td>
											<td>{{ $order->order_number }}</td>
											<td>{{ $order->type }}</td>
											<td>{{ $order->status }}</td>
											<td>{{ $order->reader_id }}</td>

                                        <td>
                                            <form action="{{ route('orders.destroy',[app()->getLocale(), $order->id]) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('orders.show', [app()->getLocale(), $order->id]) }}"> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('orders.edit', [app()->getLocale(), $order->id]) }}"> {{ __('Edit') }}</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach                                    
                            </tbody>
                        </table>
                    </div>
                    @if ($orders->count() > 0)
                        {!! $orders->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
