@extends('site.layouts.generic')

@section('content')
    <h1>Questionnaire Here</h1>
    {{ Form::open(array('url'=>$postUrl, 'method'=>'post')) }}
    {{ Form::submit('Next') }}
    {{ Form::close() }}
@stop
