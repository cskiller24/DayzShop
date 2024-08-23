@auth
    <div {{ $attributes->merge(['class' => 'nav-item dropdown']) }} >
        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
           aria-label="Open user menu">
            <span class="avatar avatar-sm"
                  style="background-image: url('{{ auth()->user()->defaultProfile() }}')"></span>
            <div class="d-none d-xl-block ps-2">
                <div>{{ auth()->user()->name }}</div>
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <a href="#" class="dropdown-item">Status</a>
            <a href="./profile.html" class="dropdown-item">Profile</a>
            <a href="#" class="dropdown-item">Feedback</a>
            <div class="dropdown-divider"></div>
            <a href="{{ route('settings') }}" wire:navigate class="dropdown-item">Settings</a>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button class="dropdown-item">Logout</button>
            </form>
        </div>
    </div>
@endauth

@guest

    <div {{ $attributes->merge(['class' => 'nav-item dropdown']) }} >
        <a class="btn btn-dark" href="{{ route('login') }}" wire:navigate>
            Login
        </a>
    </div>
@endguest
