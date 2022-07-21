@php
$roles = Auth::user()
    ->getRoleNames()
    ->toArray();
@endphp

<li class="has-sub {{ \Request::is(app()->getLocale() . '/admin/book*') ? 'active expand' : '' }}">
    <a class="sidenav-item-link" href="javascript:void(0)">
        <i class="mdi mdi-bookshelf"></i>
        <span class="nav-text">{{ __('Books') }}</span> <b class="caret"></b>
    </a>
    <div class="collapse {{ \Request::is(app()->getLocale() . '/admin/book*') ? 'show' : '' }}">
        <ul class="sub-menu" id="vendors" data-parent="#sidebar-menu">
            <li class="{{ \Request::is(app()->getLocale() . '/admin/books-types*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/books-types') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Books Type') }}</span>
                </a>
            </li>
            <li class="{{ \Request::is(app()->getLocale() . '/admin/book-languages*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/book-languages') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Book Language') }}</span>
                </a>
            </li>
            <li class="{{ \Request::is(app()->getLocale() . '/admin/book-texts*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/book-texts') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Book Text') }}</span>
                </a>
            </li>
            <li class="{{ \Request::is(app()->getLocale() . '/admin/book-text-types*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/book-text-types') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Book Text Type') }}</span>
                </a>
            </li>
            <li class="{{ \Request::is(app()->getLocale() . '/admin/book-file-types*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/book-file-types') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Book File Type') }}</span>
                </a>
            </li>
            <li class="{{ \Request::is(app()->getLocale() . '/admin/book-subjects*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/book-subjects') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Book Subject') }}</span>
                </a>
            </li>
            <li class="{{ \Request::is(app()->getLocale() . '/admin/book-access-types*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/book-access-types') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Book Access Type') }}</span>
                </a>
            </li>
            <li class="{{ \Request::is(app()->getLocale() . '/admin/books*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/books') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Books') }}</span>
                </a>
            </li>

            <li class="{{ \Request::is(app()->getLocale() . '/admin/books/inventar*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/books/inventar') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('Inventar Numbers') }}</span>
                </a>
            </li>

        </ul>
    </div>
</li>
<li class="{{ \Request::is(app()->getLocale() . '/admin/journals*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/journals') }}" class="sidenav-item-link ">
        <i class="mdi mdi-comment-text-outline"></i>
        <span class="nav-text">{{ __('Journal') }}</span>
    </a>
</li>
<li class="{{ \Request::is(app()->getLocale() . '/admin/magazine-issues*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/magazine-issues') }}" class="sidenav-item-link ">
        <i class="mdi mdi-newspaper"></i>
        <span class="nav-text">{{ __('Magazine Issue') }}</span>
    </a>
</li>
{{-- <li class="{{ \Request::is(app()->getLocale() . '/admin/articles*') ? 'active' : '' }}">
							<a href="{{ url(app()->getLocale() . '/admin/articles') }}"
								class="sidenav-item-link ">
								<i class="mdi mdi-newspaper"></i>
								<span class="nav-text">{{ __('Articles') }}</span>
							</a>
						</li> --}}

<!-- Users -->
<li
    class="has-sub {{ \Request::is(app()->getLocale() . '/admin/permiss*') || \Request::is(app()->getLocale() . '/admin/role*') || \Request::is(app()->getLocale() . '/admin/user-types*') || \Request::is(app()->getLocale() . '/admin/roles*') || \Request::is(app()->getLocale() . '/admin/user*') ? 'active expand' : '' }}">
    <a class="sidenav-item-link" href="javascript:void(0)">
        <i class="mdi mdi-account-group"></i>
        <span class="nav-text">{{ __('Users') }}</span> <b class="caret"></b>
    </a>
    <div
        class="collapse {{ \Request::is(app()->getLocale() . '/admin/permiss*') || \Request::is(app()->getLocale() . '/admin/roles*') || \Request::is(app()->getLocale() . '/admin/user*') ? 'show' : '' }}">
        <ul class="sub-menu" id="users" data-parent="#sidebar-menu">
            <li class="{{ \Request::is(app()->getLocale() . '/admin/users*') ? 'active' : '' }}">
                <a href="{{ url(app()->getLocale() . '/admin/users') }}" class="sidenav-item-link ">
                    <span class="nav-text">{{ __('User list') }}</span>
                </a>
            </li>
           
            @if (in_array('SuperAdmin', $roles))
				<li class="{{ \Request::is(app()->getLocale() . '/admin/user-types*') ? 'active' : '' }}">
					<a href="{{ url(app()->getLocale() . '/admin/user-types') }}" class="sidenav-item-link ">
						<span class="nav-text">{{ __('User Type') }}</span>
					</a>
				</li>
				<li class="{{ \Request::is(app()->getLocale() . '/admin/roles*') ? 'active' : '' }}">
					<a href="{{ url(app()->getLocale() . '/admin/roles') }}" class="sidenav-item-link ">
						<span class="nav-text">{{ __('Roles') }}</span>
					</a>
				</li>
				<li class="{{ \Request::is(app()->getLocale() . '/admin/permissions*') ? 'active' : '' }}">
					<a href="{{ url(app()->getLocale() . '/admin/permissions') }}" class="sidenav-item-link ">
						<span class="nav-text">{{ __('Permissions') }}</span>
					</a>
				</li>

            @endif

        </ul>
    </div>
    <hr>
