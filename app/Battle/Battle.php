<?php
declare(strict_types=1);

namespace App\Battle;

use App\Battle\Message\MessageFactory;
use App\Battle\Participants\Attacker;
use App\Battle\Participants\Defender;
use App\Output\OutputInterface;

final class Battle implements BattleInterface
{
    private Attacker $attacker;

    private Defender $defender;

    private OutputInterface $output;

    private bool $canContinue;

    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
        $this->canContinue = true;
    }

    private function setRoles(Disposition $disposition): void
    {
        $roles = $disposition->getPositions();

        $this->attacker = $roles['attacker'];
        $this->defender = $roles['defender'];
    }

    private function inverseRoles(Disposition $disposition): void
    {
        $roles = $disposition->inversePositions();

        $this->attacker = $roles['attacker'];
        $this->defender = $roles['defender'];
    }

    /**
     * @param Disposition $disposition
     */
    public function run(Disposition $disposition): void
    {

        $this->setRoles($disposition);

        $this->sendInitialMessage();

        for($i = 1; $i <= 20; ++$i) {
            $this->attack($i);

            if ($this->canContinue === false)
            {
                $this->sendFinalMessage($i);
                break;
            }

            $this->inverseRoles($disposition);
        }
    }

    private function attack(int $turnNumber): void
    {
        $this->strike();
        $this->sendMessage($turnNumber);

        if ($this->attacker->isRapidStrike() === true && $this->canContinue === true)
        {
            $this->attacker->setRapidStrikeFalse();
            $this->attack($turnNumber);
        }
    }

    private function strike(): void
    {
        $this->defender->setDamage($this->calculateDamage());

        $this->canContinue = $this->defender->calculateHealth();
    }

    private function calculateDamage(): int
    {
        $attackerStrength = $this->attacker->attack();
        $defenderDefence = $this->defender->defend();

        if ($this->defender->isLucky() === true )
        {
            return 0;
        }

        if ($this->defender->isMagicShield() === true)
        {
            return intval(($attackerStrength - $defenderDefence) / 2);
        }

        return $attackerStrength - $defenderDefence;
    }

    private function sendMessage(int $turnNumber): void
    {
        try {
            $messageFactory = new MessageFactory();
            $message = $messageFactory->build('statistic', $this->attacker, $this->defender, $turnNumber);
            $this->output->yield($message);
        } catch (\Throwable $e) {
            die($e->getMessage());
        }
    }

    private function sendInitialMessage(): void
    {
        try {
            $messageFactory = new MessageFactory();
            $message = $messageFactory->build('initial', $this->attacker, $this->defender);
            $this->output->yield($message);
        } catch (\Throwable $e) {
            die($e->getMessage());
        }
    }

    private function sendFinalMessage(int $turnNumber): void
    {
        try {
            $messageFactory = new MessageFactory();
            $message = $messageFactory->build('final', $this->attacker, $this->defender, $turnNumber);
            $this->output->yield($message);
        } catch (\Throwable $e) {
            die($e->getMessage());
        }
    }
}
