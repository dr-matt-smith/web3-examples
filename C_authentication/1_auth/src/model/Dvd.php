<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 05/11/2015
 * Time: 22:00
 */

namespace Hdip\Model;

/**
 * Class to represent DVD objects
 * @package Hdip
 */
class Dvd
{
    /**
     * id of dvd (unique primary KEY)
     *
     * example:
     * <code>
     * 1
     * </code>
     * @var int
     */
    private $id;

    /**
     * title of dvd
     *
     * example:
     * <code>
     * Rocky 19
     * </code>
     *
     * @var string
     */
    private $title;

    /**
     * path to cover image
     *
     * example:
     * <code>
     * rocky19.jpg
     * </code>
     * @var string
     */
    private $image;

    /**
     * price
     *
     * example:
     * <code>
     * 10.00
     * </code>
     * @var float
     */
    private $price;

    /**
     * percentage sale discount (value between 0.0 and 1.0)
     *
     * example:
     * <code>
     * 0.5
     * </code>
     * @var float
     */
    private $discount;

    /**
     * create new dvd, with provided Id
     *
     * example usage:
     *
     * <code>
     * $dvd = new Dvd(1);
     * </code>
     * @param int $id
     */
    function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * get the Id
     *
     * example usage:
     *
     * <code>
     * $id = $dvd->getId();
     * </code>
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * get the title
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * get the image path
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * get the price
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * return the discount value
     *
     * @return float (value between 0.0 and 1.0)
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * return price AFTER discount has been applied
     *
     * example:
     *
     * ```
     * // if price 100 and discount 0.75 then get back 75.0
     * $priceToPay = $dvd->getPriceAfterDiscount();
     * ```
     *
     * @var int
     * @return float
     */
    public function getPriceAfterDiscount()
    {
        $discountAmount = $this->discount * $this->price;
        return $this->price - $discountAmount;
    }

    /**
     * set the dvd title
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * set the image path
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * set the price for the dvd
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * set the dicount percentrage
     * @param float $discount (value between 0.0 and 1.0)
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;
    }
}