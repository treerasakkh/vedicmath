<?php
namespace App\Traits;

trait EasyArray
{
    private array $array = [];

    public function make(mixed $value): self
    {
        if (gettype($value) == 'string') {
            $this->array = str_split($value);
        }

        if (gettype($value) == 'array') {
            $this->array = $value;
        }

        if(gettype($value) == 'integer'){
            $this->array = str_split((string)$value);
        }

        return $this;
    }

    public function padLeft(int $length, mixed $value): self
    {
        $this->array = array_pad($this->array, -$length, $value);
        return $this;
    }

    public function padRight(int $length, mixed $value): self
    {
        $this->array = array_pad($this->array, $length, $value);
        return $this;
    }

    public function numberAll(): self
    {
        for ($i = 0; $i < count($this->array); $i++) {
            $this->array[$i] = is_numeric($this->array[$i]) ? (int)$this->array[$i] : $this->array[$i];
        }

        return $this;
    }

    public function clearFrontZero(string $replacement = ''): self
    {
        $count = count($this->array);

        for ($i = 0; $i < $count; $i++) {
            if ($this->array[$i] == 0) {
                $this->array[$i] = $replacement;
            } else {
                break;
            }
        }

        return $this;
    }

    public function clearTailZero(string $replacement = ''): self
    {
        $count = count($this->array);

        for ($i = $count - 1; $i > -1; $i--) {
            if ($this->array[$i] == 0) {
                $this->array[$i] = $replacement;
            } else {
                break;
            }
        }
        return $this;
    }

    public function get(): array
    {
        return $this->array;
    }
}
