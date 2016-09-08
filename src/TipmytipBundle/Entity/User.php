<?php

namespace TipmytipBundle\Entity;

/**
 * User
 */
class User
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $first_name;

    /**
     * @var string
     */
    private $last_name;

    /**
     * @var string
     */
    private $birthdate;

    /**
     * @var string
     */
    private $gender;

    /**
     * @var string
     */
    private $nationality;

    /**
     * @var string
     */
    private $country;

    /**
     * @var boolean
     */
    private $admin_account;

    /**
     * @var boolean
     */
    private $isActive;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $cashins;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $cashouts;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $languages;

    /**
     * @var \TipmytipBundle\Entity\location
     */
    private $location;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cashins = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cashouts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->languages = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set birthdate
     *
     * @param string $birthdate
     *
     * @return User
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return string
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return User
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set nationality
     *
     * @param string $nationality
     *
     * @return User
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * Get nationality
     *
     * @return string
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return User
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set adminAccount
     *
     * @param boolean $adminAccount
     *
     * @return User
     */
    public function setAdminAccount($adminAccount)
    {
        $this->admin_account = $adminAccount;

        return $this;
    }

    /**
     * Get adminAccount
     *
     * @return boolean
     */
    public function getAdminAccount()
    {
        return $this->admin_account;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Add cashin
     *
     * @param \TipmytipBundle\Entity\Cashin $cashin
     *
     * @return User
     */
    public function addCashin(\TipmytipBundle\Entity\Cashin $cashin)
    {
        $this->cashins[] = $cashin;

        return $this;
    }

    /**
     * Remove cashin
     *
     * @param \TipmytipBundle\Entity\Cashin $cashin
     */
    public function removeCashin(\TipmytipBundle\Entity\Cashin $cashin)
    {
        $this->cashins->removeElement($cashin);
    }

    /**
     * Get cashins
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCashins()
    {
        return $this->cashins;
    }

    /**
     * Add cashout
     *
     * @param \TipmytipBundle\Entity\Cashout $cashout
     *
     * @return User
     */
    public function addCashout(\TipmytipBundle\Entity\Cashout $cashout)
    {
        $this->cashouts[] = $cashout;

        return $this;
    }

    /**
     * Remove cashout
     *
     * @param \TipmytipBundle\Entity\Cashout $cashout
     */
    public function removeCashout(\TipmytipBundle\Entity\Cashout $cashout)
    {
        $this->cashouts->removeElement($cashout);
    }

    /**
     * Get cashouts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCashouts()
    {
        return $this->cashouts;
    }

    /**
     * Add language
     *
     * @param \TipmytipBundle\Entity\Userlanguage $language
     *
     * @return User
     */
    public function addLanguage(\TipmytipBundle\Entity\Userlanguage $language)
    {
        $this->languages[] = $language;

        return $this;
    }

    /**
     * Remove language
     *
     * @param \TipmytipBundle\Entity\Userlanguage $language
     */
    public function removeLanguage(\TipmytipBundle\Entity\Userlanguage $language)
    {
        $this->languages->removeElement($language);
    }

    /**
     * Get languages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * Set location
     *
     * @param \TipmytipBundle\Entity\location $location
     *
     * @return User
     */
    public function setLocation(\TipmytipBundle\Entity\location $location = null)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return \TipmytipBundle\Entity\location
     */
    public function getLocation()
    {
        return $this->location;
    }
}
