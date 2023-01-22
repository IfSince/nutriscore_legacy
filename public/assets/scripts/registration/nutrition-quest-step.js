import {QuestStep} from '../quest/quest-step.js';

const nutritionTypes = {
    normal: { protein: 15, carbohydrates: 55, fat: 30 },
    ketogenic: { protein: 15, carbohydrates: 5, fat: 80 },
    lowCarb: { protein: 30, carbohydrates: 25, fat: 45 },
    lowFat: { protein: 20, carbohydrates: 70, fat: 10 },
    highProtein: { protein: 35, carbohydrates: 35, fat: 30 },
    hpHf: { protein: 30, carbohydrates: 15, fat: 55 },
    dachReference: { protein: 10, carbohydrates: 60, fat: 30 },
    manually: { protein: null, carbohydrates: null, fat: null }
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

        this.init(formFields)
    }

    init(formFields) {
        this.parseFormFields(formFields)
        this.nutritionType.element.addEventListener('change', () => this.onValueChange())
        this.onValueChange()
    }
    /**
     *
     * @param formFields {FormField[]}
     */
    parseFormFields(formFields) {
        formFields.forEach((formField) => {
            eval(`this.${formField.name} = formField`)
        })
    }

    onValueChange() {
        const value = this.nutritionType.value
        const nutritionType = nutritionTypes[value]

        this.protein.value = nutritionType.protein
        this.fat.value = nutritionType.fat
        this.carbohydrates.value = nutritionType.carbohydrates

        if (value === 'manually') {
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