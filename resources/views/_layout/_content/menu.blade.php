<li class="sidebar-header">
    main
</li>
<li class="sidebar-item">
    <a class="sidebar-link" href="{{ route('dashboard.index') }}">
        <i class="align-middle me-2 fas fa-fw fa-home"></i> <span class="align-middle">Dashboard</span>
    </a>
</li>
<li class="sidebar-header">
    maintenance
</li>
<li class="sidebar-item">
    <a class="sidebar-link" href="{{ route('maindealer.index') }}">
        <i class="align-middle me-2 fas fa-fw fa-fire"></i> <span class="align-middle">Main Dealer API</span>
    </a>
</li>
<li class="sidebar-item">
    <a class="sidebar-link" href="{{ route('feature.index') }}">
        <i class="align-middle me-2 fas fa-fw fa-brain"></i> <span class="align-middle">Feature</span>
    </a>
</li>
<li class="sidebar-header">
    monitoring
</li>
<li class="sidebar-item">
    <a data-bs-target=#log data-bs-toggle="collapse" class="sidebar-link collapsed">
        <i class="align-middle me-2 fab fa-fw fa-blogger-b"></i> <span class="align-middle">Log</span>
    </a>
    <ul id="log" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
        <li class="sidebar-item"><a class="sidebar-link" href="{{ route('log.index', 1) }}">Wanda</a></li>
    </ul>
    <ul id="log" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
        <li class="sidebar-item"><a class="sidebar-link" href="{{ route('log.index', 2) }}">MotorkuX</a></li>
    </ul>
    <ul id="log" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
        <li class="sidebar-item"><a class="sidebar-link" href="{{ route('log.index', 3) }}">Brompit</a></li>
    </ul>
    <ul id="log" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
        <li class="sidebar-item"><a class="sidebar-link" href="{{ route('log.index', 4) }}">Daya Auto</a></li>
    </ul>
    <ul id="log" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
        <li class="sidebar-item"><a class="sidebar-link" href="">TBA</a></li>
    </ul>
</li>
<li class="sidebar-item">
    <a class="sidebar-link">
        <i class="align-middle me-2 fas fa-fw fa-calendar-minus"></i> <span class="align-middle">TBA</span>
    </a>
</li>