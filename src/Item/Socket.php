<?php
namespace MuOnline\Item;

use MuOnline\Item\File\Parser\Socket\ParserFactory;
use MuOnline\Item\Socket\Bonus;
use MuOnline\Item\Socket\Slot;
use MuOnline\Util\ItemValueTrait;
use MuOnline\Item\File\FileNotFoundException;
use Psr\Cache\InvalidArgumentException;

class Socket
{
    use ItemValueTrait;

    private array $slots = [];
    private Bonus $bonus;

    public function __construct()
    {
        $this->bonus = new Bonus();
    }

    public function add($position, $slot): self
    {
        if (! $slot instanceof Slot) {
            $slot = new Slot($slot);
        }

        $this->slots[$position] = $slot;

        return $this;
    }

    public function getSlot(int $index): Slot
    {
        $slot = $this->slots[$index] ?? null;
        if (! $slot) {
            $slot = new Slot(255);
            $this->add($index, $slot);
        }

        return $slot;
    }

    public function setBonus(Bonus $bonus): self
    {
        $this->bonus = $bonus;

        return $this;
    }

    public function getBonus(): Bonus
    {
        if (! $this->bonus) {
            $this->setBonus(new Bonus());
        }

        return $this->bonus;
    }

    /**
     * @throws FileNotFoundException
     * @throws InvalidArgumentException
     */
    public static function all(): array
    {
        $parser = ParserFactory::factory();

        return $parser->getSockets();
    }

    /**
     * @throws FileNotFoundException
     * @throws InvalidArgumentException
     */
    public function exists(): bool
    {
        $parser = ParserFactory::factory();

        return $parser->getItem($this->getItem()->getSection(), $this->getItem()->getIndex()) !== null;
    }

    /**
     * @throws FileNotFoundException
     * @throws InvalidArgumentException
     */
    public function available(): array
    {
        $data = [];

        if ($this->getItem()->getSection() <= 5) {
            $allow = [1, 3, 5];
        } else {
            $allow = [2, 4, 6];
        }

        foreach (static::all() as $socket) {
            if (in_array($socket['element'], $allow)) {
                $type = $socket['type'];
                $data[$type][] = $socket;
            }
        }

        return $data;
    }

    public function has(): bool
    {
        foreach ($this->slots as $slot) {
            if ($slot->has()) {
                return true;
            }
        }

        return false;
    }

}