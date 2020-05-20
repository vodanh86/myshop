<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	@yield('aimeos_header')

	<title>Aimeos on Laravel</title>

	@yield('aimeos_styles')

	<link type="text/css" rel="stylesheet" href='https://fonts.googleapis.com/css?family=Roboto:400,300'>
	<link type="text/css" rel="stylesheet" href="/css/app.css">

</head>
<body>
	<nav class="navbar navbar-expand-sm navbar-light">
		<a class="navbar-brand" href="/">
		SEIKA
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				@if (Auth::guest())
					<li class="nav-item navbar-text"><a class="nav-link" href="/login">Login</a></li>
					<!--li class="nav-item navbar-text"><a class="nav-link" href="/register">Register</a></li-->
				@else
					<li class="nav-item navbar-text dropdown">
						<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ route('aimeos_shop_account',['site'=>Route::current()->parameter('site','default'),'locale'=>Route::current()->parameter('locale','en'),'currency'=>Route::current()->parameter('currency','EUR')]) }}" title="Profile">Profile</a></li>
							<li><form id="logout" action="/logout" method="POST">{{csrf_field()}}</form><a href="javascript: document.getElementById('logout').submit();">Logout</a></li>
						</ul>
					</li>
				@endif
			</ul>
			@yield('aimeos_head')
		</div>
	</nav>
	<div>
	</div>
		<ul class="nav nav-pills">
			<li class="nav-item">
				<a class="nav-link " href="/">Trang chủ</a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Giới thiệu công ty</a>
				<div class="dropdown-menu">
				<a class="dropdown-item" href="/intro">Giới thiệu SEKA</a>
				<a class="dropdown-item" href="/rule">Quy định làm việc</a>
				<a class="dropdown-item" href="/account">STK chuyển khoản</a>
				<a class="dropdown-item" href="/share">Bài học chia sẻ kinh nghiệm </a>
				<a class="dropdown-item" href="/event">Sự kiện</a>
				<a class="dropdown-item" href="/template">Hướng dẫn tìm mẫu</a>
				<a class="dropdown-item" href="/size">Bảng size tham khảo </a>
				<a class="dropdown-item" href="/sizes">Hàng lẻ size có sẵn</a>
				</div>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/blogs">Blogs</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/intro">Giới thiệu</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/contact">Liên hệ</a>
			</li>
		</ul>
	</div>
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
		</ol>
		<div class="carousel-inner">
			<div class="carousel-item active">
			<img class="d-block w-100" src="/images/image.png" alt="First slide">
			</div>
			<div class="carousel-item">
			<img class="d-block w-100" src="/images/image1.png" alt="Second slide">
			</div>
			<div class="carousel-item">
			<img class="d-block w-100" src="/images/image2.png" alt="Third slide">
			</div>
		</div>
		<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
    <div class="container">
		@yield('aimeos_stage')
		<div class="row">
		@yield('aimeos_nav')
		@yield('aimeos_body')
		</div>
		@yield('aimeos_aside')
		@yield('content')
	</div>

	<!-- Scripts -->
	<script type="text/javascript" src="/js/app.js"></script>

	@yield('aimeos_scripts')
		<!-- Footer -->
		<footer class="page-footer font-small blue-grey lighten-5">

		<div style="background-color: #f08db2;">
			<div class="container">

			<!-- Grid row-->
			<div class="row py-4 d-flex align-items-center">

				<!-- Grid column -->
				<div class="col-md-6 col-lg-5 text-center text-md-left mb-4 mb-md-0">
				<h6 class="mb-0">Get connected with us on social networks!</h6>
				</div>
				<!-- Grid column -->

				<!-- Grid column -->
				<div class="col-md-6 col-lg-7 text-center text-md-right">

				<!-- Facebook -->
				<a class="fb-ic">
					<i class="fab fa-facebook-f white-text mr-4"> </i>
				</a>
				<!-- Twitter -->
				<a class="tw-ic">
					<i class="fab fa-twitter white-text mr-4"> </i>
				</a>
				<!-- Google +-->
				<a class="gplus-ic">
					<i class="fab fa-google-plus-g white-text mr-4"> </i>
				</a>
				<!--Linkedin -->
				<a class="li-ic">
					<i class="fab fa-linkedin-in white-text mr-4"> </i>
				</a>
				<!--Instagram-->
				<a class="ins-ic">
					<i class="fab fa-instagram white-text"> </i>
				</a>

				</div>
				<!-- Grid column -->

			</div>
			<!-- Grid row-->

			</div>
		</div>

		<!-- Footer Links -->
		<div class="container text-center text-md-left mt-5">

			<!-- Grid row -->
			<div class="row mt-3 dark-grey-text">

			<!-- Grid column -->
			<div class="col-md-3 col-lg-4 col-xl-3 mb-4">

				<!-- Content -->
				<h6 class="text-uppercase font-weight-bold">Company name</h6>
				<hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
				<p>Here you can use rows and columns to organize your footer content. Lorem ipsum dolor sit amet,
				consectetur
				adipisicing elit.</p>

			</div>
			<!-- Grid column -->

			<!-- Grid column -->
			<div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">

				<!-- Links -->
				<h6 class="text-uppercase font-weight-bold">Products</h6>
				<hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
				<p>
				<a class="dark-grey-text" href="#!">MDBootstrap</a>
				</p>
				<p>
				<a class="dark-grey-text" href="#!">MDWordPress</a>
				</p>
				<p>
				<a class="dark-grey-text" href="#!">BrandFlow</a>
				</p>
				<p>
				<a class="dark-grey-text" href="#!">Bootstrap Angular</a>
				</p>

			</div>
			<!-- Grid column -->

			<!-- Grid column -->
			<div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

				<!-- Links -->
				<h6 class="text-uppercase font-weight-bold">Useful links</h6>
				<hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
				<p>
				<a class="dark-grey-text" href="#!">Your Account</a>
				</p>
				<p>
				<a class="dark-grey-text" href="#!">Become an Affiliate</a>
				</p>
				<p>
				<a class="dark-grey-text" href="#!">Shipping Rates</a>
				</p>
				<p>
				<a class="dark-grey-text" href="#!">Help</a>
				</p>

			</div>
			<!-- Grid column -->

			<!-- Grid column -->
			<div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

				<!-- Links -->
				<h6 class="text-uppercase font-weight-bold">Contact</h6>
				<hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
				<p>
				<i class="fas fa-home mr-3"></i> New York, NY 10012, US</p>
				<p>
				<i class="fas fa-envelope mr-3"></i> info@example.com</p>
				<p>
				<i class="fas fa-phone mr-3"></i> + 01 234 567 88</p>
				<p>
				<i class="fas fa-print mr-3"></i> + 01 234 567 89</p>

			</div>
			<!-- Grid column -->

			</div>
			<!-- Grid row -->

		</div>
		<!-- Footer Links -->

		<!-- Copyright -->
		<div class="footer-copyright text-center text-black-50 py-3">© 2020 Copyright:
			<a class="dark-grey-text" href="https://mdbootstrap.com/"> MDBootstrap.com</a>
		</div>
		<!-- Copyright -->

		</footer>
		<!-- Footer -->
	</body>
</html>
