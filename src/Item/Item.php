<?php
namespace MuOnline\Item;

use MuOnline\Item\Maker\MakerFactory;
use MuOnline\Item\Parser\ParserFactory;
use MuOnline\Item\Socket\Slot as SocketSlot;
use MuOnline\Item\Excellent\Slot as ExcellentSlot;
use MuOnline\Item\Mastery\Slot as MasterySlot;
use MuOnline\Item\File\Parser\Item\ParserFactory as FileParserFactory;
use MuOnline\Util\DirtyTrait;
use MuOnline\Item\File\FileNotFoundException;
use Psr\Cache\InvalidArgumentException;

class Item
{
    use DirtyTrait;

    private string $hex;
    private string $name;
    private int $width;
    private int $height;
    private ?int $section;
    private ?int $index;
    private int $level = 0;
    private int $option = 0;
    private Luck $luck;
    private Skill $skill;
    private Durability $durability;
    private Excellent $excellent;
    private Serial $serial;
    private Ancient $ancient;
    private Refine $refine;
    private Harmony $harmony;
    private Socket $socket;
    private Mastery $mastery;
    private Time $time;

    public function __construct(?int $section = null, ?int $index = null)
    {
        $this->section = $section;
        $this->index = $index;

        if ($section !== null || $index !== null) {
            $this->itsDirty();
        }

        $this->luck = (new Luck())->attachItem($this);
        $this->skill = (new Skill())->attachItem($this);
        $this->durability = (new Durability())->attachItem($this);
        $this->excellent = (new Excellent())->attachItem($this);
        $this->serial = (new Serial())->attachItem($this);
        $this->ancient = (new Ancient())->attachItem($this);
        $this->refine = (new Refine())->attachItem($this);
        $this->harmony = (new Harmony())->attachItem($this);
        $this->socket = (new Socket())->attachItem($this);
        $this->mastery = (new Mastery())->attachItem($this);
        $this->time = (new Time())->attachItem($this);
    }

    public function setHex(string $hex): self
    {
        $this->hex = $hex;

        return $this;
    }

