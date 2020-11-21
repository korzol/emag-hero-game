<?php
declare(strict_types=1);

namespace tests\Battle\Message;

use App\Battle\Message\MessageFactory;
use App\Battle\Participants\Attacker;
use App\Battle\Participants\Defender;
use Exception;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class MessageFactoryTest extends TestCase
{

    public function testCanBuildInitialMessage(): void
    {
        $attacker = $this->createMock(Attacker::class);
        $defender = $this->createMock(Defender::class);

        $messageFactory = new MessageFactory();
        $message = $messageFactory->build('initial', $attacker, $defender);

        $this->assertInstanceOf('App\Battle\Message\InitialMessage', $message);
    }

    public function testCanBuildMessage(): void
    {
        $attacker = $this->createMock(Attacker::class);
        $defender = $this->createMock(Defender::class);

        $messageFactory = new MessageFactory();
        $message = $messageFactory->build('statistic', $attacker, $defender);

        $this->assertInstanceOf('App\Battle\Message\Message', $message);
    }

    public function testCanBuildFinalMessage(): void
    {
        $attacker = $this->createMock(Attacker::class);
        $defender = $this->createMock(Defender::class);

        $messageFactory = new MessageFactory();
        $message = $messageFactory->build('final', $attacker, $defender, 1);

        $this->assertInstanceOf('App\Battle\Message\FinalMessage', $message);
    }

    public function testInvalidMessageTypeException(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $attacker = $this->createMock(Attacker::class);
        $defender = $this->createMock(Defender::class);

        $messageFactory = new MessageFactory();
        $message = $messageFactory->build('specialMessage', $attacker, $defender);
    }

    public function testTurnNumberMandatoryException(): void
    {
        $this->expectException(Exception::class);

        $attacker = $this->createMock(Attacker::class);
        $defender = $this->createMock(Defender::class);

        $messageFactory = new MessageFactory();
        $message = $messageFactory->build('final', $attacker, $defender);
    }
}
