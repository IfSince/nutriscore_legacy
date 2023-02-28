<?php

namespace NutriScore\Services;

use NutriScore\DataMappers\FoodMapper;
use NutriScore\Models\Diary\DiaryRecordingType;
use NutriScore\Models\Food\Food;
use NutriScore\Models\Search\SearchResult;

final class DiarySearchService {
    private const DIARY_SEARCH_RESULT_FIELDS = ['description', 'calories', 'protein', 'carbohydrates', 'fat'];

    public function __construct(
        private readonly FoodMapper $foodMapper
    ) { }

    public function findAllByQuery(string $query): SearchResult {
        $searchResult = new SearchResult(
            fields: self::DIARY_SEARCH_RESULT_FIELDS,
            clickable: true,
        );

        if (strlen($query) > 0) {
            $searchResult->addRows(
                array_merge(
                    $this->getMappedFood($query)
                )
            );
        }
        return $searchResult;
    }

    public function findAllByQueryAndType(string $query, DiaryRecordingType $type = DiaryRecordingType::FOOD): SearchResult {
        $searchResult = new SearchResult(
            fields: self::DIARY_SEARCH_RESULT_FIELDS,
            clickable: true,
        );

        if (strlen($query) > 0) {
            $rows = match ($type) {
                DiaryRecordingType::FOOD => $this->getMappedFood($query)
            };
            $searchResult->addRows($rows);
        }
        return $searchResult;
    }

    private function getMappedFood(string $query): array {
        $food = $this->foodMapper->findAllByDescriptionLike($query);
        return array_map(function (Food $el) {
            $id = $el->getId();
            $type = strtolower(DiaryRecordingType::FOOD->value);
            return [
                'description' => $el->getDescription(),
                'calories' => $el->getCalories(),
                'protein' => $el->getProtein(),
                'carbohydrates' => $el->getCarbohydrates(),
                'fat' => $el->getFat(),
                'link' => "/diary/add/$type/$id"
            ];
        }, $food);
    }

}