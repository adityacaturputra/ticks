<nav class="nav flex-column">
    @foreach ($list as $row)
        <a href="{{ route($row['route']) }}" class="nav-link {{ $isActive($row['label']) }}">
            {{ $row['label'] }}
        </a>
    @endforeach
</nav>
