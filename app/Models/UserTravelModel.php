<?php
/* User Travel Object */
namespace App\Models;

class UserTravelModel {
    private $id;
    private $destination;
    private $departure;
    private $return;
    private $image;
    private $user_id;

    public function __construct($id, $destination, $departure, $return, $image, $user_id) {
        $this->id = $id;
        $this->destination = $destination;
        $this->departure = $departure;
        $this->return = $return;
        $this->image = $image;
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @return mixed
     */
    public function getDeparture()
    {
        return $this->departure;
    }

    /**
     * @return mixed
     */
    public function getReturn()
    {
        return $this->return;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return mixed
     */
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $destination
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
    }

    /**
     * @param mixed $departure
     */
    public function setDeparture($departure)
    {
        $this->departure = $departure;
    }

    /**
    * @param mixed $return
    */
    public function setReturn($return)
    {
        $this->return = $return;
    }

    /**
    * @param mixed $image
    */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
    * @param mixed $user_id
    */
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;
    }
}
