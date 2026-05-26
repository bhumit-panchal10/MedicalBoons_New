  <nav class="navbar">
      <div class="container">
          <a class="navbar-brand" href="{{ route('Front.index') }}">
              <img alt="Medical Boons" src="{{ asset('Front/images/logo.jpeg') }}" />
          </a>
          <button class="navbar-toggle">
              <i class="fas fa-bars"></i>
          </button>
          <ul class="navbar-menu">
              <li><a href="{{ route('Front.index') }}">Home</a></li>
              <li><a href="{{ route('Front.AboutUs') }}">About Us</a></li>
              <li><a href="{{ route('Front.Service') }}">Services</a></li>
              <li><a href="{{ route('Front.Plan') }}">Plans</a></li>
              <li><a href="{{ route('Front.Corporate') }}">Corporate</a></li>
              <!-- <li><a href="#">Health Resources</a></li> -->
              <li><a href="{{ route('Front.ContactUs') }}">Contact Us</a></li>
              <li><a class="nav-contact-btn" href="tel:+919974660451"><i class="fas fa-phone"></i>+91 99746 60451</a>
              </li>
          </ul>
      </div>
  </nav>
