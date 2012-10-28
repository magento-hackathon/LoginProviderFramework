<?php
interface Hackathon_LoginProviderFramework_Interface_UserInformationInterface {
    public function getUsername();
    public function getFirstName();
    public function getLastName();
    public function getEmailAddress();
    public function getPassword();
    public function getRolename();
}