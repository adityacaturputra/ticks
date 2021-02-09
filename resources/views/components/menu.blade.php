<nav class="nav flex-column">
    @foreach ($list as $row)
        <a href="{{ route($row['route']) }}" class="nav-link {{ $isActive($row['label']) }}">
            <i class="icon-menu {{ $row['icon'] }}"></i> {{ $row['label'] }}
        </a>
    @endforeach
</nav>
