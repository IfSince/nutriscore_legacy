import {QuestStep} from '../quest/quest-step.js';

const nutritionTypes = {
    NORMAL: { protein: 15, carbohydrates: 55, fat: 30 },
    KETOGENIC: { protein: 15, carbohydrates: 5, fat: 80 },
    LOW_CARB: { protein: 30, carbohydrates: 25, fat: 45 },
    LOW_FAT: { protein: 20, carbohydrates: 70, fat: 10 },
    HIGH_PROTEIN: { protein: 35, carbohydrates: 35, fat: 30 },
    HP_HF: { protein: 30, carbohydrates: 15, fat: 55 },
    DACH_REFERENCE: { protein: 10, carbohydrates: 60, fat: 30 },
    MANUALLY: { protein: null, carbohydrates: null, fat: null }
};

export class NutritionQuestStep extends QuestStep {
    nutritionType;
    protein;
    carbohydrates;
    fat;

    /**
     *
     * @param formFields {FormField[]}
     * @param domContainer {HTMLElement}
     * @param description {string}
     * @param isSubmitStep {boolean}
     */
    constructor(formFields, domContainer, description, isSubmitStep = false) {
        super(formFields, domContainer, description)

        this.parseFormFields(formFields)

        this.addNutritionTypeEventListener(formFields)
    }

    addNutritionTypeEventListener() {
        this.nutritionType.element.addEventListener('change', () => this.onValueChange())
        this.onValueChange()
    }

    onValueChange() {
        const value = this.nutritionType.value
        const nutritionType = nutritionTypes[value]

        //TODO dont null values when manually and not null (POST_REQUEST value)
        this.protein.value = nutritionType.protein
        this.fat.value = nutritionType.fat
        this.carbohydrates.value = nutritionType.carbohydrates

        if (value === 'MANUALLY') {
            this.protein.enable()
            this.carbohydrates.enable()
            this.fat.enable()
        } else {
            this.protein.disable()
            this.carbohydrates.disable()
            this.fat.disable()
        }
    }
}