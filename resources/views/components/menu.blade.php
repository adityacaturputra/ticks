<nav class="nav flex-column">
    @foreach ($list as $row)
        <a href="#" class="nav-link @if ($row['label'] == $active)
            active
        @endif">
            {{ $row['label'] }}
        </a>
    @endforeach
</nav>
