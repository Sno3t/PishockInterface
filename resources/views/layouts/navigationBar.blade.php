<nav class="navbar mt-3">
    <a href="{{ route('pishock') }}">PiShock control dashboard</a>
    <a href="{{ route('devices.index') }}">Device management</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="decoration-none">Logout</button>
    </form>
</nav>