    public function getHex(): ?string
    {
        return $this->hex;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setWidth(int $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getWidth(): string
    {
        return $this->width;
    }

    public function setHeight(int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getHeight(): string
    {
        return $this->height;
    }

    public function setSection(int $section): self
    {
        $this->addDirty($this->section, $section);
        $this->section = $section;

        return $this;
    }

    public function getSection(): ?int
    {
        return $this->section;
    }

    public function setIndex(int $index): self
    {
        $this->addDirty($this->index, $index);
        $this->index = $index;

        return $this;
    }

    public function getIndex(): ?int
    {
        return $this->index;
    }

    public function setLevel(int $level): self
    {
        $this->addDirty($this->level, $level);
        $this->level = $level;

        return $this;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function addLevel(int $levels = 1): self
    {
        $this->setLevel($this->level + $levels);

        return $this;
    }

    public function setOption(int $option): self
    {
        $this->addDirty($this->option, $option);
        $this->option = $option;

        return $this;
    }

    public function getOption(): int
    {
        return $this->option;
    }

    public function addOption(int $options = 4): self
    {
        $this->setOption($this->option + $options);

        return $this;
    }

    public function setLuck(Luck $luck): self
    {
        $this->addDirty($this->luck->has(), $luck->has());
        $this->luck = $luck->attachItem($this);

        return $this;
    }

    public function getLuck(): Luck
    {
        return $this->luck;
    }

    public function addLuck(): self
    {
        $this->addDirty($this->luck->has(), true);
        $this->getLuck()->add();

        return $this;
    }

    public function setSkill(Skill $skill): self
    {
        $this->addDirty($this->skill->has(), $skill->has());
        $this->skill = $skill->attachItem($this);

        return $this;
    }

    public function getSkill(): Skill
    {
        return $this->skill;
    }

    public function addSkill(): self
    {
        $this->addDirty($this->skill->has(), true);
        $this->getSkill()->add();

        return $this;
    }

    public function setDurability(Durability $durability): self
    {
        $this->addDirty($this->durability->get(), $durability->get());
        $this->durability = $durability->attachItem($this);

        return $this;
    }

    public function getDurability(): Durability
    {
        return $this->durability;
    }

    public function setAncient(Ancient $ancient): self
    {
        $this->addDirty($this->ancient->get(), $ancient->get());
        $this->ancient = $ancient->attachItem($this);

        return $this;
    }

    public function getAncient(): Ancient
    {
        return $this->ancient;
    }

    public function addAncient(int $tier, int $stamina = Ancient::STAMINA_5): self
    {
        $this->addDirty(
            [$this->ancient->getTier(), $this->ancient->getStamina()],
            [$tier, $stamina]
        );
        $this->getAncient()->add($tier, $stamina);

        return $this;
    }

    public function setSerial(Serial $serial): self
    {
        $this->addDirty($this->serial->get(), $serial->get());
        $this->serial = $serial->attachItem($this);

        return $this;
    }

    public function getSerial(): Serial
    {
        return $this->serial;
    }

    public function generateSerial(): self
    {
        $this->itsDirty();
        $this->getSerial()->generate();

        return $this;
    }

    public function setExcellent(Excellent $excellent): self
    {
        // TODO: dirty implementation
        $this->excellent = $excellent->attachItem($this);

        return $this;
    }

    public function getExcellent(): Excellent
    {
        return $this->excellent;
    }

    public function getExcellentSlot(int $index): ExcellentSlot
    {
        return $this->getExcellent()->getSlot($index);
    }

    public function addExcellentInSlot(int $index, $slot): self
    {
        $this->addDirty($this->excellent->getSlot($index)->has(), $slot instanceof ExcellentSlot ? $slot->has() : (bool)$slot);
        $this->getExcellent()->add($index, $slot);

        return $this;
    }

    public function setHarmony(Harmony $harmony): self
    {
        $this->addDirty(
            [$this->harmony->getType(), $this->harmony->getLevel()],
            [$harmony->getType(), $harmony->getLevel()]
        );
        $this->harmony = $harmony->attachItem($this);

        return $this;
    }

    public function getHarmony(): Harmony
    {
        return $this->harmony;
    }

    public function addHarmony(int $type = 0, int $level = 0): self
    {
        $this->addDirty(
            [$this->harmony->getType(), $this->harmony->getLevel()],
            [$type, $level]
        );
        $this->getHarmony()->add($type, $level);

        return $this;
    }

    public function setRefine(Refine $refine): self
    {
        $this->addDirty($this->refine->has(), $refine->has());
        $this->refine = $refine->attachItem($this);

        return $this;
    }

    public function getRefine(): Refine
    {
        return $this->refine;
    }

    public function addRefine(): self
    {
        $this->addDirty($this->refine->has(), true);
        $this->getRefine()->add();

        return $this;
    }

    public function setSocket(Socket $socket): self
    {
        // TODO: dirty implementation
        $this->socket = $socket->attachItem($this);

        return $this;
    }

    public function getSocket(): Socket
    {
        return $this->socket;
    }

    public function getSocketSlot(int $index): SocketSlot
    {
        return $this->getSocket()->getSlot($index);
    }

    public function addSocketInSlot(int $index, $slot): self
    {
        $this->addDirty($this->socket->getSlot($index)->get(), $slot instanceof SocketSlot ? $slot->get() : (int)$slot);
        $this->getSocket()->add($index, $slot);

        return $this;
    }

    public function setMastery(Mastery $mastery): self
    {
        // TODO: dirty implementation
        $this->mastery = $mastery->attachItem($this);

        return $this;
    }

    public function getMastery(): Mastery
    {
        return $this->mastery;
    }

    public function addMasteryInSlot(int $index, $slot): self
    {
        $this->addDirty($this->mastery->getSlot($index)->has(), $slot instanceof MasterySlot ? $slot->has() : (bool)$slot);
        $this->getMastery()->add($index, $slot);

        return $this;
    }

    public function getMasterySlot(int $index): MasterySlot
    {
        return $this->getMastery()->getSlot($index);
    }

    public function setTime(Time $time): self
    {
        $this->addDirty($this->time->get(), $time->get());
        $this->time = $time->attachItem($this);

        return $this;
    }

    public function getTime(): Time
    {
        return $this->time;
    }

    /**
     * @throws FileNotFoundException
     * @throws InvalidArgumentException
     */
    public function parse(string $hex = null, Parser $parser = null): self
    {
        if (! $hex) {
            $hex = $this->getHex();
        }

        if (! $parser) {
            $parser = ParserFactory::factory();
        }

        $parser->setHex($hex)
            ->parse($this);

        $this->sync();

        $this->itsNotDirty();

        return $this;
    }

    public function make(Maker $maker = null): string
    {
        if (! $maker) {
            $maker = MakerFactory::factory();
        }

        $this->setHex($maker->make($this));

        return $this->getHex();
    }

    /**
     * @throws FileNotFoundException
     * @throws InvalidArgumentException
     */
    public function sync(bool $durability = false): self
    {
        $parser = FileParserFactory::factory();

        $parser->sync($this, $durability);

        return $this;
    }

    public function is(int $section): bool
    {
        return $this->section === $section;
    }

    public function __toString()
    {
        return $this->name ?? '';
    }

}