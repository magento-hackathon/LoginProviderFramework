<?php
class Hackathon_LoginProviderFramework_Model_Observer
{

    const CONFIG_PATH_LOGIN_PROVIDERS = 'hackathon/loginproviderframework/providers';

    protected $request;

    public function adminhtmlControllerActionPredispatchStart($event)
    {
        $this->request = Mage::app()->getRequest();
        $postLogin = $this->request->getPost('login');

        if (!is_null($postLogin)) {
            $username = isset($postLogin['username']) ? $postLogin['username'] : '';
            $password = isset($postLogin['password']) ? $postLogin['password'] : '';
            $providers = Mage::getStoreConfig(self::CONFIG_PATH_LOGIN_PROVIDERS);
            foreach ($providers as $provider) {
                /* @var $provider Hackathon_LoginProviderFramework_Interface_LoginProviderInterface */
                $provider = Mage::getModel($provider);
                if ($provider->authenticate($username, $password)) {
                    $this->userAuthenticated($username, $provider->getRoleForUser($username));
                }
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
            $name = uniqid();
            $user->setUsername($username);
            $user->setFirstname($name);
            $user->setLastname($name);
            $user->setPassword('test');
            $user->setEmail($name . '@domain.invalid');
            $user->setIsActive(true);

            $role = Mage::getModel('admin/role')->load($role, 'role_name');
            if (!$role->getId()) {
                Mage::throwException('Role not found.');
            }

            $user->save();

            $user->setRoleIds(array($role->getId()))
                ->setRoleUserId($user->getUserId())
                ->saveRelations();

        }
        $session->renewSession();
        $session->setIsFirstPageAfterLogin(true);
        $session->setUser($user);
        $session->setAcl(Mage::getResourceModel('admin/acl')->loadAcl());

        if (Mage::getSingleton('adminhtml/url')->useSecretKey()) {
            Mage::getSingleton('adminhtml/url')->renewSecretUrls();
        }

    }
}