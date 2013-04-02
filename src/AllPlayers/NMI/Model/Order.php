<?php

namespace AllPlayers\NMI\Model;

use DateTime;

/**
 * Defines an order to be used by the NMI payment gateway.
 */
class Order
{
    /**
     * Description of the order.
     *
     * @var string
     */
    public $description;

    /**
     * Id of the order.
     *
     * @var string
     */
    public $id;

    /**
     * The date of the order.
     *
     * @var DateTime
     */
    protected $date;

    /**
     * Defaults the order date to the current date when a new order is
     * instantiated.
     */
    public function __construct()
    {
        $this->setDate(new DateTime());
    }

    /**
     * Sets the order date.
     *
     * @param DateTime $date
     *   The date of the order.
     */
    public function setDate(DateTime $date)
    {
        $this->date = $date;
    }

    /**
     * Converts the order to an array that can be used in a request.
     *
     * @return array
     *   Array of data that represents the order.
     */
    public function toArray()
    {
        $data = array(
            'orderdescription' => $this->description,
            'orderid' => $this->id,
        );

        // If a date was specified then add it to the data in the proper format.
        if (!empty($this->date)) {
            $data['order_date'] = $this->date->format('ymd');
        }

        return $data;
    }
}
