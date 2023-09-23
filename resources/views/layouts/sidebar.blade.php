
{{-- DropDown --}}
<div class="topbar">
    <div class="row">
        <div class="col-2">
            <div class="wadahlogo d-flex justify-content-center">
                <img src="{{ asset('storage/Logo/LogoAgroDorang.webp')}}" alt="Logo">
            </div>
        </div>
        <div class="col-10">
            <div class="d-flex justify-content-end">
                <div class="dropdown">
                    <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-list"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li ><a href="{{route('dasboards.index')}}" class="dropdown-item"><i class="bi bi-house-gear me-2"></i>Dasboard</a></li>
                        <li ><a href="{{route('mahals.index')}}" class="dropdown-item"><i class="bi bi-card-list me-2"></i>Katalog Mahal</a></li>
                        <li ><a href="{{route('murahs.index')}}" class="dropdown-item"><i class="bi bi-card-list me-2"></i>Katalog Murah</a></li>
                        <li>
                            <a class="dropdown-item out" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                <i class="bi bi-power"></i> Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- SideBar --}}
<div class="sidebar">
    <div class="d-flex justify-content-center p-2 mb-4" style="background-color:white; border-radius:15px;">
        <img src="{{ asset('storage/Logo/LogoAgroDorang.webp')}}" alt="Logo" style="width: 110px">
    </div>
    <div class="menu ">
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start">
            <li class="nav-item fs-5"><a href="{{route('dasboards.index')}}" class="nav-link"><i class="bi bi-house-gear me-2"></i>Dasboard</a></li>
            <li class="nav-item fs-5"><a href="{{route('mahals.index')}}" class="nav-link"><i class="bi bi-card-list me-2"></i>Katalog Mahal</a></li>
            <li class="nav-item fs-5"><a href="{{route('murahs.index')}}" class="nav-link"><i class="bi bi-card-list me-2"></i>Katalog Murah</a></li>
        </ul>
    </div>
    <div class="logout">
        <a id="navbarDropdown" class="nav-link dropdown-toggle fs-5" href="#" role="button" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }}
        </a>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- <script>
    $(document).ready(function () {
        $("#toggleSidebar").click(function () {
            $(".sidebar").toggle(); // Menampilkan atau menyembunyikan sidebar
        });
    });
</script> --}}
