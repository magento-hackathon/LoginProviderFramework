<?php
class Hackathon_LoginProviderFramework_Model_Sandbox_TestProvider
    implements Hackathon_LoginProviderFramework_Interface_LoginProviderInterface
{
    public function authenticate($username, $password)
    {
        if($username == 'sandbox' && $password == 'test') {
            return true;
        }
        return false;
    }

    public function getRoleForUser($username) {
        return 'Administrators';
    }

}