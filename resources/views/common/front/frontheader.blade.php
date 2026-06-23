<style>
    .navbar-menu li a.active {
        color: #0d6efd;
        font-weight: 700;
    }

    .navbar-menu li a.active::after {
        width: 100%;
    }

    .navbar-menu li a {
        position: relative;
    }

    .navbar-menu li a::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -5px;
        width: 0;
        height: 2px;
        background: #0d6efd;
        transition: 0.3s;
    }

    .navbar-menu li a:hover::after,
    .navbar-menu li a.active::after {
        width: 100%;
    }
</style>
<nav class="navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('Front.index') }}">
            <img alt="Medical Boons" src="{{ asset('Front/images/logo.jpeg') }}" />
        </a>

        <button class="navbar-toggle">
            <i class="fas fa-bars"></i>
        </button>

        <ul class="navbar-menu">
            <li>
                <a href="{{ route('Front.index') }}" class="{{ request()->routeIs('Front.index') ? 'active' : '' }}">
                    Home
                </a>
            </li>

            <li>
                <a href="{{ route('Front.AboutUs') }}"
                    class="{{ request()->routeIs('Front.AboutUs') ? 'active' : '' }}">
                    About Us
                </a>
            </li>

            <li>
                <a href="{{ route('Front.Service') }}"
                    class="{{ request()->routeIs('Front.Service') ? 'active' : '' }}">
                    Services
                </a>
            </li>

            <li>
                <a href="{{ route('Front.Plan') }}" class="{{ request()->routeIs('Front.Plan') ? 'active' : '' }}">
                    Plans
                </a>
            </li>

            <li>
                <a href="{{ route('Front.Corporate') }}"
                    class="{{ request()->routeIs('Front.Corporate') ? 'active' : '' }}">
                    Corporate
                </a>
            </li>

            <li>
                <a href="{{ route('Front.ContactUs') }}"
                    class="{{ request()->routeIs('Front.ContactUs') ? 'active' : '' }}">
                    Contact Us
                </a>
            </li>

            <li>
                <a class="nav-contact-btn" href="tel:+919974660451">
                    <i class="fas fa-phone"></i>+91 99746 60451
                </a>
            </li>
        </ul>
    </div>
</nav>
