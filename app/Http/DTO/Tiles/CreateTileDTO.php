<?php

namespace App\Http\DTO\Tiles;

use App\Http\DTO\DTO;

class CreateTileDTO extends DTO
{
    public string $image;
    public string $title;
    public int $width;
    public int $height;
    public bool $collision = false;
    public ?string $event;

}
