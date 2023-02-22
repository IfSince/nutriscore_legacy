<?php

namespace NutriScore\Services;

use NutriScore\DataMappers\MacroDistributionMapper;
use NutriScore\Models\MacroDistribution\MacroDistribution;

class MacroDistributionService {

    public function __construct(
        private readonly MacroDistributionMapper $macroDistributionMapper
    ) { }

    public function findByUserId(int $userId): ?MacroDistribution {
        return $this->macroDistributionMapper->findByUserId($userId);
    }

    public function save(MacroDistribution $macroDistribution): void {
        $this->macroDistributionMapper->save($macroDistribution);
    }

    public function delete(MacroDistribution $macroDistribution): void {
        $this->macroDistributionMapper->delete($macroDistribution);
    }

}