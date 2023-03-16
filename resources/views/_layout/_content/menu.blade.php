<li class="sidebar-header">
    main
</li>
<li class="sidebar-item {{ Request::is('dashboard') ? 'active' : '' }}">
    <a class="sidebar-link" href="{{ route('dashboard.index') }}">
        <i class="align-middle me-2 fas fa-fw fa-home"></i> <span class="align-middle">Dashboard</span>
    </a>
</li>
<li class="sidebar-header">
    maintenance
</li>
<li class="sidebar-item {{ Request::is('maindealer') || Request::is('api/md/*')? 'active' : '' }} ">
    <a class="sidebar-link" href="{{ route('maindealer.index') }}">
        <i class="align-middle me-2 fas fa-fw fa-tachometer-alt"></i> <span class="align-middle">Main Dealer</span>
    </a>
</li>
<li class="sidebar-item {{ Request::is('feature') ? 'active' : '' }}">
    <a class="sidebar-link" href="{{ route('feature.index') }}">
        <i class="align-middle me-2 fas fa-fw fa-brain"></i> <span class="align-middle">Feature</span>
    </a>
</li>
<li class="sidebar-header">
    monitoring
</li>
<li class="sidebar-item {{ Request::is('api/alert') || Request::is('api/alert/*') ? 'active' : '' }}">
    <a class="sidebar-link" href="{{ route('api.alert') }}">
        <i class="align-middle me-2 fas fa-fw fa-fire"></i> <span class="align-middle">API</span>
    </a>
</li>
<li class="sidebar-item {{ Request::is('log/md') || Request::is('log/md/*') ? 'active' : '' }}">
    <a data-bs-target=#Log data-bs-toggle="collapse" class="sidebar-link collapsed">
        <i class="align-middle me-2 fab fa-fw fa-blogger-b"></i> <span class="align-middle">Log</span>
    </a>
    <ul id="Log" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
        <li class="sidebar-item {{ Request::is('log/md') || Request::is('log/md/*') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('log.index') }}">All</a></li>
        <li class="sidebar-item {{ Request::is('log/md') || Request::is('log/md/*') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('log.index', 1) }}">Wanda</a></li>
        <li class="sidebar-item {{ Request::is('log/md') || Request::is('log/md/*') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('log.index', 2) }}">MotorkuX</a></li>
        <li class="sidebar-item {{ Request::is('log/md') || Request::is('log/md/*') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('log.index', 3) }}">Brompit</a></li>
        <li class="sidebar-item {{ Request::is('log/md') || Request::is('log/md/*') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('log.index', 4) }}">Daya Auto</a></li>
        <li class="sidebar-item {{ Request::is('log/md') || Request::is('log/md/*') ? 'active' : '' }}"><a class="sidebar-link" href="">TBA</a></li>
    </ul>
</li>
<li class="sidebar-item">
    <a class="sidebar-link">
        <i class="align-middle me-2 fas fa-fw fa-calendar-minus"></i> <span class="align-middle">TBA</span>
    </a>
</li>