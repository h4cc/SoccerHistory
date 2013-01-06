<?php

namespace Sweepo\BettingBundle\Service;

use Sweepo\BettingBundle\Entity\Bet;

class Operations
{
    public function gainLoss(Bet $bet, $stock)
    {
        switch ($bet->getStakeType()) {
            case Bet::PERCENT:
                $stake = ($bet->getStake() * $stock) / 100;
                $result = $bet->getOdds() * $stake;
                if (true == $bet->getResult()) {
                    return $result;
                } elseif (false == $bet->getResult()) {
                    return -($result);
                }
            break;

            case Bet::EURO:
                $result = $bet->getOdds() * $bet->getStake();
                if (true == $bet->getResult()) {
                    return number_format($result, 2);
                } elseif (false == $bet->getResult()) {
                    return number_format(-($result), 2);
                }
            break;
        }
    }

    public function profit(Bet $bet, $stock)
    {
        if (Bet::PERCENT === $bet->getStakeType()) {
            $stake = ($bet->getStake() * $stock) / 100;
        } elseif (Bet::EURO === $bet->getStakeType()) {
            $stake = $bet->getStake();
        }

        if (true == $bet->getResult()) {
            return number_format(((($stake * $bet->getOdds()) - $stake) * 100) / $stock, 2);
        } elseif (false == $bet->getResult()) {
            return number_format(-(((($stake * $bet->getOdds()) - $stake) * 100) / $stock), 2);
        }
    }
}