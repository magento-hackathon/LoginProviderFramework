<?php
interface Hackathon_LoginProviderFramework_Interface_LoginProviderInterface {
    /**
     * @param Mage_Core_Controller_Request_Http $request
     *
     * @return Hackathon_LoginProviderFramework_Interface_UserInformationInterface
     */
    public function authenticate(Mage_Core_Controller_Request_Http $request);
}