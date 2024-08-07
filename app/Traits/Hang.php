<?php

namespace App\Traits;

trait Hang
{
    private int $number;
    private int $digitNormal;

    public function setNumber(int $number): self
    {
        $this->number = $number;
        return $this;
    }

    public function setDigitNormal(int $digitNormal): self
    {
        $this->digitNormal = $digitNormal;
        return $this;
    }

    private function formatNumber(): string
    {
        $strNumber = (string) abs($this->number);
        $leftHalf = str_split(substr($strNumber, 0, strlen($strNumber) - $this->digitNormal));
        $rightHalf = str_split(substr($strNumber, -$this->digitNormal));

        if ($this->number < 0) {
            foreach ($leftHalf as &$el) {
                $el = $el == 0 ? $el : '<span class="bar-sub text-xs">' . $el . '</span>';
            }
            foreach ($rightHalf as &$el) {
                $el = $el == 0 ? $el : '<span class="bar">' . $el . '</span>';
            }
        }

        return '<sub>' . implode('', $leftHalf) . '</sub>' . implode('', $rightHalf);
    }
}
