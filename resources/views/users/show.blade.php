@extends('layouts.app')

@section('template_title')
    {{ $user->name ?? __('Show') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ $user->name ?? __('Show') }}</h1>
                <p class="breadcrumbs">
                    <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span> {{ __('Show') }}
                </p>
            </div>
            <div>
                <a class="btn btn-success" href="{{ route('users.edit', [app()->getLocale(), $user->id]) }}">
                    {{ __('Edit') }}</a> |
                <a href="{{ url(app()->getLocale() . '/admin/users') }}" class="btn btn-primary">{{ __('Back') }}</a>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="ec-cat-list card card-default">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <strong>{{ __('IsActive') }}:</strong>
                                {!! $user->status == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}
                            </div>
                            <div class="form-group">
                                <strong>{{ __('Name') }}:</strong>
                                {{ $user->name }}
                            </div>

                            <div class="form-group">
                                <strong>{{ __('Email') }}:</strong>
                                {{ $user->email }}
                            </div>

                            <div class="form-group">
                                <strong>{{ __('Roles') }}:</strong>
                                @if (!empty($user->getRoleNames()))
                                    @foreach ($user->getRoleNames() as $val)
                                        <label class="badge badge-purple">{{ $val }}</label>
                                    @endforeach
                                @endif
                            </div>
                            <div class="form-group">
                                <strong>{{ __('Inventar Number') }}:</strong>
                                <div>
                                    @php
                                        if ($user->inventar_number) {
                                            $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                            echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($user->inventar_number, $generator::TYPE_CODE_128)) . '">';
                                        }
                                    @endphp
                                    <br>
                                    {{ $user->inventar_number }}
                                </div>
                            </div>
                            <div class="form-group">
                                <strong>{{ __('Created At') }}:</strong>
                                {{ $user->created_at  }}
                            </div>
                            <div class="form-group">
                                <strong>{{ __('Updated At') }}:</strong>
                                {{ $user->updated_at  }}
                            </div>
                            @if ($user->profile != null)
                                <div class="form-group">
                                    <strong>{{ __('User image') }}:</strong>
                                    <div>
                                        @if ($user->profile->image)
                                            <div class="align-items-left">
                                                <img src="/storage/{{ $user->profile->image }}" width="100">
                                            </div>
                                        @else
                                            {{ __('No image') }}
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <strong>{{ __('Phone Number') }}:</strong>
                                    {{ $user->profile->phone_number }}
                                </div>

                                <div class="form-group">
                                    <strong>{{ __('Date Of Birth') }}:</strong>
                                    {{ $user->profile->date_of_birth }}
                                </div>
                                <div class="form-group">
                                    <strong>{{ __('PIN') }}:</strong>
                                    {{ $user->profile->pnf_code }}
                                </div>
                                <div class="form-group">
                                    <strong>{{ __('Passport series and number') }}:</strong>
                                    {{ $user->profile->passport_seria_number }}
                                </div>
                                <div class="form-group">
                                    <strong>{{ __('Course') }}:</strong>
                                    {{ $user->profile->kursi }}
                                </div>
                                <div class="form-group">
                                    <strong>{{ __('Reference Gender') }}:</strong>
                                    {!! $user->profile->gender_id ? $user->profile->referenceGender->title : '' !!}
                                </div> 
                                <div class="form-group">
                                    <strong>{{ __('User Type') }}:</strong>
                                    {!! $user->profile->user_type_id ? $user->profile->userType->title : '' !!}
                                </div>
                                <div class="form-group">
                                    <strong>{{ __('Organization') }}:</strong>
                                    {!! $user->profile->organization_id ? $user->profile->organization->title : '' !!}
                                </div>

                                <div class="form-group">
                                    <strong>{{ __('Branch') }}:</strong>
                                    @if ($user->profile->branch_id != null && $user->profile->branch !=null)                                    
                                        {!! $user->profile->branch_id ? $user->profile->branch->title : '' !!}
                                    @endif
                                </div>
                                <div class="form-group">
                                    <strong>{{ __('Department') }}:</strong>
                                    {!! $user->profile->department_id ? $user->profile->department->title : '' !!}
                                </div>
                                <div class="form-group">
                                    <strong>{{ __('Faculty') }}:</strong>
                                    {!! $user->profile->faculty_id ? $user->profile->faculty->title : '' !!}
                                </div>
                                <div class="form-group">
                                    <strong>{{ __('Chair') }}:</strong>
                                    {{$user->profile->chair_id}}
                                    @if ($user->profile->chair_id)
                                        {!! $user->profile->chair_id ? $user->profile->chair->title : '' !!}
                                    @endif
                                </div>
                                <div class="form-group">
                                    <strong>{{ __('Group') }}:</strong>
                                    {!! $user->profile->group_id ? $user->profile->group->title : '' !!}
                                </div>
                                <div class="form-group">
                                    <strong>{{ __('Address') }}:</strong>
                                    {!! $user->profile->address!!}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

          <style>
            .font {
                height: 375px;
                width: 250px;
                position: relative;
                border-radius: 10px;
            }



            .bottom {
                height: 70%;
                width: 100%;
                background-color: white;
                position: absolute;
            }

            .top img {
                /* height: 150px;
                width: 150px;
                border-radius: 10px;
                left: 30px;
                top: 5px; */
            }

            .bottom p {
                position: relative;
                top: 60px;
                text-align: center;
                text-transform: capitalize;
                font-weight: bold;
                font-size: 20px;
                text-emphasis: spacing;
            }

            .bottom .desi {
                font-size: 12px;
                color: grey;
                font-weight: normal;
            }

            .bottom .no {
                font-size: 15px;
                font-weight: normal;
            }

            .barcode img {
                height: 150px;
                width: 150px;
                text-align: center;
            }

            .barcode {
                text-align: center;
                position: absolute;
                top: -7px;
                right: -10px;
            }

           
            .back {
                height: 243px;
                width: 518px;
                background-color: #ffffff;
                border: 1px solid #8338ec;
            }

            .qr img {
                height: 80px;
                width: 100%;
                margin: 20px;
                background-color: white;
            }

            .Details {
                color: white;
                text-align: center;
                padding: 5px;
                font-size: 15px;
                background-color: #8338ec;
                margin-bottom: 10px;
                text-transform: uppercase;
            }


            .details-info {
                line-height: 8px;
            }

            .logo {
                width: 46%;
                height: 40px;
            }
            .mb-10{
                margin-bottom: 10px
            }
        </style>  

        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <div class="container">
                            @if ($user->profile != null)
                                <div class="back">
                                    <h1 class="Details"> {!! $user->profile->organization ? $user->profile->organization->title : '' !!}</h1>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="top text-center">
                                                <div class="">
                                                    @if ($user->profile->image)
                                                        <div class="align-items-left">
                                                            <img src="/storage/{{ $user->profile->image }}" style="width: 120px;max-width: 150px;max-height: 120px;">
                                                        </div>
                                                    @else
                                                        {{ __('No image') }}
                                                    @endif
                                                </div>
                                                <div class="">
                                                    <strong>{{ $user->name }}</strong>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="details-info">
                                                    <div class=" text-center" style="line-height: 17px;">
                                                        @php
                                                            if ($user->inventar_number) {
                                                                $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                                                echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($user->inventar_number, $generator::TYPE_CODE_128)) . '">';
                                                            }
                                                        @endphp
                                                        <br>
                                                        <span>{{ $user->inventar_number }}</span>
                                                    </div>
                                                
                                                <div class="mb-10">
                                                    <b>{{ __('Email') }}:</b> {{ $user->email }}
                                                </div>
                                                <div class="mb-10">
                                                    <b>{{ __('Phone Number') }}:</b> {{ $user->profile->phone_number }}
                                                </div>
                                                @if ($user->profile->date_of_birth)
                                                    <div class="mb-10">
                                                        <b>{{ __('Date Of Birth') }}:</b> {{ $user->profile->date_of_birth }}
                                                    </div>                                                    
                                                @endif

                                                @if ($user->profile->faculty_id)
                                                    <div class="mb-10">
                                                        <b>{{ __('Faculty') }}:</b> {!! $user->profile->faculty_id ? $user->profile->faculty->title : '' !!}
                                                    </div>                                                    
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group text-center">
                                        <span style="display:block; margin-top:-12px;line-height: 15px;">
                                            {{-- Toshkent sh. Navoiy ko’chasi, 32 uy, 100011, Telefon(998-71)244-79-20 --}}
                                            {!! $user->profile->organization ? $user->profile->organization->address: '' !!}
                                        </span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
