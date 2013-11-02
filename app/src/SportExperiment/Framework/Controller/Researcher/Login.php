<?php namespace SportExperiment\Framework\Controller\Researcher;

use SportExperiment\Domain\Model\User;
use SportExperiment\Domain\Repository\ResearcherRepositoryInterface;
use SportExperiment\Framework\Controller\BaseController;

class Login extends BaseController
{
    private $researcherRepository;

    public function __construct(ResearcherRepositoryInterface $researcherRepository)
    {
        $this->researcherRepository = $researcherRepository;
    }

    public function getLogin() 
    {
        return \View::make('site.researcher.login');
    }

    public function postLogin()
    {
        $user = new User(\Input::all());

        // Validate raw user attributes
        if ($user->validationFails())
            return \Redirect::to('researcher/login')->withErrors($user->getValidator());

        // Confirm researcher account exists and is active
        if ( ! $this->researcherRepository->isResearcher($user))
            return \Redirect::to('researcher/login')->with('error', 'Account not found');

        // Attempt login using Auth
        if ( ! \Auth::attempt($user->getAuthInfo()))
            return \Redirect::to('researcher/login')->with('error', 'Unable to authorize');

        return \Redirect::to('researcher/dashboard');
    }

}
