@extends('layouts.app')

@section('template_title')
    {{ __('Create') }}
@endsection

@section('content')
    <div class="content">

        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Books Type') }}</h1>
                <p class="breadcrumbs">
                    <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span><a href="{{ route('book-types.index', app()->getLocale()) }}">{{ __('Books Type') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Create') }}
                </p>
            </div>
            <div>
                <a class="btn btn-primary" href="{{ route('book-types.index', app()->getLocale()) }}">
                    {{ __('Back') }}</a>
            </div>
        </div>
        @includeif('partials.errors')

        <form method="POST" action="{{ route('book-types.store', app()->getLocale()) }}" role="form"
            enctype="multipart/form-data">
            @csrf

            @include('book-types.form')

        </form>
    </div>
@endsection