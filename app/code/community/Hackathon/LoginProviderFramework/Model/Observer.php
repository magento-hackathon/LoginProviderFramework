<?php
class Hackathon_LoginProviderFramework_Model_Observer
{

    const CONFIG_PATH_LOGIN_PROVIDERS = 'hackathon/loginproviderframework/providers';

    public function adminUserAuthenticateAfter($event)
    {
        if ($event->getResult()) {
            // user logged in, everything is fine
            return;
        }

        $username = $event->getUsername();
        $password = $event->getPassword();

        $providers = Mage::getStoreConfig(self::CONFIG_PATH_LOGIN_PROVIDERS);
        foreach ($providers as $provider) {
            /* @var $provider Hackathon_LoginProviderFramework_Interface_LoginProviderInterface */
            $provider = Mage::getModel($provider);
            if ($provider->authenticate($username, $password)) {
                $this->userAuthenticated($username, $role);
            }
        }
    }


    protected function userAuthenticated($username, $role)
    {
        /* @var $session Mage_Admin_Model_Session */
        $session = Mage::getSingleton('admin/session');
        /* @var $user Mage_Admin_Model_User */
        $user = Mage::getModel('admin/user');
        $user->loadByUsername($username);
        if (!$user->getId()) {
            $user->setUsername($username);
            $user->setPassword('');
            $user->setEmail('');
            $user->setIsActive(true);

            $user->save();
        }
        $session->setUser($user);
    }
}