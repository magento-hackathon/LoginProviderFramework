<?php
class Hackathon_LoginProviderFramework_Model_Observer
{

    const CONFIG_PATH_LOGIN_PROVIDERS = 'hackathon/loginproviderframework/providers';

    public function controllerActionPredispatch($event)
    {
        $request = Mage::app()->getRequest();

        $providers = Mage::getStoreConfig(self::CONFIG_PATH_LOGIN_PROVIDERS);
        foreach ($providers as $provider) {
            /* @var $provider Hackathon_LoginProviderFramework_Interface_LoginProviderInterface */
            $provider = Mage::getModel($provider);
            if ($userInformations = $provider->authenticate($request)) {
                $this->userAuthenticated($userInformations);
            }
        }
    }


    protected function userAuthenticated(
        Hackathon_LoginProviderFramework_Interface_UserInformationInterface $userInformations
    ) {
        /* @var $session Mage_Admin_Model_Session */
        $session = Mage::getSingleton('admin/session');
        /* @var $user Mage_Admin_Model_User */
        $user = Mage::getModel('admin/user');
        $user->loadByUsername($userInformations->getUsername());
        if (!$user->getId()) {
            $user->setUsername($userInformations->getUsername());
            $user->setFirstname($userInformations->getFirstName());
            $user->setLastname($userInformations->getLastName());
            $user->setPassword($userInformations->getPassword());
            $user->setEmail($userInformations->getEmailAddress());
            $user->setIsActive(true);

            $role = Mage::getModel('admin/role')->load($userInformations->getRolename(), 'role_name');
            if (!$role->getId()) {
                Mage::throwException('Role not found.');
            }

            $user->save();

            $user->setRoleIds(array($role->getId()))
                ->setRoleUserId($user->getUserId())
                ->saveRelations();
        }

        // TODO copied from app/code/core/Mage/Admin/Model/User.php:339
        // any better idea?
        if ($user->getIsActive() != '1') {
            Mage::throwException(Mage::helper('adminhtml')->__('This account is inactive.'));
        }
        if (!$user->hasAssigned2Role($user->getId())) {
            Mage::throwException(Mage::helper('adminhtml')->__('Access denied.'));
        }

        $session->setIsFirstPageAfterLogin(true);
        $session->setUser($user);
        $session->setAcl(Mage::getResourceModel('admin/acl')->loadAcl());
    }
}