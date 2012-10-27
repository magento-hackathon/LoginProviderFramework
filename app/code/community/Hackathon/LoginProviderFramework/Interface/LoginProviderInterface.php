<?php
interface Hackathon_LoginProviderFramework_Interface_LoginProviderInterface {
    public function authenticate($username, $password);
    public function getRoleForUser($username);
}