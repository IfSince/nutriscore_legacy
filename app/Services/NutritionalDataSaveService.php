<?php

namespace NutriScore\Services;

use NutriScore\Models\MacroDistribution\MacroDistribution;
use NutriScore\Models\Person\Person;
use NutriScore\Validators\ValidationObject;

class NutritionalDataSaveService {
    public function __construct(
        private readonly PersonService $personService,
        private readonly MacroDistributionService $macroDistributionService,
    ) { }

    public function save(Person $person, MacroDistribution $macroDistribution): ValidationObject {
        $personValidation = $this->personService->save($person);

        if ($person->getNutritionType()->getMacroDistribution() === null) {
            $macroDistribution->setUserId($person->getUserId());
            $macroDistributionValidation = $this->macroDistributionService->save($macroDistribution);
        } else if (!$macroDistribution->isNew()) {
            $this->macroDistributionService->delete($macroDistribution);
            unset($macroDistribution);
        } else {
            unset($macroDistribution);
        }

        return new ValidationObject(
            errors: [
                ...$personValidation->getErrors(),
                ...isset($macroDistributionValidation) ? $macroDistributionValidation->getErrors() : [],
            ],
            warnings: [
                ...$personValidation->getWarnings(),
                ...isset($macroDistributionValidation) ? $macroDistributionValidation->getWarnings() : [],
            ],
            hints: [
                ...$personValidation->getHints(),
                ...isset($macroDistributionValidation) ? $macroDistributionValidation->getHints() : [],
            ],
            success: [
                ...$personValidation->getSuccess(),
                ...isset($macroDistributionValidation) ? $macroDistributionValidation->getSuccess() : [],
            ],
        );
    }

}