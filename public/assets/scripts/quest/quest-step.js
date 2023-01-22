export class QuestStep {

    /**
     *
     * @param formFields {FormField[]}
     * @param domContainer {HTMLElement}
     * @param description {string}
     * @param isSubmitStep {boolean}
     */
    constructor(formFields, domContainer, description, isSubmitStep = false) {
        this.formFields = formFields;
        this.domContainer = domContainer;
        this.description = description;
        this.isSubmitStep = isSubmitStep
    }

    validate() {
        this.formFields.forEach(formField => formField.validate())
    }

    get isValid() {
        this.formFields.some(formField => !formField.isValid)
    }

    setVisible() {
        this.domContainer.setAttribute('data-quest-panel', "true")
    }

    setHidden() {
        this.domContainer.setAttribute('data-quest-panel', "false")
    }
}