<?php

namespace Gabriel\PcTest\Src;

interface LabelInterface {
    public function print(): string;
    public function getError(): array;
    public function getIdent(): string;
    public function getDataValue(string $key, string $default = 'n/a'): string;
    public function getData(): array;
}