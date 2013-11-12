@extends('site.layouts.generic')

@section('content')
<h2>Your entry has been submitted. Please wait until the next commercial break to make the next task entry.</h2>
{{ Form::open(array('url'=>$gameUrl, 'method'=>'get')) }}
{{ Form::submit('Next Task Entry') }}
{{ Form::close() }}
@stop
