@extends('layouts.app')
@section('content')
<style type="text/css">
    .welcome {
        background-image: url('/images/carousel/laravel.jpg');
        background-size: 100% auto;
        background-repeat: no-repeat;
        background-clip: border-box;
        background-color: #303030;
        height: 100vh;
        max-width: 100vw;
        display: flex;
        flex-direction: row;
        justify-content: center;
        position: relative;
    }
    #guestFormData {
        text-align: center;
        width: 100%;
    }
    .row {
        max-width: 100vw;
        padding-top: 0;
        margin-top: 0;
    }
    .accessInputs {
        background-color: #303030;
        text-align: center;
        color: #FF5722;
    }
    #arrowDown {
        position:absolute;
        color: #FF5722;
        font-size: 5em;
        top:80%;
    }
    #arrowDown2 {
        position:absolute;
        color: #FF5722;
        font-size: 5em;
        top:85%;
    }
    #accessTitle {
        padding-top: 2em;
        padding-bottom: 2em;
    }
    #welcomeFooter {
        margin-top: 5em;
    }
</style>
        
<div class="welcome">
    <span class="icon-arrow-down5" id="arrowDown"></span>
    <span class="icon-arrow-down5" id="arrowDown2"></span>
</div>

<div class="container-fluid" id="guestFormData">
    <h3 id="accessTitle">Request access to CV</h3>
    <div class="row">
    {{ Form::open(['route' => 'access', 'method' => 'POST'])}}

        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            {{ Form::text('name', null, ['placeholder' => 'Please enter your name', 'class' => 'form-control accessInputs', 'required' => 'required']) }}
            {{ Form::email('email', null, ['placeholder' => 'E-mail (important to enter valid e-mail address)', 'class' => 'form-control accessInputs', 'required' => 'required'])}}
            {{ Form::text('company', null, ['placeholder' => 'Your company name (optional)', 'class' => 'form-control accessInputs', 'required' => 'required']) }}
            {{ Form::text('address', null, ['placeholder' => 'Address', 'class' => 'form-control accessInputs', 'required' => 'required']) }}

            {{ Form::submit('Submit Request', ['class' => 'btn btn-warning form-control']) }}
        </div>
        <div class="col-lg-3"></div>
    </div>

    {{ Form::close() }}

    @if ($errors->any())
    <div class="container-fluid" id="errorDiv" style="padding-top: 3em;">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="alert alert-danger">
                    <ul style="list-style-type: none;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <p>Please try again or <a href="mailto:hrcamnlz@gmail.com">report</a> the problem with your request.</p>
                </div>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>
    @endif

    <div id="welcomeFooter">
        &copy; 2018. <a href="#" class="navbar-link">{{ $_SERVER['SERVER_NAME'] }}</a> by <a href="mailto:hrcamnlz@gmail.com" class="navbar-link">Hrvoje Zubcic</a>
    </div>

</div>

@endsection