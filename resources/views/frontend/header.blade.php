 <!-- Top Bar Start -->
 <div class="top-bar">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-6">
				<div class="logo"> 
					<a href="/">
						<h2
							style="margin: 0;color: #aa9166;font-size: 52px;line-height: 55px;font-weight: 800;">
							AdvocaseeNgp</h2>
					</a>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="top-bar-right">
					{{-- <div class="text">
						<h2>8:00 - 9:00</h2>
						<p>Opening Hour Mon - Fri</p>
					</div> --}}
					{{-- <div class="text">
						<h2>+123 456 7890</h2>
						<p>Call Us For Free Consultation</p>
					</div> --}}
					<div class="social">
						<a href=""><i class="fab fa-twitter"></i></a>
						<a href=""><i class="fab fa-facebook-f"></i></a>
						<a href=""><i class="fab fa-linkedin-in"></i></a>
						<a href=""><i class="fab fa-instagram"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Top Bar End -->

<!-- Nav Bar Start -->
<div class="nav-bar">
	<div class="container-fluid">
		<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
			<a href="#" class="navbar-brand">MENU</a>
			<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
				<div class="navbar-nav ml-auto">
					&nbsp;
					{{-- <a href="index.html" class="nav-item nav-link active">Home</a>
					<a href="about.html" class="nav-item nav-link">About</a>
					<a href="service.html" class="nav-item nav-link">Practice</a>
					<a href="team.html" class="nav-item nav-link">Attorneys</a>
					<a href="portfolio.html" class="nav-item nav-link">Case Studies</a>
					<div class="nav-item dropdown">
						<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
						<div class="dropdown-menu">
							<a href="blog.html" class="dropdown-item">Blog Page</a>
							<a href="single.html" class="dropdown-item">Single Page</a>
						</div>
					</div>
					<a href="contact.html" class="nav-item nav-link">Contact</a> --}}
					@if (Route::has('login'))
					@auth
					<a class="nav-item nav-link" href="{{ url('/home') }}">Home</a>
					@else
					<a class="nav-item nav-link" href="{{ route('login') }}">Login</a>
					@if (Route::has('register'))
					<a class="nav-item nav-link" href="{{ route('register') }}">Register</a>
					@endif
					@endif
					@endif
				</div> 
			</div>
		</nav>
	</div>
</div>
 <!-- Nav Bar End -->