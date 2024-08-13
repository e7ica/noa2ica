<?php

namespace App\Domain\Fields\Properties;

class MultipleChoiceControlFieldProperties extends ControlFieldProperties
{
    public bool $allowAttachments;
    public bool $allowMultipleSelection;
    public bool $allowOtherChoice;
    public bool $randomize;
    public bool $verticalAlignment;
    public array $choices;

    public function __construct(
        bool $allowAttachments,
        bool $allowMultipleSelection,
        bool $allowOtherChoice,
        bool $randomize,
        bool $verticalAlignment,
        array $choices,
        ?string $description = null
    ) {
        $this->allowAttachments = $allowAttachments;
        $this->allowMultipleSelection = $allowMultipleSelection;
        $this->allowOtherChoice = $allowOtherChoice;
        $this->randomize = $randomize;
        $this->verticalAlignment = $verticalAlignment;
        $this->choices = $choices;
        $this->description = $description;
    }
    public function toArray(): array {
        $array = parent::toArray();
        $array['allow_multiple_selection'] = $this->allowMultipleSelection;
        $array['allow_other_choice'] = $this->allowOtherChoice;
        $array['randomize'] = $this->randomize;
        $array['vertical_alignment'] = $this->verticalAlignment;
        $array['choices'] = array_map(function ($choice) {
            return $choice->toArray();
        }, $this->choices);
        return $array;
    }

    public function getChoices(): array {
        return $this->choices;
    }
}
