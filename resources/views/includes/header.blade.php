<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">

        <a
            class="navbar-brand"
            href="#"
        >
            WRC
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div
            class="collapse navbar-collapse"
            id="navbarSupportedContent"
        >
            <ul class="navbar-nav navbar-right">
                <li class="nav-item active">
                    <a
                        class="nav-link"
                        href="{{ route('account') }}"
                    >
                        Account
                    </a>

                    <a
                        class="nav-link"
                        href="{{ route('logout') }}"
                    >
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
