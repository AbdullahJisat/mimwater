<nav class="navbar navbar-expand-lg navbar-dark navbar1">
    <div class="container-fluid">

        <a class="logo" href="{{ route('index') }}">
            <img src="{{ asset('frontend') }}/image/meem-logooo.png" alt="">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse navcontent1" id="main_nav">
            <ul class="navbar-nav">
                <li class="nav-item active nav-item_con"> <a class="nav-link" href="{{ route('index') }}">Home </a>
                </li>
                <li class="nav-item dropdown nav-item_con">
                    <a class="nav-link  dropdown-toggle" href="" data-bs-toggle="dropdown"> About Us </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('overview') }}"> Overview</a></li>
                        <li><a class="dropdown-item" href="{{ route('chief_message') }}"> Message from chif
                                advisor </a></li>
                        <li><a class="dropdown-item" href="{{ route('ceo_message') }}"> Message from CEO </a></li>
                        <li><a class="dropdown-item" href="{{ route('directors') }}"> Our Team </a></li>
                    </ul>
                </li>
                <li class="nav-item nav-item_con"><a class="nav-link" href="{{ route('products') }}"> Our Products </a>
                </li>
                <li class="nav-item dropdown nav-item_con">
                    <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown"> Facilities </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('gallery') }}"> Production facilities</a></li>
                        <li><a class="dropdown-item" href="{{ route('quality_assurance') }}"> Total Quality Assurance
                            </a></li>

                    </ul>
                </li>
                <li class="nav-item nav-item_con"><a class="nav-link" href="{{ route('contact') }}"> Contact Us</a></li>
                <div class="dropdown">
                <button type="button" class="btn btn-primary btn-sm logInBUtton" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Login
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="{{ route('admin.login') }}">Admin</a></li>
                    <li><a class="dropdown-item" href="{{ route('salesman.login') }}">Salesman</a></li>
                    <li><a class="dropdown-item" href="{{ route('dealer.login') }}">Dealer</a></li>
                    <li><a class="dropdown-item" href="{{ route('retailer.login') }}">Retailer</a></li>
                </ul>
                </div>
            </ul>

        </div>

        <div class="soical-icon">
            <a href="#"><i class="fa-brands fa-facebook-square"></i></a>
            <a href="#"><i class="fa-brands fa-twitter-square"></i></a>
            <a href="#"><i class="fa-brands fa-youtube-square"></i></a>
            <a href="#"><i class="fa-brands fa-pinterest-square"></i></a>
        </div>
    </div>
</nav>
