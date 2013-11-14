<?php namespace SportExperiment\Model;

use SportExperiment\Model\Eloquent\UltimatumTreatment;
use SportExperiment\Model\Eloquent\User;
use SportExperiment\Model\Eloquent\Subject;
use SportExperiment\Model\Eloquent\Session;
use SportExperiment\Model\Eloquent\RiskAversionTreatment;
use SportExperiment\Model\Eloquent\WillingnessPayTreatment;
use SportExperiment\Model\Eloquent\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use SportExperiment\Model\Eloquent\SubjectState;
use SportExperiment\Model\Eloquent\SessionState;
use SportExperiment\Model\Eloquent\UltimatumRole;

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
        $ultimatumSubjects = [UltimatumRole::getProposerId()=>[], UltimatumRole::getReceiverId()=>[]];
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
            $subject->setState(SubjectState::$REGISTRATION);
            $subject->session()->associate($session);
            $subject->user()->associate($user);
            $subject->save();

            // Select Proposers and Senders
            $roleId = ($i % 2) ? UltimatumRole::getProposerId() : UltimatumRole::getReceiverId();
            $ultimatumSubjects[$roleId][] = $subject;

            // Assign Ultimatum Role
            $ultimatumRole = new UltimatumRole();
            $ultimatumRole->setRole($roleId);
            $ultimatumRole->save();


            $ultimatumRole->subject()->associate($subject);
            $subject->save();

            $ultimatumRole->save();
        }

        $ultimatumTreatment = new UltimatumTreatment();
        $ultimatumTreatment->matchSubjects(
            $ultimatumSubjects[UltimatumRole::getProposerId()],
            $ultimatumSubjects[UltimatumRole::getReceiverId()]);
    }

    private function matchUltimatumSubjects($subjects)
    {
    }

    public function saveSession(ModelCollection $modelCollection)
    {
        $session = $modelCollection->getModel(Session::getNamespace());
        $session->setState(SessionState::$STOPPED);
        $session->save();

        $riskAversion = $modelCollection->getModel(RiskAversionTreatment::getNamespace());
        $riskAversion->session()->associate($session);
        $riskAversion->save();

        $willingnessPay = $modelCollection->getModel(WillingnessPayTreatment::getNamespace());
        $willingnessPay->session()->associate($session);
        $willingnessPay->save();

        $ultimatum = $modelCollection->getModel(UltimatumTreatment::getNamespace());
        $ultimatum->session()->associate($session);
        $ultimatum->save();

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
