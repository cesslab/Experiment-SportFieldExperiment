@extends('site.layouts.generic')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Registration Form</h3>
            </div>
            <div class="panel-body">
                {{ Form::open(array('url'=>$postUrl, 'method'=>'post', 'class'=>'form-horizontal', 'role'=>'form')) }}

                <div class="form-group {{ ($errors->has($firstName)) ? 'has-error' : '' }} ">
                    {{ Form::label($firstName, 'First Name', ['class'=>'col-sm-3 control-label']) }}
                    <div class="col-sm-6">
                        {{ Form::text($firstName, Input::old($firstName), ['class'=>'form-control', 'placeholder'=>'First Name']) }}
                        <span class="error">{{ $errors->first($firstName) }}</span>
                    </div>
                </div>

                <div class="form-group {{ ($errors->has($lastName)) ? 'has-error' : '' }} ">
                    {{ Form::label($lastName, 'Last Name', ['class'=>'col-sm-3 control-label']) }}
                    <div class="col-sm-6">
                        {{ Form::text($lastName, Input::old($lastName), ['class'=>'form-control', 'placeholder'=>'Last Name']) }}
                        <span class="error">{{ $errors->first($lastName) }}</span>
                    </div>
                </div>

                <div class="form-group {{ ($errors->has($profession)) ? 'has-error' : '' }} ">
                    {{ Form::label($profession, 'Profession', ['class'=>'col-sm-3 control-label']) }}
                    <div class="col-sm-6">
                        {{ Form::text($profession, Input::old($profession), ['class'=>'form-control', 'placeholder'=>'Profession']) }}
                        <span class="error">{{ $errors->first($profession) }}</span>
                    </div>
                </div>

                <div class="form-group {{ ($errors->has($education)) ? 'has-error' : '' }} ">
                    {{ Form::label($education, 'Education', ['class'=>'col-sm-3 control-label']) }}
                    <div class="col-sm-6">
                        {{ Form::text($education, Input::old($education), ['class'=>'form-control', 'placeholder'=>'Education']) }}
                        <span class="error">{{ $errors->first($education) }}</span>
                    </div>
                </div>

                <div class="form-group {{ ($errors->has($gender)) ? 'has-error' : '' }} ">
                    {{ Form::label($gender, 'Gender', ['class'=>'col-sm-3 control-label']) }}
                    <div class="col-sm-6">
                        {{ Form::text($gender, Input::old($gender), ['class'=>'form-control', 'placeholder'=>'Gender']) }}
                        <span class="error">{{ $errors->first($gender) }}</span>
                    </div>
                </div>

                <div class="form-group {{ ($errors->has($gender)) ? 'has-error' : '' }} ">
                    {{ Form::label($ethnicity, 'Ethnicity', ['class'=>'col-sm-3 control-label']) }}
                    <div class="col-sm-6">
                        {{ Form::text($ethnicity, Input::old($ethnicity), ['class'=>'form-control', 'placeholder'=>'Ethnicity']) }}
                        <span class="error">{{ $errors->first($ethnicity) }}</span>
                    </div>
                </div>

                <div class="form-group {{ ($errors->has($age)) ? 'has-error' : '' }} ">
                    {{ Form::label($age, 'Age', ['class'=>'col-sm-3 control-label']) }}
                    <div class="col-sm-6">
                        {{ Form::text($age, Input::old($age), ['class'=>'form-control', 'placeholder'=>'Age']) }}
                        <span class="error">{{ $errors->first($age) }}</span>
                    </div>
                </div>

                <div class="col-md-offset-3">
                    {{ Form::button('Register', ['type'=>'submit', 'class'=>'btn btn-default']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop
