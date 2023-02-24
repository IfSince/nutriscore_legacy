<?php

namespace NutriScore\Services;

use NutriScore\DataMappers\MacroDistributionMapper;
use NutriScore\Models\MacroDistribution\MacroDistribution;
use NutriScore\Validators\MacroDistributionValidator;
use NutriScore\Validators\ValidationObject;

class MacroDistributionService {

    public function __construct(
        private readonly MacroDistributionMapper    $macroDistributionMapper,
        private readonly MacroDistributionValidator $validator,
    ) { }

    public function findByUserId(int $userId): ?MacroDistribution {
        return $this->macroDistributionMapper->findByUserId($userId);
    }

    public function save(MacroDistribution $macroDistribution): ValidationObject {
        $this->validator->validate($macroDistribution);

        if ($this->validator->isValid()) {
            $this->macroDistributionMapper->save($macroDistribution);
        }
        return $this->validator->getValidationObject();
    }

    public function delete(MacroDistribution $macroDistribution): void {
        $this->macroDistributionMapper->delete($macroDistribution);
    }

}