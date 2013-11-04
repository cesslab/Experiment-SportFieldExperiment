<?php namespace SportExperiment\Repository;

use SportExperiment\Repository\Eloquent\User;
use SportExperiment\Repository\Eloquent\Subject;
use SportExperiment\Repository\Eloquent\Session;
use SportExperiment\Repository\Eloquent\Treatment\RiskAversion;
use SportExperiment\Repository\Eloquent\Treatment\WillingnessPay;
use SportExperiment\Repository\Eloquent\Role;
use Illuminate\Support\Facades\Hash;

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
        for ($i = 0; $i < $session->getNumSubjects(); ++$i) {
            $user = new User();
            $user->setUserName("$i");
            $user->setPassword(Hash::make("$i"));
            $user->setActive(true);
            $user->save();

            $subject = new Subject();
            $subject->session()->associate($session);
            $subject->user()->associate($user);
            $subject->save();
        }

    }

    public function saveSession(ModelCollection $modelCollection)
    {
        $sessionModel = $modelCollection->getModel(Session::getNamespace());
        $sessionModel->save();

        $riskAversionModel = $modelCollection->getModel(RiskAversion::getNamespace());
        $riskAversionModel->session()->associate($sessionModel);
        $riskAversionModel->save();

        $willingnessPayModel = $modelCollection->getModel(WillingnessPay::getNamespace());
        $willingnessPayModel->session()->associate($sessionModel);
        $willingnessPayModel->save();

        $this->createSessionSubjects($sessionModel);
    }

    public function getSessions()
    {
        return Session::all();
    }
}
