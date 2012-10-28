<?php
class Hackathon_LoginProviderFramework_Model_Sandbox_TestProvider
    implements Hackathon_LoginProviderFramework_Interface_LoginProviderInterface
{
    public function authenticate($username, $password)
    {
        if ($username == 'sandbox' && $password == 'test') {
            /* @var $userInfos Hackathon_LoginProviderFramework_Model_SimpleUserInformation */
            $userInfos = Mage::getModel('hackathon_loginproviderframework/simpleUserInformation');
            $userInfos
                ->setFirstname('firstname')
                ->setLastname('lastname')
                ->setEmailaddress('address@example.com')
                ->setUsername('sandbox');
        }
        return null;
    }

    public function getRoleForUser($username)
    {
        return 'Administrators';
    }

}