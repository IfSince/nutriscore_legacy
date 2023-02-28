<?php

namespace NutriScore\Services;

use NutriScore\DataMappers\MacroDistributionMapper;
use NutriScore\DataMappers\PersonMapper;
use NutriScore\Models\MacroDistribution\MacroDistribution;
use NutriScore\Models\Person\NutritionType;
use NutriScore\Models\Person\Person;
use NutriScore\Validators\NutritionalDataValidator;
use NutriScore\Validators\ValidationObject;

final class NutritionalDataSaveService {
    public function __construct(
        private readonly NutritionalDataValidator $validator,
        private readonly PersonMapper $personMapper,
        private readonly MacroDistributionMapper $macroDistributionMapper,
    ) { }

    public function save(Person $person, MacroDistribution $macroDistribution): ValidationObject {
        $data = [
            'person' => $person,
            'macroDistribution' => $macroDistribution,
        ];

        $this->validator->validate($data);

        if ($this->validator->isValid()) {
            $this->personMapper->save($person);
            $this->saveMacroDistribution($person->getNutritionType(), $person->getUserId(), $macroDistribution);
        }
        return $this->validator->getValidationObject();
    }

    private function saveMacroDistribution(NutritionType $nutritionType, int $userId, MacroDistribution $macroDistribution): void {
        if($nutritionType->getMacroDistribution() === null) {
            $macroDistribution->setUserId($userId);
            $this->macroDistributionMapper->save($macroDistribution);
        } else if (!$macroDistribution->isNew()) {
            $this->macroDistributionMapper->delete($macroDistribution);
        }
    }

}