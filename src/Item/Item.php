<?php
namespace MuOnline\Item;

use MuOnline\Item\Maker\MakerFactory;
use MuOnline\Item\Parser\ParserFactory;
use MuOnline\Item\Socket\Slot as SocketSlot;
use MuOnline\Item\Excellent\Slot as ExcellentSlot;
use MuOnline\Item\File\Parser\Item\ParserFactory as FileParserFactory;
use MuOnline\Util\DirtyTrait;

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

        $this->luck = (new Luck())->setItem($this);
        $this->skill = (new Skill())->setItem($this);
        $this->durability = (new Durability())->setItem($this);
        $this->excellent = (new Excellent())->setItem($this);
        $this->serial = (new Serial())->setItem($this);
        $this->ancient = (new Ancient())->setItem($this);
        $this->refine = (new Refine())->setItem($this);
        $this->harmony = (new Harmony())->setItem($this);
        $this->socket = (new Socket())->setItem($this);
        $this->mastery = (new Mastery())->setItem($this);
        $this->time = (new Time())->setItem($this);
    }

    public function setHex(string $hex): self
    {
        $this->hex = $hex;

        return $this;
    }

    public function hex(string $hex): self
    {
        return $this->setHex($hex);
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
    public function name(string $name): self
    {
        return $this->setName($name);
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

    public function width(int $width): self
    {
        return $this->setWidth($width);
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

    public function height(int $height): self
    {
        return $this->setHeight($height);
    }

    public function setSection(int $section): self
    {
        $this->addDirty($this->section, $section);
        $this->section = $section;

        return $this;
    }

    public function section(int $section): self
    {
        return $this->setSection($section);
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

    public function index(int $index): self
    {
        return $this->setIndex($index);
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

    public function level(int $level): self
    {
        return $this->setLevel($level);
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

    public function option(int $option): self
    {
        return $this->setOption($option);
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
        $this->luck = $luck->setItem($this);

        return $this;
    }

    public function getLuck(): Luck
    {
        if (! $this->luck) {
            $this->luck = (new Luck())->setItem($this);
        }

        return $this->luck;
    }

    public function addLuck(): self
    {
        $this->getLuck()->add();

        return $this;
    }

    public function setSkill(Skill $skill): self
    {
        $this->skill = $skill->setItem($this);

        return $this;
    }

    public function getSkill(): Skill
    {
        if (! $this->skill) {
            $this->skill = (new Skill())->setItem($this);
        }

        return $this->skill;
    }

    public function addSkill(): self
    {
        $this->getSkill()->add();

        return $this;
    }

    public function setDurability($durability): self
    {
        if (! $durability instanceof Durability) {
            $durability = new Durability($durability);
        }

        $this->durability = $durability->setItem($this);

        return $this;
    }

    public function durability($durability): self
    {
        return $this->setDurability($durability);
    }

    public function getDurability(): Durability
    {
        return $this->durability;
    }

    public function setAncient(Ancient $ancient): self
    {
        $this->ancient = $ancient->setItem($this);

        return $this;
    }

    public function ancient(Ancient $ancient): self
    {
        return $this->setAncient($ancient);
    }

    public function getAncient(): Ancient
    {
        if (! $this->ancient) {
            $this->ancient = (new Ancient())->setItem($this);
        }

        return $this->ancient;
    }

    public function addAncient(int $tier, int $stamina = Ancient::STAMINA_5): self
    {
        $this->getAncient()->add($tier, $stamina);

        return $this;
    }

    public function setSerial(Serial $serial): self
    {
        $this->serial = $serial->setItem($this);

        return $this;
    }

    public function serial(Serial $serial): self
    {
        return $this->setSerial($serial);
    }

    public function getSerial(): Serial
    {
        if (! $this->serial) {
            $this->serial = (new Serial())->setItem($this);
        }

        return $this->serial;
    }

    public function generateSerial(): self
    {
        $this->getSerial()->generate();

        return $this;
    }

    public function setExcellent(Excellent $excellent): self
    {
        $this->excellent = $excellent->setItem($this);

        return $this;
    }

    public function excellent(Excellent $excellent): self
    {
        return $this->setExcellent($excellent);
    }

    public function getExcellent(): Excellent
    {
        if (! $this->excellent) {
            $this->excellent = (new Excellent())->setItem($this);
        }

        return $this->excellent;
    }

    public function getExcellentSlot(int $index): ExcellentSlot
    {
        return $this->getExcellent()->getSlot($index);
    }

    public function addExcellentInSlot(int $index, $slot): self
    {
        if (! $slot instanceof ExcellentSlot) {
            $slot = new ExcellentSlot($slot);
        }

        $this->getExcellent()->add($index, $slot);

        return $this;
    }

    public function setHarmony(Harmony $harmony): self
    {
        $this->harmony = $harmony->setItem($this);

        return $this;
    }

    public function harmony(Harmony $harmony): self
    {
        return $this->setHarmony($harmony);
    }

    public function getHarmony(): Harmony
    {
        if (! $this->harmony) {
            $this->harmony = (new Harmony())->setItem($this);
        }

        return $this->harmony;
    }

    public function addHarmony(int $type = 0, int $level = 0): self
    {
        $this->getHarmony()->add($type, $level);

        return $this;
    }

    public function setRefine(Refine $refine): self
    {
        $this->refine = $refine;

        return $this;
    }

    public function refine(Refine $refine): self
    {
        return $this->setRefine($refine);
    }

    public function getRefine(): Refine
    {
        if (! $this->refine) {
            $this->refine = (new Refine())->setItem($this);
        }

        return $this->refine;
    }

    public function addRefine(): self
    {
        $this->getRefine()->add();

        return $this;
    }

    public function setSocket(Socket $socket): self
    {
        $this->socket = $socket->setItem($this);

        return $this;
    }

    public function socket(Socket $socket): self
    {
        return $this->setSocket($socket);
    }

    public function getSocket(): Socket
    {
        if (! $this->socket) {
            $this->socket = (new Socket())->setItem($this);
        }

        return $this->socket;
    }

    public function getSocketSlot(int $index): SocketSlot
    {
        return $this->getSocket()->getSlot($index);
    }

    public function addSocketInSlot(int $index, $slot): self
    {
        if (! $slot instanceof SocketSlot) {
            $slot = (new SocketSlot())->parse($slot);
        }

        $this->getSocket()->add($index, $slot);

        return $this;
    }

    public function setMastery(Mastery $mastery): self
    {
        $this->mastery = $mastery;

        return $this;
    }

    public function mastery(Mastery $mastery): self
    {
        return $this->setMastery($mastery);
    }

    public function getMastery(): Mastery
    {
        if (! $this->mastery) {
            $this->mastery = (new Mastery())->setItem($this);
        }

        return $this->mastery;
    }

    public function setTime(Time $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function time(Time $time): self
    {
        return $this->setTime($time);
    }

    public function getTime(): Time
    {
        if (! $this->time) {
            $this->time = (new Time())->setItem($this);
        }

        return $this->time;
    }

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

        $this->addDirty();

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