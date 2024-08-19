<?php

namespace App\DTO;

class Question
{

    public bool $isCompleted;

    /**
     * @param Option[] $options
     */
    public function __construct(
        public readonly int $id,
        public readonly string $ref,
        public readonly string $label,
        public readonly string $type,
        public readonly string $status,
        public readonly bool $canAttach,
        public readonly bool $canSelectOthers,
        public readonly bool $canEmplacement,
        public readonly bool $first,
        public readonly bool $last,
        public readonly string $group,
        public array $options,
        public Summon $summon,
        public string $comment,
        public string $attachment,
        public string $otherValue,
        public bool $otherCompliance
    ) {
        if($this->status != 'pendiente') {
            $this->isCompleted = true;
        } else {
            $this->isCompleted = false;
        }
    }

    public function toArray() {
        return [
            'id' => $this->id,
            'ref' => $this->ref,
            'label' => $this->label,
            'type' => $this->type,
            'status' => $this->status,
            'can_attach' => $this->canAttach,
            'can_select_others' => $this->canSelectOthers,
            'can_emplacement' => $this->canEmplacement,
            'first' => $this->first,
            'last' => $this->last,
            'group' => $this->group,
            'options' => array_map(fn($option) => $option->toArray(), $this->options),
            'summon' => $this->summon->toArray(),
            'comment' => $this->comment,
            'attachment' => $this->attachment,
            'other_value' => $this->otherValue,
            'other_compliance' => $this->otherCompliance,
            'is_completed' => $this->isCompleted
        ];
    }
}