<?php

use SportExperiment\Model\Eloquent\Researcher;
use Illuminate\Support\Facades\DB;

class ResearcherTableSeeder
{
    public function run()
    {
        DB::table(Researcher::$TABLE_KEY)->delete();
        Researcher::create(array(
            Researcher::$ID_KEY=>1,
            Researcher::$FIRST_NAME_KEY=>'Anwar',
            Researcher::$LAST_NAME_KEY=>'Ruff',
            Researcher::$EMAIL_KEY=>'anwar.ruff@nyu.edu',
            'created_at'=>new DateTime,
            'updated_at'=>new DateTime
        ));
    }
}