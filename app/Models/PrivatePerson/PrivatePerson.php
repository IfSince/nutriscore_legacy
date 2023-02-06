<?php

namespace NutriScore\Models\PrivatePerson;

use NutriScore\Models\Model;
use NutriScore\Models\User\User;

class PrivatePerson extends Model {
    private User $user;
    private string $firstName;
    private string $surname;
    private string $dateOfBirth;
    private int $height;
    private Gender $gender;
    private NutritionType $nutritionType;
    private BmrCalculationType $bmrCalculationType;
    private ActivityLevel $activityLevel;
    private Goal $goal;
    private string $acceptedTos;

    public function __construct(
        User                      $user,
        string                    $first_name,
        string                    $surname,
        string                    $date_of_birth,
        string                    $height,
        ?string                   $id = null,
        Gender|string             $gender = Gender::MALE,
        NutritionType|string      $nutrition_type = NutritionType::NORMAL,
        BmrCalculationType|string $bmr_calculation_type = BmrCalculationType::EASY,
        ActivityLevel|string      $activity_level = ActivityLevel::NO_SPORTS,
        Goal|string               $goal = Goal::KEEP,
        bool|string               $accepted_tos = false
    ) {
        $this->id = (int) $id;
        $this->user = $user;
        $this->firstName = $first_name;
        $this->surname = $surname;
        $this->dateOfBirth = $date_of_birth;
        $this->height = (int) $height;
        $this->gender = $this->mapEnumValue(Gender::class, $gender);
        $this->nutritionType = $this->mapEnumValue(NutritionType::class, $nutrition_type);
        $this->bmrCalculationType = $this->mapEnumValue(BmrCalculationType::class, $bmr_calculation_type);
        $this->activityLevel = $this->mapEnumValue(ActivityLevel::class, $activity_level);
        $this->goal = $this->mapEnumValue(Goal::class, $goal);
        $this->acceptedTos = $accepted_tos || $accepted_tos === '0';
    }

    /**
     * @return User
     */
    public function getUser(): User {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void {
        $this->user = $user;
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
     * @return string
     */
    public function getAcceptedTos(): string {
        return $this->acceptedTos;
    }

    /**
     * @param string $acceptedTos
     */
    public function setAcceptedTos(string $acceptedTos): void {
        $this->acceptedTos = $acceptedTos;
    }


}