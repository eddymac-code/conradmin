<div class="offcanvas offcanvas-start" tabindex="-1" id="admin-menu" aria-labelledby="admin-menu-label">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="admin-menu-label">{{ env('APP_NAME') }}</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <div class="container-fluid bg-primary h-40 d-flex p-4 justify-content-center">
        <img class="rounded-circle border border-white" @if(!auth()->user()->image)src="{{ asset('images/100x100.png') }}" 
        @else src="" @endif alt="">
      </div>
      <div class="mt-3 fs-3 fw-bold">
        <p>{{ auth()->user()->name }}</p>
      </div>
      <div class="mt-3 ps-5 fs-5 fw-bold py-2 border-bottom">
        <a href="{{ route('home') }}" class="nav-link">
          <i class="fas fa-tachometer-alt mr-3"></i>
          Dashboard
        </a>
      </div>
      <div class="dropdown mt-3 ps-5 fs-5 fw-bold py-2 border-bottom">
        <a class="nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown">
          <i class="fa-solid fa-users mr-3"></i> USERS
        </a>
        <ul class="dropdown-menu w-100">
          <li><a class="dropdown-item ps-6 py-2" href="{{ route('users') }}">View</a></li>
          <li><a class="dropdown-item ps-6 py-2" href="{{ route('users.create') }}">Create</a></li>
        </ul>
      </div>
    </div>
  </div>