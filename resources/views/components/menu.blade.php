<nav class="nav flex-column">
    @foreach ($list as $row)
        <a href="#" class="nav-link">
            {{ $row['label'] }}
        </a>
    @endforeach
</nav>
