<?php
// see Documentation folder for generated API doc for this class ...

/**
 * Class DvdRepository
 * class to store and serve Dvd objects (bit like a memory-only database ...)
 * @package Hdip
 */

namespace Hdip\Model;

/**
 * Class DvdRepository
 * class to store and serve Dvd objects (bit like a memory-only database ...)
 * @package Hdip\Model
 */
class DvdRepository
{
    /**
     * an associative array, containing Dvd objects
     * and indexed by the unique, primary key field 'isbn'
     * @var array
     */
    private $dvds;

    /**
     * create a new DvdRepository object
     * and intialise it with 3 dvds as defined below
     */
    function __construct()
    {
        $dvd1 = new Dvd(1);
        $dvd1->setTitle('Jaws');
        $dvd1->setImage('jaws.jpg');
        $dvd1->setPrice(10.0);
        $dvd1->setDiscount(0.5);
        $this->addDvd($dvd1);

        $dvd2 = new Dvd(2);
        $dvd2->setTitle('Rocky');
        $dvd2->setImage('rocky1.jpg');
        $dvd2->setPrice(5.0);
        $dvd2->setDiscount(0.2);
        $this->addDvd($dvd2);

        $dvd3 = new Dvd(3);
        $dvd3->setTitle('E.T.');
        $dvd3->setImage('et.jpg');
        $dvd3->setPrice(7.0);
        $dvd3->setDiscount(0.5);
        $this->addDvd($dvd3);

    }

    /**
     * add the given dvd to the repository
     *
     * NOTE: this is a PRIVATE method - just for use by the constructor
     * @param Dvd $dvd
     */
    private function addDvd(Dvd $dvd)
    {
        // get ID from dvd object
        $id = $dvd->getId();

        // add dvd object to array, with index of the ID
        $this->dvds[$id] = $dvd;

    }

    /**
     * return an array containing all dvds
     * @return array
     */
    public function getAllDvds()
    {
        return $this->dvds;
    }

    /**
     * attempt to retrieve and return dvd for given id = $id
     * @param int $id
     * @return Dvd (if found)
     * @return null (if not found)
     */
    public function getOneDvd($id)
    {
        if(array_key_exists($id, $this->dvds)){
            return $this->dvds[$id];
        } else {
            return null;
        }
    }

}