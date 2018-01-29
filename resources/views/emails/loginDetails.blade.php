<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
</head>
<body>

	<p>Hello {{ $dataForEmail->name }},</p>

	<h4>Your login details as follows:</h4>
	<p>Login email: {{ $dataForEmail->email }}</p>
	<p>Login password: {{ $password }}</p>

	<h4>Your login page link (unique for you) is:</h4>
	<h5><a href="{{url('/')}}/login/{{ $dataForEmail->hash }}">{{url('/')}}/login/{{ $dataForEmail->hash }}</a></h5>

	<p>Bookmark this link or save email, because no other direct login URL is available!</p>

	<p>Regards,</p>
	<p>Hrvoje Zubčić</p>


</body>
</html>