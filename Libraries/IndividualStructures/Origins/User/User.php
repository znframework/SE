<?php namespace ZN\IndividualStructures;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class User extends \FactoryController
{
    const factory =
    [
        'methods' =>
        [
            'register'              => 'User\Register::do',
            'column'                => 'User\UserExtends::column:this',
            'autologin'             => 'User\Register::autoLogin:this',
            'returnlink'            => 'User\UserExtends::returnLink:this',
            'activationcomplete'    => 'User\Register::activationComplete',
            'resendactivationemail' => 'User\Register::resendActivationEmail',
            'update'                => 'User\Update::do',
            'oldpassword'           => 'User\Update::oldPassword:this',
            'newpassword'           => 'User\Update::newPassword:this',
            'passwordagain'         => 'User\Update::passwordAgain:this',
            'username'              => 'User\Login::username:this',
            'password'              => 'User\Login::password:this',
            'remember'              => 'User\Login::remember:this',
            'login'                 => 'User\Login::do',
            'islogin'               => 'User\Login::is',
            'logout'                => 'User\Logout::do',
            'forgotpassword'        => 'User\ForgotPassword::do',
            'verification'          => 'User\ForgotPassword::verification:this',
            'email'                 => 'User\ForgotPassword::email:this',
            'data'                  => 'User\Data::get',
            'activecount'           => 'User\Data::activeCount',
            'bannedcount'           => 'User\Data::bannedCount',
            'count'                 => 'User\Data::count',
            'error'                 => 'User\Information::error',
            'success'               => 'User\Information::success',
            'attachment'            => 'User\SendEmail::attachment:this',
            'sendemailall'          => 'User\SendEmail::send',
            'ipv4'                  => 'User\IP::v4',
            'ip'                    => 'User\IP::v4'
        ]
    ];
}
