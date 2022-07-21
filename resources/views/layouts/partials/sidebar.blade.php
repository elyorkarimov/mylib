
		<div class="ec-left-sidebar ec-bg-sidebar">
			<div id="sidebar" class="sidebar ec-sidebar-footer">

				<div class="ec-brand">
					<a href="{{ route('admin.home', app()->getLocale()) }}" title="AKBT">
						<img class="ec-brand-icon" src="/assets/img/logo/ec-site-logo.png" alt="" />
						<span class="ec-brand-name text-truncate">AKBT</span>
					</a>
				</div>

				<!-- begin sidebar scrollbar -->
				<div class="ec-navigation" data-simplebar>
					<!-- sidebar menu -->
					<ul class="nav sidebar-inner" id="sidebar-menu">
						<!-- Dashboard -->
						<li class="{{ \Request::is(app()->getLocale() . '/admin/home*') ? 'active' : ''  ||  \Request::is(app()->getLocale() . '/home*') ? 'active' : '' }}">
							<a class="sidenav-item-link" href="{{ route('admin.home', app()->getLocale()) }}">
								<i class="mdi mdi-view-dashboard-outline"></i>
								<span class="nav-text">{{ __('Dashboard') }}</span>
							</a>
							<hr>
						</li>
						@php
						$roles=Auth::user()->getRoleNames()->toArray();
						@endphp
						@if (in_array("Reader", $roles))
							@include('layouts.partials.rbac.reader')
						@else
							@include('layouts.partials.rbac.superadmin')						
						@endif
						<!-- Log out -->
						<li>
							<a class="sidenav-item-link" href="{{ route('logout', app()->getLocale()) }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
								<i class="mdi mdi-logout"></i> {{ __('Log Out') }}
							</a>

							<form id="logout-form" action="{{ route('logout', app()->getLocale()) }}" method="POST" class="d-none">
								@csrf
							</form>
						</li>
					</ul>
				</div>
			</div>
		</div>
