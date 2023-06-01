@extends('layouts.app')

@section('template_title')
        {{ __('Create') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Basic') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/basics') }}">{{ __('Basic') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Create') }}
            </p>
        </div>
        <div>
            <a class="btn btn-primary" href="{{ url(app()->getLocale() . '/admin/basics') }}">
                {{ __('Back') }}</a>
        </div>
    </div> 
    @includeif('partials.errors')

    <form method="POST" action="{{ route('basics.store', app()->getLocale()) }}"  role="form" enctype="multipart/form-data">
        @csrf

        @include('basic.form')

    </form>
</div>            
@endsection
