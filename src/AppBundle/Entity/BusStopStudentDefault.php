<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BusStopStudentDefault
 *
 * @ORM\Table(name="bus_stop_student_default")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BusStopStudentDefaultRepository")
 */
class BusStopStudentDefault
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\BusStop", inversedBy="students")
     * @ORM\JoinColumn(name="bus_stop_id", referencedColumnName="id")
     */
    private $busStop;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Student", inversedBy="bus_stops")
     * @ORM\JoinColumn(name="student_id", referencedColumnName="id")
     */
    private $student;

    /**
     * @return mixed
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * @param mixed $student
     */
    public function setStudent($student)
    {
        $this->student = $student;
    }

    /**
     * @return BusStop
     */
    public function getBusStop()
    {
        return $this->busStop;
    }

    /**
     * @param mixed $busStop
     */
    public function setBusStop($busStop)
    {
        $this->busStop = $busStop;
    }
    
    
}

