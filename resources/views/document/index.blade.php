@extends('layouts.app')

@section('template_title')
    {{ __('Document') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Document') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Document') }}
            </p>
        </div>
        <div>
            <a href="{{ route('documents.create', app()->getLocale()) }}" class="btn btn-primary float-right">
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
                                    
										<th>{{__('Title')}}</th>
										<th>{{__('Number')}}</th>
										<th>{{__('Arrived Date')}}</th>
										 


                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($documents as $document)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        
											<td>{{ $document->title }}</td>
											<td>{{ $document->number }}</td>
											<td>{{ $document->arrived_date }}</td>

                                        <td>
                                            <form action="{{ route('documents.destroy',[app()->getLocale(), $document->id]) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('documents.show', [app()->getLocale(), $document->id]) }}"> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('documents.edit', [app()->getLocale(), $document->id]) }}"> {{ __('Edit') }}</a>
                                                {{-- @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button> --}}
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach                                    
                            </tbody>
                        </table>
                    </div>
                    @if ($documents->count() > 0)
                        {!! $documents->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
