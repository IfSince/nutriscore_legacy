import {QuestStep} from '../quest/quest-step.js';

export class OtherQuestStep extends QuestStep {
    bmr;
    activityLevel;
    palLevel;
    objective;

    /**
     *
     * @param formFields {FormField[]}
     * @param domContainer {HTMLElement}
     * @param description {string}
     * @param isSubmitStep {boolean}
     */
    constructor(formFields, domContainer, description, isSubmitStep = false) {
        super(formFields, domContainer, description, isSubmitStep)

        this.parseFormFields(formFields)
        this.addActivityLevelEventListener(formFields)
    }

    addActivityLevelEventListener() {
        this.activityLevel.element.addEventListener('change', () => this.onValueChange())
        this.onValueChange()
    }

    onValueChange() {
        const value = this.activityLevel.value;

        if (value === 'palLevel') {
            this.palLevel.enable();
        } else {
            this.palLevel.value = null;
            this.palLevel.disable();
        }
    }
}