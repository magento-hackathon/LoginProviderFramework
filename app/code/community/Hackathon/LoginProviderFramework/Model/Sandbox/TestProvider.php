<?php
class Hackathon_LoginProviderFramework_Model_Sandbox_TestProvider
    implements Hackathon_LoginProviderFramework_Interface_LoginProviderInterface
{
    public function authenticate(Mage_Core_Controller_Request_Http $request)
    {
        $login = $request->getPost('login');
        $username = $login['username'];
        $password = $login['password'];
        if ($username == 'sandbox' && $password == 'test') {
            /* @var $userInfos Hackathon_LoginProviderFramework_Model_SimpleUserInformation */
            $userInfos = Mage::getModel('hackathon_loginproviderframework/simpleUserInformation');
            $userInfos
                ->setFirstname('firstname')
                ->setLastname('lastname')
                ->setEmailaddress('address@example.com')
                ->setUsername('sandbox')
                ->setRolename('Administrators')
                ->setStatus(1);

            return $userInfos;
        }
        return null;
    }

    public function getRoleForUser($username)
    {
        return 'Administrators';
    }

}