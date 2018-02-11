<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="charset=utf-8"/>

	<title>Hrvoje Zubcic CV</title>

	<!-- Global stylesheets -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
</head>
<body>
	<style type="text/css">
		.nameSurname {
			font-weight: 800;
			font-size: 2em;
		}
		hr {
			border-color: orange;
		}
		th {
			text-align: center;
		}
		td {
			text-align: center;
		}
		#cvPdf {
			margin-top:30px;
		}
		.centerMe {
			text-align: center;
		}
		.boldMe {
			font-weight: 800;
		}
	</style>


<div class="container" id="cvPdf">
	<div class="row centerMe">
		<div class="col-12">
			<span class="nameSurname">{{ $data[0]['personalInfo'][0]['name'] }}</span>
			<span class="nameSurname">{{ $data[0]['personalInfo'][0]['surname'] }}</span>
		</div>
	</div>
	<div class="row centerMe">
		<div class="col-12">
			<span>{{ $data[0]['personalInfo'][0]['house_no'] }} {{ $data[0]['personalInfo'][0]['street'] }}, {{ $data[0]['personalInfo'][0]['current_residence'] }}, {{ $data[0]['personalInfo'][0]['state'] }}</span>
		</div>
	</div>

	<hr>

	<div class="row">
		<div class="col-lg-12 centerMe boldMe" style="font-size:1.5em;padding-top: 12px;">
			<span>@{!! {{ $data[0]['personalInfo'][0]['position'] }} !!}</span>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 centerMe boldMe"padding-bottom: 12px;">
			<span>Key skills: {{ $data[0]['personalInfo'][0]['key_skills'] }}</span>
		</div>
	</div>

	<hr>

	<div class="row">
		<div class="col-lg-12 col-md-12">
			<h5 class="centerMe boldMe">Personal info</h5>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 centerMe">
			<strong>Name:</strong> <span>{{ $data[0]['personalInfo'][0]['name'] }}</span> |
			<strong>Surname:</strong> <span>{{ $data[0]['personalInfo'][0]['surname'] }}</span> |
			<strong>DOB:</strong> <span>{{ $data[0]['personalInfo'][0]['dob'] }}</span> |
			<strong>Gender:</strong> <span>{{ $data[0]['personalInfo'][0]['gender'] }}</span> |
			<strong>Nationality:</strong> <span>{{ $data[0]['personalInfo'][0]['nationality'] }}</span> <br>
			<strong>Address:</strong> <span>{{ $data[0]['personalInfo'][0]['house_no'] }} {{ $data[0]['personalInfo'][0]['street'] }}, {{ $data[0]['personalInfo'][0]['current_residence'] }}, {{ $data[0]['personalInfo'][0]['state'] }}</span> |
			<strong>Mobile:</strong> <span>0976622218</span> <br>
			<strong>E-mail/Skype:</strong> <span>hrcamnlz@gmail.com</span>
		</div>
	</div>

	<br><br>
	<hr>

	<div class="row">
		<div class="col-lg-12 col-md-12 centerMe">
			<h5 class="centerMe boldMe">Professional summary</h5>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 centerMe">
			<p>{{ $data[0]['personalInfo'][0]['summary'] }}</p>
		</div>
	</div>

	<br>
	<hr>

	<div class="row">
		<div class="col-lg-12 col-md-12">
			<h5 class="centerMe boldMe">Languages</h5>
		</div>
	</div>

	<div class="row centerMe boldMe">
		<div class="col-lg-3 col-md-3">
			Language
		</div>
		<div class="col-lg-3 col-md-3">
			Understanding
		</div>
		<div class="col-lg-3 col-md-3">
			Speach
		</div>
		<div class="col-lg-3 col-md-3">
			Writing
		</div>
	</div>

	@foreach($data[3]['language'] as $lang)
	<div class="row centerMe">
		<div class="col-lg-3 col-md-3 boldMe">
			{{ $lang['title'] }}
		</div>
		<div class="col-lg-3 col-md-3">
			{{ $lang['understanding'] }}
		</div>
		<div class="col-lg-3 col-md-3">
			{{ $lang['speach'] }}
		</div>
		<div class="col-lg-3 col-md-3">
			{{ $lang['writing'] }}
		</div>
	</div>
	@endforeach

	<br>
	<hr>
	
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<h5 class="centerMe boldMe" style="margin-bottom: 0;">Work Experience</h5>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<p class="centerMe" style="font-size: 0.7em;margin-top: 0;">* from newest</p>
		</div>
	</div>

	<div class="container" style="padding-bottom: 10px;">
		<table style="width: 100%;">
			<thead>
				<tr>
					<th>Company</th>
					<th>Sector</th>
					<th>Address</th>
					<th>Position</th>
					<th>Worked from</th>
					<th>Worked till</th>
					<th>More details</th>
				</tr>
			</thead>
			<tbody>
				@foreach($data[2]['workExperience'] as $job)
				<tr>
					<td>{{ $job['company'] }}</td>
					<td>{{ $job['sector'] }}</td>
					<td>{{ $job['address'] }}</td>
					<td>{{ $job['position'] }}</td>
					<td>{{ $job['work_from'] }}</td>
					@if($job['work_to'] == '')
					<td>Currently employed</td>
					@endif
					<td>{{ $job['work_to'] }}</td>
					<td>{{ $job['desc'] }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<br>
	<hr>

	<div class="row">
		<div class="col-lg-12 col-md-12">
			<h5 class="centerMe boldMe">Education</h5>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-3 col-md-3">
			Institute
		</div>
		<div class="col-lg-3 col-md-3">
			Major
		</div>
		<div class="col-lg-3 col-md-3">
			Period
		</div>
		<div class="col-lg-3 col-md-3">
			Additional info
		</div>
	</div>
	<div class="row">
		@foreach($data[1]['education'] as $school)
			<div class="col-lg-3">{{ $school['institute'] }}</div>
			<div class="col-lg-3">{{ $school['title'] }}</div>
			<div class="col-lg-3">{{ $school['period'] }}</div>
			@if($school['add_info'] == '')
			<div class="col-lg-3"> - </div>
			@endif
			<div class="col-lg-3">{{ $school['add_info'] }}</div>
		@endforeach
	</div>

	@if(count($data[4]['projects']) < 1)
	@else

	<br>
	<hr>

	<div class="row">
		<div class="col-lg-12 col-md-12">
			<h5 class="centerMe boldMe" style="margin-bottom: 0;">Projects</h5>
		</div>
	</div>

	<div class="container" style="margin-top:2em;">
		<table style="width: 100%;">
			<thead>
				<tr>
					<th>Name</th>
					<th>Type</th>
					@if($data[4]['projects'][0]['type'] == 'corporate')
					<th>Company</th>
					@endif
					<th>URL</th>
					<th>Technology</th>
					<th>Description</th>
				</tr>
			</thead>
			<tbody>
				@foreach($data[4]['projects'] as $project)
				<tr>
					<td>{{ $project['name'] }}</td>
					<td>{{ $project['type'] }}</td>
					@if($project['type'] == 'corporate')
					<td>{{ $project['company'] }}</td>
					@endif
					<td>{{ $project['url'] }}</td>
					<td>{{ $project['technology'] }}</td>
					<td>{{ $project['description'] }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	@endif

	<br><br><br><br>
	<hr>

	<div class="container centerMe" style="padding-top:15px;">
		<span class="centerMe">CV template Copyright @ Hrvoje Zubcic</span>
	</div>


</div>


<script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>