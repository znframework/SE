<?php namespace ZN\IndividualStructures\User;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Services\URL;
use ZN\CryptoGraphy\Encode;
use ZN\IndividualStructures\IS;
use ZN\IndividualStructures\Lang;
use ZN\IndividualStructures\Import;

class ForgotPassword extends UserExtends
{
    //--------------------------------------------------------------------------------------------------------
    // Username
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $username
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function email(String $email) : ForgotPassword
    {
        Properties::$parameters['email'] = $email;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Verification -> 5.4.6
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $verification
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function verification(String $verification) : ForgotPassword
    {
        Properties::$parameters['verification'] = $verification;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Forgot Password
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $email
    // @param  string $returnLinkPath
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
    public function do(String $email = NULL, String $returnLinkPath = NULL) : Bool
    {
        $email            = Properties::$parameters['email']        ?? $email;
        $verification     = Properties::$parameters['verification'] ?? NULL;
        $returnLinkPath   = Properties::$parameters['returnLink']   ?? $returnLinkPath;

        Properties::$parameters = [];

        // ------------------------------------------------------------------------------
        // Settings
        // ------------------------------------------------------------------------------
        $tableName          = INDIVIDUALSTRUCTURES_USER_CONFIG['matching']['table'];
        $senderInfo         = INDIVIDUALSTRUCTURES_USER_CONFIG['emailSenderInfo'];
        $getColumns         = INDIVIDUALSTRUCTURES_USER_CONFIG['matching']['columns'];
        $usernameColumn     = $getColumns['username']     ?? NULL;
        $passwordColumn     = $getColumns['password']     ?? NULL;
        $emailColumn        = $getColumns['email']        ?? NULL;
        $verificationColumn = $getColumns['verification'] ?? NULL;
        // ------------------------------------------------------------------------------

        if( ! empty($emailColumn) )
        {
            \DB::where($emailColumn, $email);
        }
        else
        {
            \DB::where($usernameColumn, $email);
        }

        $row = \DB::get($tableName)->row();

        if( isset($row->$usernameColumn) )
        {
            if( ! empty($verificationColumn) )
            {
                if( $verification !== $row->$verificationColumn )
                {
                    return ! Properties::$error = Lang::select('IndividualStructures', 'user:verificationOrEmailError');
                }
            }
            
            if( ! IS::url($returnLinkPath) )
            {
                $returnLinkPath = URL::site($returnLinkPath);
            }

            $encodeType     = INDIVIDUALSTRUCTURES_USER_CONFIG['encode'];
            $newPassword    = Encode\RandomPassword::create(10);
            $encodePassword = ! empty($encodeType) ? Encode\Type::create($newPassword, $encodeType) : $newPassword;

            $templateData = array
            (
                'usernameColumn' => $row->$usernameColumn,
                'newPassword'    => $newPassword,
                'returnLinkPath' => $returnLinkPath
            );

            $message = Import\Template::use('UserEmail/ForgotPassword', $templateData, true);

            \Email::sender($senderInfo['mail'], $senderInfo['name'])
                 ->receiver($email, $email)
                 ->subject(Lang::select('IndividualStructures', 'user:newYourPassword'))
                 ->content($message);

            if( \Email::send() )
            {
                if( ! empty($emailColumn) )
                {
                    \DB::where($emailColumn, $email, 'and');
                }
                else
                {
                    \DB::where($usernameColumn, $email, 'and');
                }

                if( \DB::update($tableName, [$passwordColumn => $encodePassword]) )
                {
                    return Properties::$success = Lang::select('IndividualStructures', 'user:forgotPasswordSuccess');
                }

                return ! Properties::$error = Lang::select('Database', 'updateError');
            }
            else
            {
                return ! Properties::$error = Lang::select('IndividualStructures', 'user:emailError');
            }
        }
        else
        {
            return ! Properties::$error = Lang::select('IndividualStructures', 'user:forgotPasswordError');
        }
    }
}
