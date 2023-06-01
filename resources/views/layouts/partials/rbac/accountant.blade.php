<li class="{{ \Request::is(app()->getLocale() . '/admin/publishers*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/publishers') }}" class="sidenav-item-link ">
        <i class="mdi mdi-office-building-marker-outline"></i>
        <span class="nav-text">{{ __('publishers') }}</span>
    </a>
</li>
<li class="{{ \Request::is(app()->getLocale() . '/admin/basics*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/basics') }}" class="sidenav-item-link ">
        <i class="mdi mdi-archive-outline"></i>
        <span class="nav-text">{{ __('Basics') }}</span>
    </a>
</li>
<li class="{{ \Request::is(app()->getLocale() . '/admin/gen-types*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/gen-types') }}" class="sidenav-item-link ">
        <i class="mdi mdi-arrange-send-backward"></i>
        <span class="nav-text">{{ __('Gen Types') }}</span>
    </a>
</li>
<li class="{{ \Request::is(app()->getLocale() . '/admin/documents*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/documents') }}" class="sidenav-item-link ">
        <i class="mdi mdi-newspaper"></i>
        <span class="nav-text">{{ __('Documents') }}</span>
    </a>
</li>