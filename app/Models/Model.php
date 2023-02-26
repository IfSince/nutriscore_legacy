<?php

namespace NutriScore\Models;

use JsonSerializable;
use NutriScore\Traits\JsonConvertable;
use NutriScore\Utils\ArrayUtil;

abstract class Model implements JsonSerializable {
    use JsonConvertable;

    private const NEW_ENTITY_ID = 0;

    protected ?int $id = self::NEW_ENTITY_ID;

    public function isNew(): bool {
        return $this->id === self::NEW_ENTITY_ID || $this->id === null;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    protected static function populate(mixed $obj, array $data): Model {
        ArrayUtil::snakeCaseToCamelCaseKeys($data);

        foreach (array_keys($data) as $key) {

            $method = ucfirst($key);
            $setter = "set$method";
            if (isset($data[$key]) && method_exists($obj, $setter)) {
                $obj->{$setter}($data[$key]);
            }
        }

        return $obj;
    }

    abstract public static function create(array $data = null): Model;

    abstract public static function update(Model $obj, array $data = null): void;
}