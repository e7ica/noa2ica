<?php

namespace App\Domain\Fields\Properties;

class DropdownControlFieldProperties extends ControlFieldProperties
{
    public bool $alphabeticalOrder;
    public bool $randomize;
    public array $choices;

    public function __construct(
        bool $allowAttachments,
        bool $alphabeticalOrder,
        bool $randomize,
        array $choices,
        ?string $description = null
    ) {
        $this->allowAttachments = $allowAttachments;
        $this->alphabeticalOrder = $alphabeticalOrder;
        $this->randomize = $randomize;
        $this->choices = $choices;
        $this->description = $description;
    }


    public function toArray(): array {
        $array = parent::toArray();
        $array['alphabetical_order'] = $this->alphabeticalOrder;
        $array['randomize'] = $this->randomize;
        return $array;
    }

    public function getChoices(): array {
        return $this->choices;
    }
}