<nav class="nav flex-column">
    @foreach ($list as $row)
        <a href="#" class="nav-link {{ $isActive($row['label']) }}">
            {{ $row['label'] }}
        </a>
    @endforeach
</nav>
