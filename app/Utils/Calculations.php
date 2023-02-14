<?php

namespace NutriScore\Utils;

use NutriScore\Models\Person\BmrCalculationType;
use NutriScore\Models\Person\Gender;

trait Calculations {
    public function getBmi(int $weight): float {
        $heightInMeters = $this->height / 100;
        $divider = pow($heightInMeters, 2);
        return round($weight / $divider, 2);
    }

    public function getBmr(int $weight): int {
        $age = $this->getAge();
        return match ($this->bmrCalculationType) {
            BmrCalculationType::EASY => $this->getBmrEasy($weight),
            BmrCalculationType::COMPLICATED => $this->getBmrComplicated($weight, $age),
            BmrCalculationType::HARRIS_BENEDICT => $this->getBmrHarrisBenedict($weight, $age),
            BmrCalculationType::MIFFLIN_ST_JEOR => $this->getBmrMifflinStJeor($weight, $age)
        };
    }

    private function getBmrEasy(int $weight): int {
        return match ($this->gender) {
            Gender::FEMALE => 700 + 7 * $weight,
            Gender::MALE => 900 + 10 * $weight,
            Gender::OTHER => 0 // to be implemented in later version
        };
    }

    private function getBmrComplicated(int $weight, int $age): int {
        if ($this->gender === Gender::FEMALE) {
            if ($age >= 10 && $age <= 18) {
                return ($weight*0.056+2.898)*239;
            } else if ($age >= 19 && $age <= 30) {
                return ($weight*0.062+2.036)*239;
            } else if ($age >= 31 && $age <= 60) {
                return ($weight*0.034+3.538)*239;
            } else if ($age >= 61) {
                return ($weight*0.038+2.755)*239;
            }
        } else if ($this->gender === Gender::MALE) {
            if ($age >= 10 && $age <= 18) {
                return ($weight*0.074+2.754)*239;
            } else if ($age >= 19 && $age <= 30) {
                return ($weight*0.063+2.896)*239;
            } else if ($age >= 31 && $age <= 60) {
                return ($weight*0.048+3.653)*239;
            } else if ($age >= 61) {
                return ($weight*0.049+2.459)*239;
            }
        }
        return 0;
    }

    private function getBmrHarrisBenedict(int $weight, int $age): int {
        return match($this->gender) {
            Gender::FEMALE => 655.1+(9.563*$weight)+(1.85*$this->height)-(4.676*$age),
            Gender::MALE => 66.5+(13.75*$weight)+(5.003*$this->height)-(6.775*$age),
            Gender::OTHER => 0 // to be implemented in later version
        };
    }

    private function getBmrMifflinStJeor(int $weight, int $age): int {
        if ($this->gender == Gender::MALE) {
            $value = -5;
        } else if ($this->gender == Gender::FEMALE) {
            $value = 161;
        } else {
            $value = 0;
        }
        return ($this->height*6.25)+($weight*9.99)-($age*4.92)-($value);
    }

}