@extends('layouts.master')

@section('content')

<style type="text/css">
    ul {
        list-style-type: none;
    }
</style>

{{-- Div for status messages after CRUD operations --}}
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif


<div class="row" style="text-align: center;">
    <div class="col-lg-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h4>Welcome {{ \Auth::user()->name }}!</h4>
            </div>
            <div class="panel-body">
                <p>Glad to have you on board :)</p>

                <p>First things first...</p>

                <p>If you don't want to explore the app, but just see the CV, you can simply click on <a href="{{ route('pdfCvDownload') }}">this link</a> and get the latest PDF copy of my CV. (I update my CV in this app first, then in all the other sites)</p>
                <p>Please note that it takes some time for PDF to start downloading. Please have a little patience until I find out what makes it so slow.</p>
                <p>Also, all referencing links are in top-right corner of navbar (Linkedin, Twitter, Medium etc.)</p>

                <h3>The CV</h3>

                <p>You can check all the newest information about my personal information, work experience, projects etc. by clicking on the corresponding menu item in the left navbar. (section "Curriculum Vitae")</p>

                <ul>
                    <li>"Personal Info" - current location, contact info etc.</li>
                    <li>"Work Experience" - from top to bottom, newest to oldest</li>
                    <li>"Languages" - Spoken languages and level of familiarity</li>
                    <li>"Education" - Elementary school, high school, college, courses etc.</li>
                    <li>"Medium" - Articles posted on medium.com </li>
                    <li>"YouTube Channel" - Tutorial series in given area</li>
                </ul>

                <h3>More...</h3>

                <p>Little bit of a demostration of understanding PHP with Laravel. Not too much as I recon that not much people would investigate the project deeply (but with time, I will make it more complex application despite that fact)</p>

                <ul>
                    <li>"Changelog" - See the latest implementations, features, bugfixes etc. that were pushed into project</li>
                    <li>"Projects" - Find out all projects that involved my humble participation (private or for companies) </li>
                    <li>"Source code area" - Download source files from project or individual. Also, you can see and/or download some screenshots.</li>
                    <li>"Job" - Propose a job offer, track it's status, get notified of response and write messages (chat-board) between you and me only.</li>
                    <li>"Contact" - Contact form, but not mailer. Instead, I've made a chat-board for this also (not related to job chat-board) so we can exchange messages live, or you can choose to get notified by email when I answer the message.</li>
                </ul>

                <h5 style="margin-top:3em;">Enjoy your stay and come back to stay tuned :)</h5>

                <p style="margin-top:5em;">Regards, <br> Hrvoje Zubcic</p>
            </div>
        </div> 
    </div>
</div>
@endsection

@section('javascripts')
<script type="text/javascript">
    $(document).ready(function() {
        $(".alert").fadeOut(2000);
    });
</script>
@endsection
