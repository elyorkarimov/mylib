@extends('layouts.app')

@section('content')
<style>
    .home-img{
        max-width: 50px;
    }
    .home-book-img{
        max-width: 765px;
    }
</style>
<div class="content">
    <!-- Top Statistics -->
    <div class="row">
        
        <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
            <div class="card card-mini dash-card card-2">
                <div class="card-body"> 
                    <h2 class="mb-1">{{{\App\Models\Book::active()->count()}}}</h2>
                    <p>{{__('Bibliographic record')}} </p>
                    <span class="mdi mdi-book"></span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
            <div class="card card-mini dash-card card-2">
                <div class="card-body">
                    <h2 class="mb-1">{{{\App\Models\Book::totalAll()}}}</h2>
                    <p>{{__('Number of books')}} </p>
                    <span class="mdi mdi-book"></span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
            <div class="card card-mini dash-card card-3">
                <div class="card-body">
                    <h2 class="mb-1">{{{\App\Models\BookInventar::active()->count()}}}</h2>
                    <p>{{__('Books in Copy')}}</p>
                    <span class="mdi mdi-book-multiple"></span>
                </div>
            </div>
        </div>
        {{-- <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
            <div class="card card-mini dash-card card-3">
                <div class="card-body">
                    <h2 class="mb-1">0</h2>
                    <p>Onlayn buyurtmalar soni</p>
                    <span class="mdi mdi-package-variant"></span>
                </div>
            </div>
        </div> --}}
        <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
            <div class="card card-mini dash-card card-1">
                <div class="card-body">
                    <h2 class="mb-1">{{{\App\Models\User::active()->count()}}}</h2>
                    <p>{{__('Number of users')}}</p>
                    <span class="mdi mdi-account-arrow-left"></span>
                </div>
            </div>
        </div>
    </div>
    <livewire:admin.charts.book-type-charts/>

    <div class="row">
        <div class="col-xl-5">
            <!-- New Users -->
            <div class="card ec-cust-card card-table-border-none card-default">
                <div class="card-header justify-content-between ">
                    <h2>{{__('New Users')}}</h2>
                    <div>
                        <button class="text-black-50 mr-2 font-size-20">
                            <i class="mdi mdi-cached"></i>
                        </button>
                        {{-- <div class="dropdown show d-inline-block widget-dropdown">
                            <a class="dropdown-toggle icon-burger-mini" href="#" role="button"
                                id="dropdown-customar" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" data-display="static">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li class="dropdown-item"><a href="#">Action</a></li>
                                <li class="dropdown-item"><a href="#">Another action</a></li>
                                <li class="dropdown-item"><a href="#">Something else here</a></li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
                @if ($new_users != null && $new_users->count()>0)
                    

                <div class="card-body pt-0 pb-15px">
                    <table class="table ">
                        <tbody>
                            @foreach ($new_users as $k=> $item)
                            
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="media-image mr-3 rounded-circle">
                                            <a href="{{ route('users.show', [app()->getLocale(), $item->id]) }}">
                                                @if ($item->profile->image)
                                                <div class="align-items-left">
                                                    <img src="/storage/{{ $item->profile->image }}" class="home-img">
                                                </div>
                                            @else
                                            <img
                                            class="profile-img rounded-circle w-45"
                                            src="/assets/img/user/u1.jpg"
                                            alt="customer image">
                                            @endif
                                                
 </a>
                                        </div>
                                        <div class="media-body align-self-center">
                                            <a href="{{ route('users.show', [app()->getLocale(), $item->id]) }}"> 
                                                <h6 class="mt-0 text-dark font-weight-medium">{{$item->name}}</h6>
                                            </a>
                                            <small><a href="mailto:{{$item->email}}">{{$item->email}}</a></small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{$item->profile->phone_number}}</td>
                            </tr>
                                
                            @endforeach
                             
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>

        <div class="col-xl-7">
            <!-- New Books -->
            <div class="card card-default ec-card-top-prod">
                <div class="card-header justify-content-between">
                    <h2>{{__('New Books')}}</h2>
                    <div>
                        <button class="text-black-50 mr-2 font-size-20"><i
                                class="mdi mdi-cached"></i></button>
                        <div class="dropdown show d-inline-block widget-dropdown">
                            {{-- <a class="dropdown-toggle icon-burger-mini" href="#" role="button"
                                id="dropdown-product" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" data-display="static">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li class="dropdown-item"><a href="#">Update Data</a></li>
                                <li class="dropdown-item"><a href="#">Detailed Log</a></li>
                                <li class="dropdown-item"><a href="#">Statistics</a></li>
                                <li class="dropdown-item"><a href="#">Clear Data</a></li>
                            </ul> --}}
                        </div>
                    </div>
                </div>
                <div class="card-body mt-10px mb-10px py-0">

                    @if ($new_books != null && $new_books->count()>0)
                        @foreach ($new_books as $k=> $item)
                            
                    <div class="row media d-flex pt-15px pb-15px">
                        <div
                            class="col-lg-3 col-md-3 col-2 media-image align-self-center rounded">
                            <a href="{{ route('books.show', [app()->getLocale(), $item->id]) }}">
                                
                                @if ($item->image_path)
                                    <img src="/storage/{{ $item->image_path }}" class="home-book-img">
                                @else
                                    <img src="/assets/img/products/p1.jpg" alt="customer image">
                                @endif
                                
                            
                            
                            
                            </a>
                        </div>
                        <div class="col-lg-9 col-md-9 col-10 media-body align-self-center ec-pos">
                            <a href="{{ route('books.show', [app()->getLocale(), $item->id]) }}">
                                <h6 class="mb-10px text-dark font-weight-medium">{!! $item->BooksType ? $item->BooksType->title : '' !!}</h6>
                            </a>
                            {{-- <p class="float-md-right sale"><span class="mr-2">58</span>Sales</p> --}}
                            <p class="d-none d-md-block">{{$item->dc_title}}</p>
                            <p class="mb-0 ec-price">
                                <span class="text-dark">{{$item->price}} soʻm</span>
                            </p>
                        </div>
                    </div>
                    
                        @endforeach    
                    @endif

                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-8 col-md-12 p-b-15">
            <!-- Sales Graph -->
            <div id="user-acquisition" class="card card-default">
                <div class="card-header">
                    <h2>Sales Report</h2>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs nav-style-border justify-content-between justify-content-lg-start border-bottom"
                        role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#todays" role="tab"
                                aria-selected="true">Today's</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#monthly" role="tab"
                                aria-selected="false">Monthly </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#yearly" role="tab"
                                aria-selected="false">Yearly</a>
                        </li>
                    </ul>
                    <div class="tab-content pt-4" id="salesReport">
                        <div class="tab-pane fade show active" id="source-medium" role="tabpanel">
                            <div class="mb-6" style="max-height:247px">
                                <canvas id="acquisition" class="chartjs2"></canvas>
                                <div id="acqLegend" class="customLegend mb-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-12 p-b-15">
            <!-- Doughnut Chart -->
            <div class="card card-default">
                <div class="card-header justify-content-center">
                    <h2>{{__('Orders Overview')}}</h2>
                </div>
                <div class="card-body">
                    <canvas id="doChart"></canvas>
                </div>
                <a href="#" class="pb-5 d-block text-center text-muted"><i
                        class="mdi mdi-download mr-2"></i> Download overall report</a>
                <div class="card-footer d-flex flex-wrap bg-white p-0">
                    <div class="col-6">
                        <div class="p-20">
                            <ul class="d-flex flex-column justify-content-between">
                                <li class="mb-2"><i class="mdi mdi-checkbox-blank-circle-outline mr-2"
                                        style="color: #4c84ff"></i>Order Completed</li>
                                <li class="mb-2"><i class="mdi mdi-checkbox-blank-circle-outline mr-2"
                                        style="color: #80e1c1 "></i>Order Unpaid</li>
                                <li><i class="mdi mdi-checkbox-blank-circle-outline mr-2"
                                        style="color: #ff7b7b "></i>Order returned</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-6 border-left">
                        <div class="p-20">
                            <ul class="d-flex flex-column justify-content-between">
                                <li class="mb-2"><i class="mdi mdi-checkbox-blank-circle-outline mr-2"
                                        style="color: #8061ef"></i>Order Pending</li>
                                <li class="mb-2"><i class="mdi mdi-checkbox-blank-circle-outline mr-2"
                                        style="color: #ffa128"></i>Order Canceled</li>
                                <li><i class="mdi mdi-checkbox-blank-circle-outline mr-2"
                                        style="color: #7be6ff"></i>Order Broken</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8 col-md-12 p-b-15">
            <!-- User activity statistics -->
            <div class="card card-default" id="user-activity">
                <div class="no-gutters">
                    <div>
                        <div class="card-header justify-content-between">
                            <h2>User Activity</h2>
                            <div class="date-range-report ">
                                <span></span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="userActivityContent"> 
                                <div class="tab-pane fade show active" id="user" role="tabpanel">
                                    <canvas id="activity" class="chartjs"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex flex-wrap bg-white border-top">
                            <a href="#" class="text-uppercase py-3">In-Detail Overview</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-12 p-b-15">
            <div class="card card-default">
                <div class="card-header flex-column align-items-start">
                    <h2>Current Users</h2>
                </div>
                <div class="card-body">
                    <canvas id="currentUser" class="chartjs"></canvas>
                </div>
                <div class="card-footer d-flex flex-wrap bg-white border-top">
                    <a href="#" class="text-uppercase py-3">In-Detail Overview</a>
                </div>
            </div>
        </div>
    </div>
 
    <div class="row">
        <div class="col-12 p-b-15">
            <!-- Recent Order Table -->
            <div class="card card-table-border-none card-default recent-orders" id="recent-orders">
                <div class="card-header justify-content-between">
                    <h2>Recent Orders</h2>
                    <div class="date-range-report">
                        <span></span>
                    </div>
                </div>
                <div class="card-body pt-0 pb-5">
                    <table class="table card-table table-responsive table-responsive-large"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Product Name</th>
                                <th class="d-none d-lg-table-cell">Units</th>
                                <th class="d-none d-lg-table-cell">Order Date</th>
                                <th class="d-none d-lg-table-cell">Order Cost</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>24541</td>
                                <td>
                                    <a class="text-dark" href=""> Coach Swagger</a>
                                </td>
                                <td class="d-none d-lg-table-cell">1 Unit</td>
                                <td class="d-none d-lg-table-cell">Oct 20, 2018</td>
                                <td class="d-none d-lg-table-cell">$230</td>
                                <td>
                                    <span class="badge badge-success">Completed</span>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown show d-inline-block widget-dropdown">
                                        <a class="dropdown-toggle icon-burger-mini" href=""
                                            role="button" id="dropdown-recent-order1"
                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" data-display="static"></a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li class="dropdown-item">
                                                <a href="#">View</a>
                                            </li>
                                            <li class="dropdown-item">
                                                <a href="#">Remove</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>24541</td>
                                <td>
                                    <a class="text-dark" href=""> Toddler Shoes, Gucci Watch</a>
                                </td>
                                <td class="d-none d-lg-table-cell">2 Units</td>
                                <td class="d-none d-lg-table-cell">Nov 15, 2018</td>
                                <td class="d-none d-lg-table-cell">$550</td>
                                <td>
                                    <span class="badge badge-primary">Delayed</span>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown show d-inline-block widget-dropdown">
                                        <a class="dropdown-toggle icon-burger-mini" href="#"
                                            role="button" id="dropdown-recent-order2"
                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" data-display="static"></a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li class="dropdown-item">
                                                <a href="#">View</a>
                                            </li>
                                            <li class="dropdown-item">
                                                <a href="#">Remove</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>24541</td>
                                <td>
                                    <a class="text-dark" href=""> Hat Black Suits</a>
                                </td>
                                <td class="d-none d-lg-table-cell">1 Unit</td>
                                <td class="d-none d-lg-table-cell">Nov 18, 2018</td>
                                <td class="d-none d-lg-table-cell">$325</td>
                                <td>
                                    <span class="badge badge-warning">On Hold</span>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown show d-inline-block widget-dropdown">
                                        <a class="dropdown-toggle icon-burger-mini" href="#"
                                            role="button" id="dropdown-recent-order3"
                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" data-display="static"></a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li class="dropdown-item">
                                                <a href="#">View</a>
                                            </li>
                                            <li class="dropdown-item">
                                                <a href="#">Remove</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>24541</td>
                                <td>
                                    <a class="text-dark" href=""> Backpack Gents, Swimming Cap Slin</a>
                                </td>
                                <td class="d-none d-lg-table-cell">5 Units</td>
                                <td class="d-none d-lg-table-cell">Dec 13, 2018</td>
                                <td class="d-none d-lg-table-cell">$200</td>
                                <td>
                                    <span class="badge badge-success">Completed</span>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown show d-inline-block widget-dropdown">
                                        <a class="dropdown-toggle icon-burger-mini" href="#"
                                            role="button" id="dropdown-recent-order4"
                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" data-display="static"></a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li class="dropdown-item">
                                                <a href="#">View</a>
                                            </li>
                                            <li class="dropdown-item">
                                                <a href="#">Remove</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>24541</td>
                                <td>
                                    <a class="text-dark" href=""> Speed 500 Ignite</a>
                                </td>
                                <td class="d-none d-lg-table-cell">1 Unit</td>
                                <td class="d-none d-lg-table-cell">Dec 23, 2018</td>
                                <td class="d-none d-lg-table-cell">$150</td>
                                <td>
                                    <span class="badge badge-danger">Cancelled</span>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown show d-inline-block widget-dropdown">
                                        <a class="dropdown-toggle icon-burger-mini" href="#"
                                            role="button" id="dropdown-recent-order5"
                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" data-display="static"></a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li class="dropdown-item">
                                                <a href="#">View</a>
                                            </li>
                                            <li class="dropdown-item">
                                                <a href="#">Remove</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div> <!-- End Content -->


@endsection
