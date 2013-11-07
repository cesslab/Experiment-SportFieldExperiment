<?php namespace SportExperiment\Repository;

use SportExperiment\Repository\Eloquent\User;
use SportExperiment\Repository\Eloquent\Subject;
use SportExperiment\Repository\Eloquent\Session;
use SportExperiment\Repository\Eloquent\Treatment\RiskAversion;
use SportExperiment\Repository\Eloquent\Treatment\WillingnessPay;
use SportExperiment\Repository\Eloquent\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use SportExperiment\Repository\Eloquent\Subject\GameState;

class ResearcherRepository implements ResearcherRepositoryInterface
{
    public function isResearcher(User $user)
    {
        $userModel = User::where('username', $user->getUserName())
            ->where('role', Role::$RESEARCHER)
            ->where('active', true)->first();

        // Researcher not found
        if ($userModel == null)
            return false;

        return Hash::check($user->getPassword(), $userModel->password);
    }

    private function createSessionSubjects(Session $session)
    {
        // Add Subjects
        $id = DB::table(Subject::$TABLE_KEY)->max(Subject::$ID_KEY) + 1;
        for ($i = 1; $i <= $session->getNumSubjects(); ++$i, ++$id) {
            $user = new User();
            $user->setUserName("$id");
            $user->setPassword(Hash::make("pass$id"));
            $user->setRole(Role::$SUBJECT);
            $user->setActive(true);
            $user->save();

            $subject = new Subject();
            $subject->setGameState(new GameState(GameState::$REGISTRATION));
            $subject->session()->associate($session);
            $subject->user()->associate($user);
            $subject->save();
        }
    }

    public function saveSession(ModelCollection $modelCollection)
    {
        $session = $modelCollection->getModel(Session::getNamespace());
        $session->save();

        $riskAversion = $modelCollection->getModel(RiskAversion::getNamespace());
        $riskAversion->session()->associate($session);
        $riskAversion->save();

        $willingnessPay = $modelCollection->getModel(WillingnessPay::getNamespace());
        $willingnessPay->session()->associate($session);
        $willingnessPay->save();

        $this->createSessionSubjects($session);
    }

    public function getSessions()
    {
        return Session::all();
    }

    public function getSubjects()
    {
        return Subject::all();
    }
}
