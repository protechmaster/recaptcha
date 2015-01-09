<?php namespace Protechmaster\Recaptcha;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class RecaptchaServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{

//		$this->app->bind(
//			'Protechmaster\Recaptcha\RecaptchaInterface',
//			'Protechmaster\Recaptcha\Recaptchas'
//		);


		$this->app['Recaptcha'] = $this->app->share(function($app)
		{
			return new Recaptcha();
		});

		//register our facade
		$this->app->booting(function()
		{
			AliasLoader::getInstance()->alias('Recaptcha','Protechmaster\Recaptcha\Facades\RecaptchaFacade');
		});
	}

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('protechmaster/recaptcha');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
