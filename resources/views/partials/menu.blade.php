<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li>
            <select class="searchable-field form-control">

            </select>
        </li>
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('event_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.events.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/events') || request()->is('admin/events/*') ? 'active' : '' }}">
                    <i class="fa-fw far fa-calendar-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.event.title') }}
                </a>
            </li>
        @endcan
        @can('board_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.boards.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/boards') || request()->is('admin/boards/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-chess-board c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.board.title') }}
                </a>
            </li>
        @endcan
        @can('topic_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.topics.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/topics') || request()->is('admin/topics/*') ? 'active' : '' }}">
                    <i class="fa-fw far fa-file-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.topic.title') }}
                </a>
            </li>
        @endcan
        @can('schedule_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.schedules.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/schedules') || request()->is('admin/schedules/*') ? 'active' : '' }}">
                    <i class="fa-fw far fa-clock c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.schedule.title') }}
                </a>
            </li>
        @endcan
        @can('speaker_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.speakers.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/speakers') || request()->is('admin/speakers/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-volume-up c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.speaker.title') }}
                </a>
            </li>
        @endcan
        @can('sponsor_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.sponsors.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/sponsors') || request()->is('admin/sponsors/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-hand-holding-usd c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.sponsor.title') }}
                </a>
            </li>
        @endcan
        @can('exhibition_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.exhibitions.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/exhibitions') || request()->is('admin/exhibitions/*') ? 'active' : '' }}">
                    <i class="fa-fw far fa-images c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.exhibition.title') }}
                </a>
            </li>
        @endcan
        @can('exhibition_detail_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.exhibition-details.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/exhibition-details') || request()->is('admin/exhibition-details/*') ? 'active' : '' }}">
                    <i class="fa-fw far fa-image c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.exhibitionDetail.title') }}
                </a>
            </li>
        @endcan
        @can('event_attendee_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.event-attendees.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/event-attendees') || request()->is('admin/event-attendees/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-user-tie c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.eventAttendee.title') }}
                </a>
            </li>
        @endcan
        @can('organizer_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.organizers.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/organizers') || request()->is('admin/organizers/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-sitemap c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.organizer.title') }}
                </a>
            </li>
        @endcan
        @can('contact_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.contacts.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/contacts') || request()->is('admin/contacts/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-phone c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.contact.title') }}
                </a>
            </li>
        @endcan
        @can('registration_access')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.registration.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('specialty_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.specialties.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/specialties') || request()->is('admin/specialties/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-align-justify c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.specialty.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('country_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.countries.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/countries') || request()->is('admin/countries/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-flag c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.country.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('city_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.cities.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/cities') || request()->is('admin/cities/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.city.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('audit_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.audit-logs.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/audit-logs') || request()->is('admin/audit-logs/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.auditLog.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.systemCalendar") }}" class="c-sidebar-nav-link {{ request()->is('admin/system-calendar') || request()->is('admin/system-calendar/*') ? 'active' : '' }}">
                <i class="c-sidebar-nav-icon fa-fw fas fa-calendar">

                </i>
                {{ trans('global.systemCalendar') }}
            </a>
        </li>
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>