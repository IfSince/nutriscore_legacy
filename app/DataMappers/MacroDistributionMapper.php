<?php

namespace NutriScore\DataMappers;

use NutriScore\Database;
use NutriScore\DataMapper;
use NutriScore\Models\MacroDistribution\MacroDistribution;

class MacroDistributionMapper extends DataMapper {
    private const RELATED_TABLE = 'macro_distributions';

    public function __construct(
        protected Database $database
    ) {
        parent::__construct(self::RELATED_TABLE, $database);
    }

    public function findByUserId(int $userId): ?MacroDistribution {
        $sql = 'SELECT * FROM macro_distributions md WHERE md.user_id = :userId';
        $params = ['userId' => $userId];

        return $this->load($sql, $params);
    }

    protected function _create(array $data = null): MacroDistribution {
        return MacroDistribution::create($data);
    }

    protected function _insert(mixed $obj): void {
        $sql = 'INSERT INTO macro_distributions (user_id, protein, carbohydrates, fat)
                    VALUES (:userId, :protein, :carbohydrates, :fat)';
        $params = [
            'userId' => $obj->getUserId(),
            'protein' => $obj->getProtein(),
            'carbohydrates' => $obj->getCarbohydrates(),
            'fat' => $obj->getFat(),
        ];

        $this->database->prepareAndExecute($sql, $params);
        $obj->setId($this->database->lastInsertId());
    }

    protected function _update(mixed $obj): void {
        $sql = 'UPDATE macro_distributions md
                   SET md.user_id = :userId,
                       md.protein = :protein,
                       md.carbohydrates = :carbohydrates,
                       md.fat = :fat
                 WHERE md.id = :id';
        $params = [
            'userId' => $obj->getUserId(),
            'protein' => $obj->getProtein(),
            'carbohydrates' => $obj->getCarbohydrates(),
            'fat' => $obj->getFat(),
            'id' => $obj->getId(),
        ];

        $this->database->prepareAndExecute($sql, $params);
    }

}