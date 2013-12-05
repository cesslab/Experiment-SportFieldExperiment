<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use SportExperiment\Model\Eloquent\UserRole;
use SportExperiment\Model\Eloquent\User;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder 
{
    public function run()
    {
        DB::table(User::$TABLE_KEY)->delete();
        User::create(array(
            User::$ID_KEY=>1,
            User::$USER_NAME_KEY=>'',
            User::$PASSWORD_KEY=>Hash::make(''),
            User::$ROLE_KEY=>  UserRole::$RESEARCHER,
            User::$ACTIVE_KEY=>true,
            'created_at'=>new DateTime,
            'updated_at'=>new DateTime
        ));
    }
}
