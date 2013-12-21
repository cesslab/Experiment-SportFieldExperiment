<?php

use SportExperiment\Model\Eloquent\DictatorEntry;
use SportExperiment\Model\Eloquent\GameQuestionnaire;
use SportExperiment\Model\Eloquent\Charity;
use SportExperiment\Model\Eloquent\Good;
use SportExperiment\Model\Eloquent\WillingnessPayEntry;
use SportExperiment\Model\Eloquent\RiskAversionEntry;
use SportExperiment\Model\Eloquent\TrustProposerEntry;
use SportExperiment\Model\Eloquent\PreGameQuestionnaire;

return array(

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| such as the size rules. Feel free to tweak each of these messages.
	|
	*/

	"accepted"         => "The :attribute must be accepted.",
	"active_url"       => "The :attribute is not a valid URL.",
	"after"            => "The :attribute must be a date after :date.",
	"alpha"            => "The :attribute may only contain letters.",
	"alpha_dash"       => "The :attribute may only contain letters, numbers, and dashes.",
	"alpha_num"        => "The :attribute may only contain letters and numbers.",
	"array"            => "The :attribute must be an array.",
	"before"           => "The :attribute must be a date before :date.",
	"between"          => array(
		"numeric" => "The :attribute must be between :min - :max.",
		"file"    => "The :attribute must be between :min - :max kilobytes.",
		"string"  => "The :attribute must be between :min - :max characters.",
		"array"   => "The :attribute must have between :min - :max items.",
	),
	"confirmed"        => "The :attribute confirmation does not match.",
	"date"             => "The :attribute is not a valid date.",
	"date_format"      => "The :attribute does not match the format :format.",
	"different"        => "The :attribute and :other must be different.",
	"digits"           => "The :attribute must be :digits digits.",
	"digits_between"   => "The :attribute must be between :min and :max digits.",
	"email"            => "The :attribute format is invalid.",
	"exists"           => "The selected :attribute is invalid.",
	"image"            => "The :attribute must be an image.",
	"in"               => "The selected :attribute is invalid.",
	"integer"          => "The :attribute must be an integer.",
	"ip"               => "The :attribute must be a valid IP address.",
	"max"              => array(
		"numeric" => "The :attribute may not be greater than :max.",
		"file"    => "The :attribute may not be greater than :max kilobytes.",
		"string"  => "The :attribute may not be greater than :max characters.",
		"array"   => "The :attribute may not have more than :max items.",
	),
	"mimes"            => "The :attribute must be a file of type: :values.",
	"min"              => array(
		"numeric" => "The :attribute must be at least :min.",
		"file"    => "The :attribute must be at least :min kilobytes.",
		"string"  => "The :attribute must be at least :min characters.",
		"array"   => "The :attribute must have at least :min items.",
	),
	"not_in"           => "The selected :attribute is invalid.",
	"numeric"          => "The :attribute must be a number.",
	"regex"            => "The :attribute format is invalid.",
	"required"         => "The :attribute field is required.",
	"required_if"      => "The :attribute field is required when :other is :value.",
	"required_with"    => "The :attribute field is required when :values is present.",
	"required_without" => "The :attribute field is required when :values is not present.",
	"same"             => "The :attribute and :other must match.",
	"size"             => array(
		"numeric" => "The :attribute must be :size.",
		"file"    => "The :attribute must be :size kilobytes.",
		"string"  => "The :attribute must be :size characters.",
		"array"   => "The :attribute must contain :size items.",
	),
	"unique"           => "The :attribute has already been taken.",
	"url"              => "The :attribute format is invalid.",
    "integer_values"    => "The :attribute must contain only integers.",
    "integer_keys"    => "The :attribute must contain only integers keys.",
    "has_key_values"    => "The :attribute key may only contain valid values.",
    "has_values"    => "The :attribute may only contain valid values.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => array(
        /*
         * Game Questionnaire
         */
        PreGameQuestionnaire::$SPORT_FAN_KEY => array(
            'required'=>'An entry between 1 and 7 is required',
            'in'=>'An entry between 1 and 7 is required'
        ),
        PreGameQuestionnaire::$FOOTBALL_FAN_KEY => array(
            'required'=>'An entry between 1 and 7 is required',
            'in'=>'An entry between 1 and 7 is required'
        ),
        PreGameQuestionnaire::$FAVORITE_TEAM_KEY => array(
            'required'=>'A team selection is required',
            'integer'=>'A team selection is required',
            'in'=>'An team must be selected',
            'min'=>'An team must be selected',
        ),
        PreGameQuestionnaire::$FAVORED_TEAM_KEY => array(
            'required'=>'A team selection is required',
            'integer'=>'A team selection is required',
            'in'=>'An team must be selected',
            'min'=>'An team must be selected',
        ),
        PreGameQuestionnaire::$MEASURE_FAVORED_TEAM_KEY => array(
            'required'=>'An entry between 1 and 7 is required',
            'in'=>'An entry between 1 and 7 is required'
        ),
        PreGameQuestionnaire::$DISLIKE_OPPONENT_TEAM_KEY => array(
            'required'=>'An entry between 1 and 7 is required',
            'in'=>'An entry between 1 and 7 is required'
        ),
        PreGameQuestionnaire::$REASON_FOR_ROOTING_KEY => array(
            'required'=>'A selection is required',
            'in'=>'A selection is required'
        ),
        /*
         * Game Questionnaire
         */
        GameQuestionnaire::$LEVEL_EXCITATION_KEY => array(
            'required'=>'An entry between 1 and 7 is required',
            'in'=>'An entry between 1 and 7 is required'
        ),
        GameQuestionnaire::$LEVEL_SURPRISE_KEY => array(
            'required'=>'An entry between 1 and 7 is required',
            'in'=>'An entry between 1 and 7 is required'
        ),
        GameQuestionnaire::$LEVEL_HAPPINESS_KEY => array(
            'required'=>'An entry between 1 and 7 is required',
            'in'=>'An entry between 1 and 7 is required'
        ),
        GameQuestionnaire::$LIKELINESS_WINNING_KEY => array(
            'in'=> 'An entry between 0 and 100 is required',
            'required'=> 'An entry between 0 and 100 is required'
        ),
        /*
         * Charity
         */
        Charity::$CHARITY_KEY => array(
            'required' => 'One of the charities listed must be selected',
            'integer' => 'One of the charities listed must be selected',
            'in' => 'One of the charities listed must be selected'
        ),
        /*
         * Dictator Entry
         */
        DictatorEntry::$DICTATOR_ALLOCATION_KEY => array(
            'required' => 'A donation value entry is required',
            'numeric' => 'The donation value must be a number',
            'min' => 'A donation value of at least $:min is required',
            'max' => 'A donation value of at most $:max is required'
        ),
        /*
         * Good
         */
        Good::$GOOD_KEY => array(
            'required' => 'One of the goods listed must be selected',
            'integer' => 'One of the goods listed must be selected',
            'in' => 'One of the goods listed must be selected'
        ),
        /*
         * Willingness Pay Entry
         */
        WillingnessPayEntry::$WILLING_PAY_KEY => array(
            'required' => 'An entry is required',
            'in' => 'One of the values listed must be selected',
            'min' => 'The entered value must be at least $:min',
            'max' => 'The entered value must be at most $:max'
        ),
        /*
         * Risk Aversion Entry
         */
        RiskAversionEntry::$GAMBLE_PAYMENT_KEY => array(
            'required' => 'An entry is required',
            'numeric' => 'A numeric value must be entered',
            'min' => 'The entered value must be at least $:min',
            'max' => 'The entered value must be at most $:max'
        ),
        TrustProposerEntry::$ALLOCATION_KEY => array(
            'required' => 'An entry is required',
            'numeric' => 'A numeric value must be entered',
            'in' => 'One of the values listed must be selected',
        )
    ),

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(),

);
