You received a message from JobApplier.co.uk:



@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
# Hello!
@endif

{{-- Intro Lines --}}
# You have a new email
<p> <b> Name: </b>  {{$name}} </p>
<p> <b> Email: </b>  {{$email}} </p>
<p> <b> Subject: </b>  {{$subject}} </p>
<p> <b> Message: </b>  {{$user_message}} </p>
<p> <b> IP Address </b> {{$ip_address}} </p>


