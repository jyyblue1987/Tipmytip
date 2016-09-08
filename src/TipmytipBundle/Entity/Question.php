<?php

namespace TipmytipBundle\Entity;

/**
 * Question
 */
class Question
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
     * @var string
     */
    private $question_text;

    /**
     * @var string
     */
    private $question_date;

    /**
     * @var string
     */
    private $inquirer_delete;


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
     * @return Question
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
     * Set questionText
     *
     * @param string $questionText
     *
     * @return Question
     */
    public function setQuestionText($questionText)
    {
        $this->question_text = $questionText;

        return $this;
    }

    /**
     * Get questionText
     *
     * @return string
     */
    public function getQuestionText()
    {
        return $this->question_text;
    }

    /**
     * Set questionDate
     *
     * @param string $questionDate
     *
     * @return Question
     */
    public function setQuestionDate($questionDate)
    {
        $this->question_date = $questionDate;

        return $this;
    }

    /**
     * Get questionDate
     *
     * @return string
     */
    public function getQuestionDate()
    {
        return $this->question_date;
    }

    /**
     * Set inquirerDelete
     *
     * @param string $inquirerDelete
     *
     * @return Question
     */
    public function setInquirerDelete($inquirerDelete)
    {
        $this->inquirer_delete = $inquirerDelete;

        return $this;
    }

    /**
     * Get inquirerDelete
     *
     * @return string
     */
    public function getInquirerDelete()
    {
        return $this->inquirer_delete;
    }
    /**
     * @var \TipmytipBundle\Entity\Location
     */
    private $location;


    /**
     * Set location
     *
     * @param \TipmytipBundle\Entity\Location $location
     *
     * @return Question
     */
    public function setLocation(\TipmytipBundle\Entity\Location $location = null)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return \TipmytipBundle\Entity\Location
     */
    public function getLocation()
    {
        return $this->location;
    }
}
