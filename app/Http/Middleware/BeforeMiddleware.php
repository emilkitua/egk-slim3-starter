<?php

namespace App\Http\Middleware;

use Slim\Middleware;

class BeforeMiddleware extends Middleware
{
	public function call()
	{
		$this->app->hook('slim.before', [$this, 'run']);

		$this->next->call();
	}

	public function run()
	{
		if(isset($_SESSION[$this->app->config->get('auth.session')])){
			$this->app->auth = $this->app->user->where('ul_id', $_SESSION[$this->app->config->get('auth.session')])->first();
		}

		$this->checkRememberMe();

		$this->app->view()->appendData([
			'auth' => $this->app->auth
		]);
	}

	protected function checkRememberMe()
	{
		if($this->app->getCookie($this->app->config->get('auth.remember')) && !$this->app->auth){
			$data = $this->app->getCookie($this->app->config->get('auth.remember'));

			//extract the credentials
			$credentials = explode('___', $data);

			//check the credential has two elements in them
			if(empty(trim($data)) || count($credentials) !== 2){
				$this->app->response->redirect($this->app->urlFor('dashboard')); //redirect dashboard
			} else {
				$identifier = $credentials[0];
				$token = $this->app->hash->hash($credentials[1]);

				$user = $this->app->user
				->where('remember_identifier', $identifier)
				->first(); //checking if the identifier matches the remember identifier in the db
			
				if($user){
					if($this->app->hash->hashCheck($token, $user->remember_token)){
						//log the user in
						$_SESSION[$this->app->config->get('auth.session')] = $user->ul_id;
						$this->app->auth = $this->app->user->where('il_id', $user->ul_id)->first();
					} else {
						$user->removeRememberCredentials();
					}
				}
			}
		}
	}
}