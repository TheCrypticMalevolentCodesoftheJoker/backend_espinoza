<?php

namespace App\Modules\Catalog\Product\Application\DTOs\Read\Image;

use JsonSerializable;

class ImageDTO implements JsonSerializable
{
    public function __construct(
        public int $id,
        public string $url,
        public string $type,
    ) {}

    public function jsonSerialize(): mixed
    {
        return [
            'id'   => $this->id,
            'url'  => $this->url,
            'type' => $this->type,
        ];
    }
}
