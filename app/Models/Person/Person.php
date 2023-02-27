<?php

namespace NutriScore\Models\Person;

use NutriScore\Models\Model;
use NutriScore\Utils\EnumUtil;

class Person extends Model {
    private ?int $userId = null;
    private string $firstName;
    private string $surname;
    private string $dateOfBirth;
    private int $height;
    private Gender $gender = Gender::MALE;
    private NutritionType $nutritionType = NutritionType::NORMAL;
    private BmrCalculationType $bmrCalculationType = BmrCalculationType::EASY;
    private ?float $palLevel = null;
    private ActivityLevel $activityLevel = ActivityLevel::NO_SPORTS;
    private Goal $goal = Goal::KEEP;
    private bool $acceptedTos = false;

    public static function update(Model $obj, array $data = null): void {
        if ($data) {
            Person::populate($obj, $data);
        }
    }

    public static function create(array $data = null): Person {
        $obj = new Person();
        if ($data) {
            $obj = Person::populate($obj, $data);
        }
        return $obj;
    }

    public function getFullname(): string {
        return "$this->firstName $this->surname";
    }

    public function getFormattedDate(): string {
        $date = date_create($this->dateOfBirth);
        return date_format($date, 'd.m.Y');
    }

    public function getAge(): int {
        $today = date("Y-m-d");
        $diff = date_diff(date_create($this->dateOfBirth), date_create($today));
        return (int) $diff->format('%y');
    }

    public function getUserId(): ?int {
        return $this->userId;
    }

    public function setUserId(int $userId): void {
        $this->userId = $userId;
    }

    public function getFirstName(): string {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void {
        $this->firstName = $firstName;
    }

    public function getSurname(): string {
        return $this->surname;
    }

    public function setSurname(string $surname): void {
        $this->surname = $surname;
    }

    public function getDateOfBirth(): string {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(string $dateOfBirth): void {
        $this->dateOfBirth = $dateOfBirth;
    }

    public function getHeight(): int {
        return $this->height;
    }

    public function setHeight(int|string $height): void {
        $this->height = (int) $height;
    }

    public function getGender(): Gender {
        return $this->gender;
    }

    public function setGender(Gender|string $gender): void {
        $this->gender = EnumUtil::mapEnumValue(Gender::class, $gender);
    }

    public function getNutritionType(): NutritionType {
        return $this->nutritionType;
    }

    public function setNutritionType(NutritionType|string $nutritionType): void {
        $this->nutritionType = EnumUtil::mapEnumValue(NutritionType::class, $nutritionType);
    }

    public function getBmrCalculationType(): BmrCalculationType {
        return $this->bmrCalculationType;
    }

    public function setBmrCalculationType(BmrCalculationType|string $bmrCalculationType): void {
        $this->bmrCalculationType = EnumUtil::mapEnumValue(BmrCalculationType::class, $bmrCalculationType);
    }

    public function getPalLevel(): ?float {
        return $this->palLevel;
    }

    public function setPalLevel(float|string|null $palLevel): void {
        $this->palLevel = (empty($palLevel)) ? null : (float) $palLevel;
    }

    public function getActivityLevel(): ActivityLevel {
        return $this->activityLevel;
    }

    public function setActivityLevel(ActivityLevel|string $activityLevel): void {
        $this->activityLevel = EnumUtil::mapEnumValue(ActivityLevel::class, $activityLevel);
    }

    public function getGoal(): Goal {
        return $this->goal;
    }

    public function setGoal(Goal|string $goal): void {
        $this->goal = EnumUtil::mapEnumValue(Goal::class, $goal);
    }

    public function hasAcceptedTos(): bool {
        return $this->acceptedTos;
    }

    public function setAcceptedTos(bool $acceptedTos): void {
        $this->acceptedTos = $acceptedTos;
    }
}