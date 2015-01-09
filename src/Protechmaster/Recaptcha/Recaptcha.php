<?php
/**
 * Created by PhpStorm.
 * User: rrafia
 * Date: 1/9/2015
 * Time: 1:43 PM
 */

namespace Protechmaster\Recaptcha;

use Config;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpFoundation\Response;
//use Illuminate\Support\Facades\Validator;

class Recaptcha {

    protected $public_key;
    protected $private_key;
    protected $verifyURL;
    public $errorMessage;


    public function __construct()
    {
        $this->public_key = Config::get('recaptcha::public_key');
        $this->private_key = Config::get('recaptcha::private_key');
        $this->errorMessage = Config::get('recaptcha::error_message');
        $this->verifyURL = Config::get('recaptcha::verify_api_url');
    }

    public function recaptchaField($error = '')
    {
        if(!empty($error))
        {
            return '<div class="g-recaptcha" data-sitekey="'.$this->public_key.'"></div>'.\Session::get($error);
        }
        return '<div class="g-recaptcha" data-sitekey="'.$this->public_key.'"></div><br>';
    }

    public function validate()
    {
        $json = json_decode(file_get_contents($this->verifyURL.'?secret='.$this->private_key.'&response='.Input::get('g-recaptcha-response')),true);

        if($json["success"]==false)
        {
            throw new RecaptchaException($this->errorMessage);
        }

    }

}