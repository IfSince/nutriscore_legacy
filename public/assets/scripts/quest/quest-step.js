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
    }

    validate() {
        this.formFields.forEach(formField => formField.validate())
    }

    get isValid() {
        this.formFields.some(formField => !formField.isValid)
    }

    get isVisible() {
        return this.domContainer.getAttribute('data-quest-panel') === "true"
    }

    setVisible() {
        this.domContainer.setAttribute('data-quest-panel', "true")
    }

    setHidden() {
        this.domContainer.setAttribute('data-quest-panel', "false")
    }
}