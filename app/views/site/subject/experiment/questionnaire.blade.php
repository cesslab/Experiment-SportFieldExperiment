@extends('site.layouts.generic')

@section('content')
<div class="jumbotron">
    <h1>Questionnaire Here</h1>
    {{ Form::open(array('url'=>$postUrl, 'method'=>'post')) }}
    {{ Form::button('Save Questionnaire', ['type'=>'submit', 'class'=>'btn btn-primary btn-lg'] ) }}
    {{ Form::close() }}
</div>
@stop