</li>

<li class="{{ \Request::is(app()->getLocale() . '/admin/imports*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/imports') }}" class="sidenav-item-link ">
        <i class="mdi mdi-refresh"></i>
        <span class="nav-text">{{ __('Import') }}</span>
    </a>
</li>

<li class="{{ \Request::is(app()->getLocale() . '/admin/subject*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/subjects') }}" class="sidenav-item-link ">
        <i class="mdi mdi-arrow-right-thick"> </i>
        <span class="nav-text">{{ __('Subjects') }}</span>
    </a>
</li>
<li class="{{ \Request::is(app()->getLocale() . '/admin/who*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/whos') }}" class="sidenav-item-link ">
        <i class="mdi mdi-arrow-right-thick"> </i>
        <span class="nav-text">{{ __('Who') }}</span>
    </a>
</li>
<li class="{{ \Request::is(app()->getLocale() . '/admin/where*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/wheres') }}" class="sidenav-item-link ">
        <i class="mdi mdi-arrow-right-thick"> </i>
        <span class="nav-text">{{ __('Where') }}</span>
    </a>
</li>
@if (in_array('SuperAdmin', $roles))
<li class="{{ \Request::is(app()->getLocale() . '/admin/organizations*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/organizations') }}" class="sidenav-item-link ">
        <i class="mdi mdi-city"> </i>
        <span class="nav-text">{{ __('Organization') }}</span>
    </a>
</li>
@endif
<li class="{{ \Request::is(app()->getLocale() . '/admin/branches*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/branches') }}" class="sidenav-item-link ">
        <i class="mdi mdi-office-building"> </i>
        <span class="nav-text">{{ __('Branch') }}</span>
    </a>
</li>
<li class="{{ \Request::is(app()->getLocale() . '/admin/departments*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/departments') }}" class="sidenav-item-link ">
        <i class="mdi mdi-library"></i>
        <span class="nav-text">{{ __('Department') }}</span>
    </a>
</li>
<li class="{{ \Request::is(app()->getLocale() . '/admin/faculties*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/faculties') }}" class="sidenav-item-link ">
        <i class="mdi mdi-library"></i>
        <span class="nav-text">{{ __('Faculties') }}</span>
    </a>
</li>
<li class="{{ \Request::is(app()->getLocale() . '/admin/chairs*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/chairs') }}" class="sidenav-item-link ">
        <i class="mdi mdi-library"></i>
        <span class="nav-text">{{ __('Chairs') }}</span>
    </a>
</li>
<li class="{{ \Request::is(app()->getLocale() . '/admin/groups*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/groups') }}" class="sidenav-item-link ">
        <i class="mdi mdi-library"></i>
        <span class="nav-text">{{ __('Groups') }}</span>
    </a>
</li>

<li class="{{ \Request::is(app()->getLocale() . '/admin/udcs*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/udcs') }}" class="sidenav-item-link ">
        <i class="mdi mdi-format-list-numbered"></i>
        <span class="nav-text">{{ __('Udc') }}</span>
    </a>
</li>
<li class="{{ \Request::is(app()->getLocale() . '/admin/reference-genders*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/reference-genders') }}" class="sidenav-item-link ">
        <i class="mdi mdi-gender-male-female"></i>
        <span class="nav-text">{{ __('Reference Gender') }}</span>
    </a>
</li>

<li class="{{ \Request::is(app()->getLocale() . '/admin/authors*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/authors') }}" class="sidenav-item-link ">
        <i class="mdi mdi-account-box-multiple"></i>
        <span class="nav-text">{{ __('Author') }}</span>
    </a>
</li>

<li class="{{ \Request::is(app()->getLocale() . '/admin/take-give*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/take-give') }}" class="sidenav-item-link ">
        <i class="mdi mdi-barcode-scan"></i>
        <span class="nav-text">{{ __('Takegive') }}</span>
    </a>
</li>


<li class="{{ \Request::is(app()->getLocale() . '/admin/debtors*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/debtors') }}" class="sidenav-item-link ">
        <i class="mdi mdi-refresh"></i>
        <span class="nav-text">{{ __('Debtors') }}</span>
    </a>
</li>

<li class="{{ \Request::is(app()->getLocale() . '/admin/debtors*') ? 'active' : '' }}">
    <a href="{{ url(app()->getLocale() . '/admin/debtors') }}" class="sidenav-item-link ">
        <i class="mdi mdi-refresh"></i>
        <span class="nav-text">{{ __('Check resources') }}</span>
    </a>
</li>
