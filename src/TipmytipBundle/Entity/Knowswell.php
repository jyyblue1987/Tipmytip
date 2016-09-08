<?php

namespace TipmytipBundle\Entity;

/**
 * Knowswell
 */
class Knowswell
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \TipmytipBundle\Entity\User
     */
    private $user;

    /**
     * @var \TipmytipBundle\Entity\Location
     */
    private $language;


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
     * Set user
     *
     * @param \TipmytipBundle\Entity\User $user
     *
     * @return Knowswell
     */
    public function setUser(\TipmytipBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \TipmytipBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set language
     *
     * @param \TipmytipBundle\Entity\Location $language
     *
     * @return Knowswell
     */
    public function setLanguage(\TipmytipBundle\Entity\Location $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \TipmytipBundle\Entity\Location
     */
    public function getLanguage()
    {
        return $this->language;
    }
}

