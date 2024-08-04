@php
    $links = [
        [
            'name' => 'Home',
            'url' => route('admin'),
            'icon' => 'chart-pie',
        ],
        [
            'name' => 'Invites',
            'url' => route('admin.invites'),
            'icon' => 'send',
            'permission' => 'invite::list',
        ],
        [
            'name' => 'Stores',
            'url' => route('admin.stores'),
            'icon' => 'shopping-bag',
            'permission' => 'store::list',
        ],
        [
            'name' => 'Roles and Permissions',
            'url' => route('admin.roles-and-permissions'),
            'icon' => 'scale',
            'permission' => 'roles_permissions::list',
        ],
    ];
@endphp

<aside class="navbar navbar-vertical navbar-expand-lg border-light-subtle border-end" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
                aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-brand mb-0">
            <a href=".">
                <x-base::logo style="height: 3rem"/>
            </a>
        </div>
        <div class="navbar-nav flex-row d-lg-none">
        </div>
        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav">
                @foreach ($links as $link)
                    @if(empty($link['permission']))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ $link['url'] }}" wire:navigate>
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <i class="ti ti-{{ $link['icon'] }} icon"></i>
                                </span>
                                <span class="nav-link-title">
                                    {{ $link['name'] }}
                                </span>
                            </a>
                        </li>
                    @else
                        @can($link['permission'])
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $link['url'] }}" wire:navigate>
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="ti ti-{{ $link['icon'] }} icon"></i>
                                    </span>
                                    <span class="nav-link-title">
                                        {{ $link['name'] }}
                                    </span>
                                </a>
                            </li>
                        @endcan
                    @endif
                @endforeach
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="nav-link">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-logout icon"></i>
                            </span>
                            <span class="nav-link-title">
                                Logout
                            </span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</aside>
