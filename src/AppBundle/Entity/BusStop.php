<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BusStop
 *
 * @ORM\Table(name="bus_stop")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BusStopRepository")
 */
class BusStop
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="time")
     */
    private $time;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\BusJourney", inversedBy="journey")
     * @ORM\JoinColumn(name="bus_journey_id", referencedColumnName="id")
     */
    private $busJourney;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return BusJourney
     */
    public function getBusJourney()
    {
        return $this->busJourney;
    }

    /**
     * @param mixed $busJourney
     */
    public function setBusJourney($busJourney)
    {
        $this->busJourney = $busJourney;
    }

    
    /**
     * Set name
     *
     * @param string $name
     *
     * @return BusStop
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     *
     * @return BusStop
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    public function __toString()
    {
        return $this->getName();
    }
    
    
}

