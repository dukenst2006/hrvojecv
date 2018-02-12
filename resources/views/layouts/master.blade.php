<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Hrvoje Zubcic CV</title>

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Global stylesheets -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">

	<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:774149,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
	</script>

</head>

<body class="navbar-bottom">

	<!-- Main navbar -->
	<div class="navbar navbar-inverse">
		<div class="navbar-header">
			<a class="navbar-brand" href="{{ route('home') }}"> {{ config('app.name') }} </a>

			<ul class="nav navbar-nav visible-xs-block">
				<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>

		<div class="navbar" id="navbar-mobile">
			<ul class="nav navbar-nav navbar-right">

				<li class="dropdown dropdown-user">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<span> {{ \Auth::user()->name }}</span>
						<i class="caret"></i>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="{{ route('users.edit', \Auth::id()) }}"><i class="icon-user-plus"></i> My profile</a></li>
						<li class="divider"></li>
						<li><a href="{{ route('change.password', \Auth::id()) }}"><i class="icon-cog5"></i> Change password</a></li>
						<li><a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            <i class="icon-switch2"></i> Logout </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                            </form>
                        </li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page header -->
	<div class="page-header">
		<div class="breadcrumb-line">
			<ul class="breadcrumb">
				<li><span><i class="icon-home2 position-left"></i> Home</span></li>
				<li class="active">@yield('active_page')</li>
			</ul>

			<ul class="breadcrumb-elements">
				<li>
					<a href="https://www.facebook.com/hrvojez02" target="_blank" style="padding-right: 0;padding-left:2px;margin-left:0;margin-right: 0;"><img class="socialMediaIcons" src="{{ asset('images/social_media/facebook.png') }}" style="width: 25px;height: 25px;"></a>
				</li>
				<li>
					<a href="https://twitter.com/hhrcadm" target="_blank" style="padding-right: 0;padding-left:2px;margin-left:0;margin-right: 0;"><img class="socialMediaIcons" src="{{ asset('images/social_media/twitter.jpg') }}" style="width: 25px;height: 25px;"></a>
				</li>
				<li>
					<a href="https://www.linkedin.com/in/hrvoje-zubcic/" target="_blank" style="padding-right: 0;padding-left:2px;margin-left:0;margin-right: 0;"><img class="socialMediaIcons" src="{{ asset('images/social_media/linkedin.png') }}" style="width: 25px;height: 25px;"></a>
				</li>
				<li>
					<a href="https://medium.com/@zubcic.hrvoje" target="_blank" style="padding-right: 0;padding-left:2px;margin-left:0;margin-right: 0;"><img class="socialMediaIcons" src="{{ asset('images/social_media/medium.png') }}" style="width: 60px;height: 25px;"></a>
				</li>
			</ul>
		</div>

		<div class="page-header-content">
			<div class="page-title">
				<h4><a href="{{ route('home') }}"><i class="icon-arrow-left52 position-left"></i></a><span class="text-semibold">Home</span> - @yield('active_page') <small>Hello, {{ \Auth::user()->name }} </small></h4>
			</div>

			<div class="heading-elements">
				<div class="heading-btn-group">
					<a href="{{ route('home') }}" class="btn btn-link btn-float has-text"><i class="icon-home text-primary"></i><span>Homepage</span></a>
					<a href="{{ route('pdfCvDownload') }}" class="btn btn-link btn-float has-text"><i class="icon-file-pdf text-primary"></i> <span>Download CV in PDF</span></a>
					<a href="{{ route('contact.create', \Auth::id()) }}" class="btn btn-link btn-float has-text"><i class="icon-envelop text-primary"></i> <span>Contact</span></a>
				</div>
			</div>
		</div>
	</div>
	<!-- /page header -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			<div class="sidebar sidebar-main sidebar-default">
				<div class="sidebar-content">

					<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-title h6">
							<span>Main navigation</span>
							<ul class="icons-list">
								<li><a href="#" data-action="collapse"></a></li>
							</ul>
						</div>

						<div class="category-content sidebar-user">
							<div class="media">
								<a href="#" class="media-left"><i class="icon-user"></i></a>
								<div class="media-body">
									<span class="media-heading text-semibold">{{ \Auth::user()->name }}</span>
									<div class="text-size-mini text-muted">
										<i class="icon-pin text-size-small"></i> &nbsp; {{ \Auth::user()->address }}
									</div>
								</div>
							</div>
						</div>

						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">

								@can('admin')
								<!-- Admin -->
								<li class="navigation-header"><span>Control Panel</span> <i class="icon-menu" title="Main pages"></i></li>

								<li>
									<a href="{{ route('users.index') }}"><i class="icon-users"></i> <span>Users</span></a>
								</li>

								<li>
									<a href="{{ route('contact.msg.index') }}"><i class="icon-vcard"></i> <span>Contact msg</span></a>
								</li>

								<li>
									<a href="{{ route('job_offer.index') }}"><i class="icon-book"></i> <span>Job offers</span></a>
								</li>

								<li>
									<a href="#"><i class="icon-plus3"></i> <span>Add new...</span></a>
									<ul>
										<li><a href="{{ route('work_experience.create') }}">Work experience</a></li>
										<li><a href="{{ route('projects.create') }}">Project</a></li>
										<li><a href="{{ route('language.create') }}">Language</a></li>
										<li><a href="{{ route('education.create') }}">Education</a></li>
										<li><a href="{{ route('files.create') }}">Source file/Screenshot</a></li>
									</ul>
								</li>

								<li>
									<a href="#"><i class="icon-plus3"></i> <span>Update...</span></a>
									<ul>
										<li><a href="{{ route('personal_info.edit', ['personal_info' => 1]) }}">Personal info</a></li>
									</ul>
								</li>
								<!-- /admin -->
								@endcan

								<!-- Main -->
								<li class="navigation-header"><span>Curriculum Vitae</span> <i class="icon-menu" title="Main pages"></i></li>

								<li>
									<a href="{{ route('personal_info.index') }}"><i class="icon-user"></i> <span>Personal Info</span></a>
								</li>

								<li>
									<a href="{{ route('work_experience.index') }}"><i class="icon-profile"></i> <span>Work Experience</span></a>
								</li>

								<li>
									<a href="{{ route('language.index') }}"><i class="icon-vcard"></i> <span>Languages</span></a>
								</li>

								<li>
									<a href="{{ route('education.index') }}"><i class="icon-book"></i> <span>Education</span></a>
								</li>

								<li>
									<a href="#"><i class="icon-pencil4"></i> <span>Medium</span><span style="color:red;font-size:0.7em;"><sup>*soon*</sup></span></a>
								</li>

								<li>
									<a href="#"><i class="icon-video-camera3"></i> <span>YouTube channel</span><span style="color:red;font-size:0.7em;"><sup>*soon*</sup></span></a>
								</li>
								
								<!-- /main -->

								<!-- More -->
								<li class="navigation-header"><span>More</span> <i class="icon-menu" title="Forms"></i></li>
								<li>
									<a href="{{ route('changelog.index') }}"><i class="icon-newspaper"></i> <span>Changelog</span></a>
								</li>
								<li>
									<a href="{{ route('projects.index') }}"><i class="icon-portfolio"></i> <span>Projects</span></a>
								</li>
								<li>
									<a href="#"><i class="icon-download"></i> <span>Source code area</span></a>
									<ul>
										<li><a href="{{ route('files.index') }}">Download source files</a></li>
										<li><a href="{{ route('screenshots.index') }}">Screenshots</a></li>
									</ul>
								</li>
								<li>
									<a href="#"><i class="icon-unfold"></i> <span>Job</span></a>
									<ul>
										<li><a href="{{ route('job_offer.create') }}">Place/View job offer</a></li>
									</ul>
								</li>
								<li>
									<a href="{{ route('contact.create', \Auth::id()) }}"><i class="icon-mention"></i> <span>Contact</span></a>
								</li>
								
									</ul>
								</li>
								<!-- /page kits -->

							</ul>
						</div>
					</div>
					<!-- /main navigation -->

				</div>
			</div>
			<!-- /main sidebar -->


			<!-- Main content -->
			<div class="content-wrapper">
				<!-- Dashboard content -->
				<div class="row">
					<div class="col-lg-12">
						<div class="container-fluid">
								
							@yield('content')

						</div>
					</div>
				</div>
				<!-- /dashboard content -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->


	<!-- Footer -->
	<div class="navbar navbar-default navbar-fixed-bottom footer">
		<ul class="nav navbar-nav visible-xs-block">
			<li><a class="text-center collapsed" data-toggle="collapse" data-target="#footer"><i class="icon-circle-up2"></i></a></li>
		</ul>

		<div class="navbar-collapse collapse" id="footer">
			<div class="navbar-text">
				&copy; 2018. <a href="#" class="navbar-link">{{ $_SERVER['SERVER_NAME'] }}</a> by <a href="mailto:hrcamnlz@gmail.com" class="navbar-link">Hrvoje Zubcic</a>
			</div>

			<div class="navbar-right">
				<ul class="nav navbar-nav">
					<li><a href="#">Version: 1.0.0 Beta</a></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /footer -->

	<script src="{{ asset('js/scripts.js') }}"></script>

	@yield('javascripts')


</body>
</html>
