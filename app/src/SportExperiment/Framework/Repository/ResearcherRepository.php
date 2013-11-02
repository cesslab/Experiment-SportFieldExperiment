<?php namespace SportExperiment\Framework\Repository;

use SportExperiment\Domain\Model\User;
use SportExperiment\Domain\Model\Role;
use SportExperiment\Domain\Model\ModelCollection;
use SportExperiment\Domain\Model\Experiment\Session;
use SportExperiment\Domain\Model\Experiment\Treatment\RiskAversion;
use SportExperiment\Domain\Model\Experiment\Treatment\WillingnessPay;

use SportExperiment\Domain\Repository\ResearcherRepositoryInterface;
use SportExperiment\Framework\Repository\Eloquent\User as UserModel;
use SportExperiment\Framework\Repository\Eloquent\Subject as SubjectModel;
use SportExperiment\Framework\Repository\Eloquent\Session as SessionModel;
use SportExperiment\Framework\Repository\Eloquent\Treatment\RiskAversion as RiskAversionModel;
use SportExperiment\Framework\Repository\Eloquent\Treatment\WillingnessPay as WillingnessPayModel;

class ResearcherRepository implements ResearcherRepositoryInterface
{
    public function isResearcher(User $user)
    {
        $eloquentUser = UserModel::where('username', $user->getUserName())
            ->where('role', Role::$RESEARCHER)
            ->where('active', true)->first();

        // Researcher not found
        if ($eloquentUser == null) 
            return false;

        return \Hash::check($user->getPassword(), $eloquentUser->password);
    }

    public function saveUser(User $user)
    {
        $userModel = new UserModel($user->toArray());
        $userModel->save();
        return $userModel;
    }

    private function createSessionSubjects(SessionModel $sessionModel)
    {
        // Add Subjects
        for ($i = 0; $i < $sessionModel->getNumSubjects(); ++$i) {
            $userModel = new UserModel();
            $userModel->setUserName("$i");
            $userModel->setPassword(Hash::make("$i"));
            $userModel->setActive(true);
            $userModel->save();

            $subject = new SubjectModel();
            $subject->session()->associate($sessionModel);
            $subject->user()->associate($userModel);
            $subject->save();
        }

    }

    public function saveSession(ModelCollection $modelCollection)
    {
        $sessionModel = new SessionModel($modelCollection->getModel(ExperimentSession::getNamespace())->toArray());
        $sessionModel->save();

        $riskAversionModel = new RiskAversionModel($modelCollection->getModel(RiskAversion::getNamespace())->toArray());
        $riskAversionModel->session()->associate($sessionModel);
        $riskAversionModel->save();

        $willingnessPayModel = new WillingnessPayModel($modelCollection->getModel(WillingnessPay::getNamespace())->toArray());
        $willingnessPayModel->session()->associate($sessionModel);
        $willingnessPayModel->save();

        $this->createSessionSubjects($sessionModel);
    }

    public function getSessions()
    {
        return SessionModel::all();
    }
}
