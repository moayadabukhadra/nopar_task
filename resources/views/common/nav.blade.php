<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-3">
    <a class="navbar-brand fw-bolder fs-4" href="#">Nopar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="/companies">Companies</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/employees">Employees</a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a onclick="$(this).closest('form').submit()" class="text-danger fw-bold nav-link">
                        Logout
                    </a>
                </form>
            </li>
        </ul>
    </div>
</nav>
