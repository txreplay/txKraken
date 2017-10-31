<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trade
 *
 * @ORM\Table(name="trade")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TradeRepository")
 */
class Trade
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
     * @ORM\Column(name="txid", type="string", length=255, unique=true)
     */
    private $txid;

    /**
     * @var string
     *
     * @ORM\Column(name="pair", type="string", length=255)
     */
    private $pair;

    /**
     * @var string
     *
     * @ORM\Column(name="curr_1", type="string", length=255)
     */
    private $curr1;

    /**
     * @var string
     *
     * @ORM\Column(name="curr_2", type="string", length=255)
     */
    private $curr2;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="datetime")
     */
    private $time;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="order_type", type="string", length=255)
     */
    private $orderType;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var float
     *
     * @ORM\Column(name="cost", type="float")
     */
    private $cost;

    /**
     * @var float
     *
     * @ORM\Column(name="fee", type="float")
     */
    private $fee;

    /**
     * @var float
     *
     * @ORM\Column(name="volume", type="float")
     */
    private $volume;


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
     * Set txid
     *
     * @param string $txid
     *
     * @return Trade
     */
    public function setTxid($txid)
    {
        $this->txid = $txid;

        return $this;
    }

    /**
     * Get txid
     *
     * @return string
     */
    public function getTxid()
    {
        return $this->txid;
    }

    /**
     * Set pair
     *
     * @param string $pair
     *
     * @return Trade
     */
    public function setPair($pair)
    {
        $this->pair = $pair;

        return $this;
    }

    /**
     * Get pair
     *
     * @return string
     */
    public function getPair()
    {
        return $this->pair;
    }

    /**
     * Set curr1
     *
     * @param string $curr1
     *
     * @return Trade
     */
    public function setCurr1($curr1)
    {
        $this->curr1 = $curr1;

        return $this;
    }

    /**
     * Get curr1
     *
     * @return string
     */
    public function getCurr1()
    {
        return $this->curr1;
    }

    /**
     * Set curr2
     *
     * @param string $curr2
     *
     * @return Trade
     */
    public function setCurr2($curr2)
    {
        $this->curr2 = $curr2;

        return $this;
    }

    /**
     * Get curr2
     *
     * @return string
     */
    public function getCurr2()
    {
        return $this->curr2;
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     *
     * @return Trade
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

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Trade
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set orderType
     *
     * @param string $orderType
     *
     * @return Trade
     */
    public function setOrderType($orderType)
    {
        $this->orderType = $orderType;

        return $this;
    }

    /**
     * Get orderType
     *
     * @return string
     */
    public function getOrderType()
    {
        return $this->orderType;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Trade
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set cost
     *
     * @param float $cost
     *
     * @return Trade
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return float
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set fee
     *
     * @param float $fee
     *
     * @return Trade
     */
    public function setFee($fee)
    {
        $this->fee = $fee;

        return $this;
    }

    /**
     * Get fee
     *
     * @return float
     */
    public function getFee()
    {
        return $this->fee;
    }

    /**
     * Set volume
     *
     * @param float $volume
     *
     * @return Trade
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;

        return $this;
    }

    /**
     * Get volume
     *
     * @return float
     */
    public function getVolume()
    {
        return $this->volume;
    }
}

