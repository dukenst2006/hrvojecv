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
    }
    #accessParag {
        padding-bottom: 2em;
        color: #FF5722;
    }
    #welcomeFooter {
        margin-top: 5em;
    }
</style>
        
<div class="welcome">
    <a href="#accessTitle" class="icon-arrow-down5" id="arrowDown"></a>
    <a href="#accessTitle" class="icon-arrow-down5" id="arrowDown2"></a>
</div>

<div class="container-fluid" id="guestFormData">
    <h3 id="accessTitle">Request access to CV</h3>
    <p id="accessParag">Registration is super-easy and FREE. <br> Sign up to get permanent full access.</p>
    <div class="row">
    {{ Form::open(['route' => 'access', 'method' => 'POST'])}}

        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            {{ Form::text('name', null, ['placeholder' => 'Please enter your name', 'class' => 'form-control accessInputs', 'required' => 'required']) }}
            {{ Form::email('email', null, ['placeholder' => 'E-mail (important to enter valid e-mail address)', 'class' => 'form-control accessInputs', 'required' => 'required'])}}
            {{ Form::text('company', null, ['placeholder' => 'Your company name (optional)', 'class' => 'form-control accessInputs']) }}
            {{ Form::text('address', null, ['placeholder' => 'Address', 'class' => 'form-control accessInputs', 'required' => 'required']) }}

            {{ Form::submit('Submit Request', ['class' => 'btn btn-warning form-control']) }}
        </div>
        <div class="col-lg-3"></div>

    {{ Form::close() }}
    </div>
    <br>
    <div class="row" id="forgotLoginForm"> 
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <button class="form-control" id="forgotLoginBtn">Forgot your login details?</button>
            {!! Form::open(['route' => 'lostLoginData', 'method' => 'POST' ]) !!}
            {{ Form::email('email', null, ['class' => 'form-control', 'id' => 'forgotEmailInput', 'placeholder' => 'Enter your registered email', 'style' => 'display:none;text-align:center;']) }}
            {{ Form::submit('Submit', ['class' => 'form-control', 'id' => 'forgotLoginSubmit', 'style' => 'display:none']) }}
            {!! Form::close() !!}
        </div>
        <div class="col-lg-3"></div>
    </div>

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

    <div class="container-fluid" id="loginDataResponse">
    {{-- Div for status messages after CRUD operations --}}
    @if (Session::has('message') == 'failure')
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="alert alert-danger">
                    <p>
                        Oops! <br> <br>
                        Unfortunately, I don't recognise user by this e-mail in my records! <br>
                        Please, <a href="mailto:hrcamnlz@gmail.com?subject=Access Request Error">contact me</a> so that I can handle this if you think this is an error or try another e-mail. <br> <br>
                        Regards, <br>
                        Hrvoje Zubcic
                    </p>
                </div>
            </div>
            <div class="col-lg-3"></div>
        </div>
    @endif
    </div>

    <div id="welcomeFooter">
        &copy; 2018. <a href="#" class="navbar-link">{{ $_SERVER['SERVER_NAME'] }}</a> by <a href="mailto:hrcamnlz@gmail.com" class="navbar-link">Hrvoje Zubcic</a>
    </div>

</div>

@endsection

@section('javascripts')
<script type="text/javascript">
    $(document).ready(function() {
        $("#forgotLoginBtn").on("click", function() {
            $("#forgotEmailInput").show();
            $("#forgotLoginSubmit").show();
            $("#forgotLoginBtn").hide();
        });
        $("#loginDataResponse").fadeOut(8000);
        $(".icon-arrow-down5").on("click", function() {
            $('html, body').animate({
                scrollTop: ($('#accessTitle').offset().top)
            },500);
        });
    });
</script>
@endsection