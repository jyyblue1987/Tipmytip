<?php

namespace TipmytipBundle\Entity;

/**
 * Discussion
 */
class Discussion
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var boolean
     */
    private $inquirer_delete;

    /**
     * @var boolean
     */
    private $adviser_delete;


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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Discussion
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set inquirerDelete
     *
     * @param boolean $inquirerDelete
     *
     * @return Discussion
     */
    public function setInquirerDelete($inquirerDelete)
    {
        $this->inquirer_delete = $inquirerDelete;

        return $this;
    }

    /**
     * Get inquirerDelete
     *
     * @return boolean
     */
    public function getInquirerDelete()
    {
        return $this->inquirer_delete;
    }

    /**
     * Set adviserDelete
     *
     * @param boolean $adviserDelete
     *
     * @return Discussion
     */
    public function setAdviserDelete($adviserDelete)
    {
        $this->adviser_delete = $adviserDelete;

        return $this;
    }

    /**
     * Get adviserDelete
     *
     * @return boolean
     */
    public function getAdviserDelete()
    {
        return $this->adviser_delete;
    }
}
