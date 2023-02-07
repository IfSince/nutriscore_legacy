<?php

namespace NutriScore\Models\PrivatePerson;

use NutriScore\Models\Model;
use NutriScore\Utils\ArrayUtil;
use NutriScore\Utils\EnumUtil;
use NutriScore\Utils\StringUtil;

class PrivatePerson extends Model {
    private ?int $userId;
    private string $firstName;
    private string $surname;
    private string $dateOfBirth;
    private int $height;
    private Gender $gender;
    private NutritionType $nutritionType;
    private BmrCalculationType $bmrCalculationType;
    private ActivityLevel $activityLevel;
    private Goal $goal;
    private bool $acceptedTos;

    public function __construct(
        ?int               $id = null,
        ?int               $userId = null,
        string             $firstName,
        string             $surname,
        string             $dateOfBirth,
        int                $height,
        Gender             $gender,
        NutritionType      $nutritionType,
        BmrCalculationType $bmrCalculationType,
        ActivityLevel      $activityLevel,
        Goal               $goal,
        bool               $acceptedTos = false
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->firstName = $firstName;
        $this->surname = $surname;
        $this->dateOfBirth = $dateOfBirth;
        $this->height = $height;
        $this->gender = $gender;
        $this->nutritionType = $nutritionType;
        $this->bmrCalculationType = $bmrCalculationType;
        $this->activityLevel = $activityLevel;
        $this->goal = $goal;
        $this->acceptedTos = $acceptedTos;
    }

    public static function from(array $data): ?PrivatePerson {
        if ($data) {
            $data = ArrayUtil::snakeCaseToCamelCaseKeys($data);

            return new self(
                $data['id'] ?? null,
                $data['userId'] ?? null,
                $data['firstName'],
                $data['surname'],
                $data['dateOfBirth'],
                $data['height'],
                EnumUtil::mapEnumValue(Gender::class, $data['gender']),
                EnumUtil::mapEnumValue(NutritionType::class, $data['nutritionType']),
                EnumUtil::mapEnumValue(BmrCalculationType::class, $data['bmrCalculationType']),
                EnumUtil::mapEnumValue(ActivityLevel::class, $data['activityLevel']),
                EnumUtil::mapEnumValue(Goal::class, $data['goal']),
                $data['acceptedTos'],
            );
        } else {
            return null;
        }
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getFirstName(): string {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getSurname(): string {
        return $this->surname;
    }

    /**
     * @param string $surname
     */
    public function setSurname(string $surname): void {
        $this->surname = $surname;
    }

    /**
     * @return string
     */
    public function getDateOfBirth(): string {
        return $this->dateOfBirth;
    }

    /**
     * @param string $dateOfBirth
     */
    public function setDateOfBirth(string $dateOfBirth): void {
        $this->dateOfBirth = $dateOfBirth;
    }

    /**
     * @return int
     */
    public function getHeight(): int {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight(int $height): void {
        $this->height = $height;
    }

    /**
     * @return Gender
     */
    public function getGender(): Gender {
        return $this->gender;
    }

    /**
     * @param Gender $gender
     */
    public function setGender(Gender $gender): void {
        $this->gender = $gender;
    }

    /**
     * @return NutritionType
     */
    public function getNutritionType(): NutritionType {
        return $this->nutritionType;
    }

    /**
     * @param NutritionType $nutritionType
     */
    public function setNutritionType(NutritionType $nutritionType): void {
        $this->nutritionType = $nutritionType;
    }

    /**
     * @return BmrCalculationType
     */
    public function getBmrCalculationType(): BmrCalculationType {
        return $this->bmrCalculationType;
    }

    /**
     * @param BmrCalculationType $bmrCalculationType
     */
    public function setBmrCalculationType(BmrCalculationType $bmrCalculationType): void {
        $this->bmrCalculationType = $bmrCalculationType;
    }

    /**
     * @return ActivityLevel
     */
    public function getActivityLevel(): ActivityLevel {
        return $this->activityLevel;
    }

    /**
     * @param ActivityLevel $activityLevel
     */
    public function setActivityLevel(ActivityLevel $activityLevel): void {
        $this->activityLevel = $activityLevel;
    }

    /**
     * @return Goal
     */
    public function getGoal(): Goal {
        return $this->goal;
    }

    /**
     * @param Goal $goal
     */
    public function setGoal(Goal $goal): void {
        $this->goal = $goal;
    }

    /**
     * @return bool
     */
    public function hasAcceptedTos(): bool {
        return $this->acceptedTos;
    }

    /**
     * @param bool $acceptedTos
     */
    public function setAcceptedTos(bool $acceptedTos): void {
        $this->acceptedTos = $acceptedTos;
    }

}