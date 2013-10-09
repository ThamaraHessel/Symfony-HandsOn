<?php

namespace Merci\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Address
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Address
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = "2",
     *      max = "255",
     *      minMessage = "Your street must be at least {{ limit }} characters length",
     *      maxMessage = "Your street cannot be longer than {{ limit }} characters length"
     * )
     */
    private $street;

    /**
     * @var integer
     *
     * @ORM\Column(name="number", type="integer")
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = "2",
     *      max = "255",
     *      minMessage = "Your number must be at least {{ limit }} characters length",
     *      maxMessage = "Your number cannot be longer than {{ limit }} characters length"
     * )
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="postal_code", type="string", length=20)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = "8",
     *      max = "20",
     *      minMessage = "Your postal code must be at least {{ limit }} characters length",
     *      maxMessage = "Your postal code cannot be longer than {{ limit }} characters length"
     * )
     */
    private $postal_code;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = "8",
     *      max = "20",
     *      minMessage = "Your city must be at least {{ limit }} characters length",
     *      maxMessage = "Your city cannot be longer than {{ limit }} characters length"
     * )
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = "2",
     *      max = "100",
     *      minMessage = "Your state must be at least {{ limit }} characters length",
     *      maxMessage = "Your state cannot be longer than {{ limit }} characters length"
     * )
     */
    private $state;


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
     * Set street
     *
     * @param string $street
     * @return Address
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set number
     *
     * @param integer $number
     * @return Address
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set postal_code
     *
     * @param string $postalCode
     * @return Address
     */
    public function setPostalCode($postalCode)
    {
        $this->postal_code = $postalCode;

        return $this;
    }

    /**
     * Get postal_code
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postal_code;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Address
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return Address
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }
}