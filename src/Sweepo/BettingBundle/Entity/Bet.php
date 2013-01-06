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
    const PERCENT = 'percent';
    const EURO = 'euro';

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
     * @Assert\NotNull()
     */
    private $first_team;

    /**
     * @ORM\ManyToOne(targetEntity="Sweepo\BettingBundle\Entity\Team")
     * @ORM\JoinColumn(name="second_team", referencedColumnName="id")
     * @Assert\NotNull()
     */
    private $second_team;

    /**
     * @ORM\ManyToOne(targetEntity="Sweepo\BettingBundle\Entity\League")
     * @ORM\JoinColumn(name="league", referencedColumnName="id", nullable=true)
     * @Assert\NotNull()
     */
    private $league;

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
     * @Assert\NotNull()
     */
    private $bet;

    /**
     * @var float
     *
     * @ORM\Column(name="odds", type="float")
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $odds;

    /**
     * @var float
     *
     * @ORM\Column(name="stake", type="float", nullable=true)
     */
    private $stake;

    /**
     * @var string
     *
     * @ORM\Column(name="stake_type", type="string", nullable=true)
     */
    private $stake_type;

    /**
     * @var boolean
     *
     * @ORM\Column(name="result", type="boolean", nullable=true)
     */
    private $result;

    /**
     * @var float
     *
     * @ORM\Column(name="gain_loss", type="float", nullable=true)
     */
    private $gain_loss;

    /**
     * @var float
     *
     * @ORM\Column(name="profit", type="float", nullable=true)
     */
    private $profit;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    public function __construct() {

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
     * Set league
     *
     * @param string $league
     * @return League
     */
    public function setLeague($league)
    {
        $this->league = $league;

        return $this;
    }

    /**
     * Get league
     *
     * @return string
     */
    public function getLeague()
    {
        return $this->league;
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
     * Set stake
     *
     * @param float $stake
     * @return Bet
     */
    public function setStake($stake)
    {
        $this->stake = $stake;

        return $this;
    }

    /**
     * Get stake
     *
     * @return float
     */
    public function getStake()
    {
        return $this->stake;
    }

    /**
     * Set stake_type
     *
     * @param string $stakeType
     * @return Bet
     */
    public function setStakeType($stakeType)
    {
        $this->stake_type = $stakeType;

        return $this;
    }

    /**
     * Get stake_type
     *
     * @return string
     */
    public function getStakeType()
    {
        return $this->stake_type;
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
