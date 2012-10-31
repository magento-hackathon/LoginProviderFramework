<?php
class Hackathon_LoginProviderFramework_Model_SimpleUserInformation
    implements Hackathon_LoginProviderFramework_Interface_UserInformationInterface
{
    /**
     * @var string
     */
    protected $username;
    /**
     * @var string
     */
    protected $firstname;
    /**
     * @var string
     */
    protected $lastname;
    /**
     * @var string
     */
    protected $emailaddress;
    /**
     * @var string
     */
    protected $rolename;

    /**
     * @var boolean
     */
    protected $status;

    /**
     * @param $emailaddress
     *
     * @return Hackathon_LoginProviderFramework_Model_SimpleUserInformation
     */
    public function setEmailaddress($emailaddress)
    {
        $this->emailaddress = $emailaddress;
        return $this;
    }

    /**
     * @param $firstname
     *
     * @return Hackathon_LoginProviderFramework_Model_SimpleUserInformation
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @param $lastname
     *
     * @return Hackathon_LoginProviderFramework_Model_SimpleUserInformation
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @param $username
     *
     * @return Hackathon_LoginProviderFramework_Model_SimpleUserInformation
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmailaddress()
    {
        return $this->emailaddress;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return '';
    }

    /**
     * @param $rolename
     *
     * @return \Hackathon_LoginProviderFramework_Model_SimpleUserInformation
     */
    public function setRolename($rolename)
    {
        $this->rolename = $rolename;
        return $this;
    }

    /**
     * @return string
     */
    public function getRolename()
    {
        return $this->rolename;
    }

    /**
     * @return bool
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param $status
     *
     * @return Hackathon_LoginProviderFramework_Model_SimpleUserInformation
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }


}