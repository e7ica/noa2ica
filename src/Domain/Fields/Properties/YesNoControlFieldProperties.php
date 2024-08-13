<?php

namespace App\Domain\Fields\Properties;

class YesNoControlFieldProperties extends ControlFieldProperties
{

    public function __construct(
        bool $allowAttachments,
        ?string $description = null
    ) {
        $this->allowAttachments = $allowAttachments;
        $this->description = $description;
    }

}
