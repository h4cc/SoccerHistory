<?php

namespace Sweepo\BettingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use Sweepo\UserBundle\User;

/**
 * Bet
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Sweepo\BettingBundle\Entity\BetRepository")
 */
class Bet
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
     * @ORM\ManyToOne(targetEntity="Sweepo\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Sweepo\BettingBundle\Entity\Team")
     * @ORM\JoinColumn(name="first_team", referencedColumnName="id")
     */
    private $first_team;

    /**
     * @ORM\ManyToOne(targetEntity="Sweepo\BettingBundle\Entity\Team")
     * @ORM\JoinColumn(name="second_team", referencedColumnName="id")
     */
    private $second_team;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     * @Assert\NotNull()
     * @Assert\NotBlank()
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="bet", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $bet;

    /**
     * @var float
     *
     * @ORM\Column(name="odds", type="float")
     * @Assert\NotBlank()
     */
    private $odds;

    /**
     * @var float
     *
     * @ORM\Column(name="stake_percent", type="float")
     * @Assert\NotBlank()
     */
    private $stake_percent;

    /**
     * @var float
     *
     * @ORM\Column(name="stake_euro", type="float")
     * @Assert\NotBlank()
     */
    private $stake_euro;

    /**
     * @var boolean
     *
     * @ORM\Column(name="result", type="boolean")
     * @Assert\NotNull()
     */
    private $result;

    /**
     * @var float
     *
     * @ORM\Column(name="gain_loss", type="float")
     */
    private $gain_loss;

    /**
     * @var float
     *
     * @ORM\Column(name="profit", type="float")
     */
    private $profit;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    public function __construct() {
        $this->date = new \Datetime();
    }

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
     * Set user
     *
     * @param string $user
     * @return Bet
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set first_team
     *
     * @param string $firstTeam
     * @return Bet
     */
    public function setFirstTeam($firstTeam)
    {
        $this->first_team = $firstTeam;

        return $this;
    }

    /**
     * Get first_team
     *
     * @return string
     */
    public function getFirstTeam()
    {
        return $this->first_team;
    }

    /**
     * Set second_team
     *
     * @param string $secondTeam
     * @return Bet
     */
    public function setSecondTeam($secondTeam)
    {
        $this->second_team = $secondTeam;

        return $this;
    }

    /**
     * Get second_team
     *
     * @return string
     */
    public function getSecondTeam()
    {
        return $this->second_team;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Bet
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
     * Set bet
     *
     * @param string $bet
     * @return Bet
     */
    public function setBet($bet)
    {
        $this->bet = $bet;

        return $this;
    }

    /**
     * Get bet
     *
     * @return string
     */
    public function getBet()
    {
        return $this->bet;
    }

    /**
     * Set odds
     *
     * @param float $odds
     * @return Bet
     */
    public function setOdds($odds)
    {
        $this->odds = $odds;

        return $this;
    }

    /**
     * Get odds
     *
     * @return float
     */
    public function getOdds()
    {
        return $this->odds;
    }

    /**
     * Set stake_percent
     *
     * @param integer $stakePercent
     * @return Bet
     */
    public function setStakePercent($stakePercent)
    {
        $this->stake_percent = $stakePercent;

        return $this;
    }

    /**
     * Get stake_percent
     *
     * @return integer
     */
    public function getStakePercent()
    {
        return $this->stake_percent;
    }

    /**
     * Set stake_euro
     *
     * @param float $stakeEuro
     * @return Bet
     */
    public function setStakeEuro($stakeEuro)
    {
        $this->stake_euro = $stakeEuro;

        return $this;
    }

    /**
     * Get stake_euro
     *
     * @return float
     */
    public function getStakeEuro()
    {
        return $this->stake_euro;
    }

    /**
     * Set result
     *
     * @param boolean $result
     * @return Bet
     */
    public function setResult($result)
    {
        $this->result = $result;

        return $this;
    }

    /**
     * Get result
     *
     * @return boolean
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set gain_loss
     *
     * @param float $gainLoss
     * @return Bet
     */
    public function setGainLoss($gainLoss)
    {
        $this->gain_loss = $gainLoss;

        return $this;
    }

    /**
     * Get gain_loss
     *
     * @return float
     */
    public function getGainLoss()
    {
        return $this->gain_loss;
    }

    /**
     * Set profit
     *
     * @param float $profit
     * @return Bet
     */
    public function setProfit($profit)
    {
        $this->profit = $profit;

        return $this;
    }

    /**
     * Get profit
     *
     * @return float
     */
    public function getProfit()
    {
        return $this->profit;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Bet
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
}
