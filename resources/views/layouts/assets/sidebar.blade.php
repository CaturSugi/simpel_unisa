@php
    $userRole = auth()->user()->role; // Assuming you have a role field in your user model

    $menus = [
        (object)[
            'title' => 'Dashboard',
            'url' => '/dashboard',
            'icon' => 'fas fa-fw fa-tachometer-alt',
        ],
    ];

    if ($userRole === 'admin') {
        $menus[] = (object)[
            'title' => 'Master',
            'url' => '#',
            'icon' => 'fas fa-fw fa-cog',
            'submenus' => [
                (object)[
                    'title' => 'User',
                    'url' => '/users'
                ],
                (object)[
                    'title' => 'Jenis Sampah',
                    'url' => '/category'
                ],
                (object)[
                    'title' => 'Jenis Gedung',
                    'url' => '/building'
                ],
            ]
        ];
    }

    $menus[] = (object)[
        'title' => 'Data Sampah',
        'url' => '/limbah',
        'icon' => 'fas fa-fw fa-table'
    ];
    $menus[] = (object)[
        'title' => 'Laporan',
        'url' => '#',
        'icon' => 'fas fa-fw fa-chart-area',
        'submenus' => [
            (object)[
                'title' => 'Laporan Sampah',
                'url' => 'laporan'
            ],
            (object)[
                'title' => 'Laporan Chart',
                'url' => '/charts'
            ],
            (object)[
                'title' => 'Laporan Gedung',
                'url' => '/charts/building'
            ],
        ]
    ];
@endphp


<script>
    function showLogoutModal() {
    $('#logoutModal').modal('show');
    }
</script>



<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('templates/img/logo.png') }}" style="width: 40px;">
        </div>
        <div class="sidebar-brand-text mx-2">Simpel Unisa</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    @foreach ($menus as $menu)
        @if (isset($menu->submenus))
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse{{ Str::slug($menu->title) }}"
                    aria-expanded="true" aria-controls="collapse{{ Str::slug($menu->title) }}">
                    <i class="fas fa-fw {{ $menu->icon }}"></i>
                    <span>{{ $menu->title }}</span>
                </a>
                <div id="collapse{{ Str::slug($menu->title) }}" class="collapse" aria-labelledby="heading{{ Str::slug($menu->title) }}" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">{{ $menu->title }} Components:</h6>
                        @foreach ($menu->submenus as $submenu)
                            <a class="collapse-item" href="{{ $submenu->url }}">{{ $submenu->title }}</a>
                        @endforeach
                    </div>
                </div>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{ $menu->url }}">
                    <i class="fas fa-fw {{ $menu->icon }}"></i>
                    <span>{{ $menu->title }}</span>
                </a>
            </li>
        @endif
        <hr class="sidebar-divider my-1">
    @endforeach

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="/login">Login</a>
                {{-- <a class="collapse-item" href="/register">Register</a> --}}
                {{-- <a class="collapse-item" href="/forgot-password">Forgot Password</a> --}}
                <a class="collapse-item" href="/">Back Home</a>
                <div class="collapse-divider"></div>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>