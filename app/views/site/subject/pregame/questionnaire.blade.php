@extends('site.layouts.generic')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Pre-Game Questionnaire</h3>
            </div>

            <div class="panel-body">
                {{ Form::open(array('url'=>$postUrl, 'method'=>'post', 'class'=>'form-horizontal', 'role'=>'form')) }}

                {{-- Sport Fan --}}
                <div class="col-sm-11 form-group {{ ($errors->has($sportFan)) ? 'has-error' : '' }} ">
                    {{ Form::label($sportFan, 'Do you like watching sports in general?', ['class'=>'']) }}
                    <p>(1 not very much, 7 more than all other types of entertainment)</p>
                    {{ Form::select($sportFan, $sportFanOptions, 'default', ['class'=>'form-control']) }}
                    <span class="error">{{ $errors->first($sportFan) }}</span>
                </div>

                {{-- Football Fan --}}
                <div class="col-sm-11 form-group {{ ($errors->has($footballFan)) ? 'has-error' : '' }} ">
                    {{ Form::label($footballFan, 'Do you like watching football in particular?', ['class'=>'']) }}
                    <p>(1 not very much, 7 football is my favorite sport to watch)</p>
                    {{ Form::select($footballFan, $footballFanOptions, 'default', ['class'=>'form-control']) }}
                    <span class="error">{{ $errors->first($footballFan) }}</span>
                </div>

                {{-- Favorite Team --}}
                <div class="col-sm-11 form-group {{ ($errors->has($favoriteTeam)) ? 'has-error' : '' }} ">
                    {{ Form::label($favoriteTeam, 'What is your favorite team?', ['class'=>'']) }}
                    {{ Form::select($favoriteTeam, $favoriteTeamOptions, 'default', ['class'=>'form-control']) }}
                    <span class="error">{{ $errors->first($favoriteTeam) }}</span>
                </div>

                {{-- Favored Team --}}
                <div class="col-sm-11 form-group {{ ($errors->has($favoredTeam)) ? 'has-error' : '' }} ">
                    {{ Form::label($favoredTeam, 'Which team are you rooting for in the game today?', ['class'=>'']) }}
                    {{ Form::select($favoredTeam, $favoredTeamOptions, 'default', ['class'=>'form-control']) }}
                    <span class="error">{{ $errors->first($favoredTeam) }}</span>
                </div>

                {{-- Measure Favorite Team --}}
                <div class="col-sm-11 form-group {{ ($errors->has($measureFavoredTeam)) ? 'has-error' : '' }} ">
                    {{ Form::label($measureFavoredTeam, 'How strongly do you care for the team you are rooting for in the game today?', ['class'=>'']) }}
                    <p>(1 not at all, 3 somewhat, 5 a lot, 7 passionately)</p>
                    {{ Form::select($measureFavoredTeam, $measureFavoredTeamOptions, 'default', ['class'=>'form-control']) }}
                    <span class="error">{{ $errors->first($measureFavoredTeam) }}</span>
                </div>

                {{-- Level of Dislike of Opponent Team --}}
                <div class="col-sm-11 form-group {{ ($errors->has($dislikeOpponentTeam)) ? 'has-error' : '' }} ">
                    {{ Form::label($dislikeOpponentTeam, 'How strongly do you dislike the team you are NOT rooting for in the game today?', ['class'=>'']) }}
                    <p>(1 I hate them with a passion, 3 I dislike them somewhat, 5 I like them, 7 I like them almost as much as the other team)</p>
                    {{ Form::select($dislikeOpponentTeam, $dislikeOpponentTeamOptions, 'default', ['class'=>'form-control']) }}
                    <span class="error">{{ $errors->first($dislikeOpponentTeam) }}</span>
                </div>

                {{-- Reason for Rooting --}}
                <div class="col-sm-11 form-group {{ ($errors->has($reasonForRooting)) ? 'has-error' : '' }} ">
                    {{ Form::label($reasonForRooting, 'Why do you want the team you are rooting for to win?', ['class'=>'']) }}
                    {{ Form::select($reasonForRooting, $reasonForRootingOptions, 'default', ['class'=>'form-control']) }}
                    <span class="error">{{ $errors->first($reasonForRooting) }}</span>
                </div>

                <div class="col-sm-11">
                    {{ Form::button('Submit Questionnaire', ['type'=>'submit', 'class'=>'btn btn-default']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop
