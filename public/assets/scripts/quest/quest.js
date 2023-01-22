import {createDomElement} from "../util/createDomElement.js";

export class Quest {
    /**
     *
     * @param formId {string}
     * @param questSteps {QuestStep[]}
     */
    constructor(formId, questSteps ) {
        this.questSteps = questSteps
        this.form = document.querySelector(`#${formId}`)

        this.initQuestRoutingButtons();
        this.createStepButton();
    }

    createStepButton() {
        this.questSteps.forEach((step, index) => {
            const buttonElement = createDomElement(
                'button',
                step.isSubmitStep ? 'Register' : 'Next',
                ['btn', 'btn-primary', 'mt-12'],
                null,
                { type: step.isSubmitStep ? 'submit' : 'button' }
            )

            buttonElement.addEventListener('click', () => {
                step.validate()
                if (!step.isSubmitStep) {
                    this.toggleVisibleQuestStep(index + 1)
                }
            })

            step.domContainer.appendChild(buttonElement)
        });
    }

    initQuestRoutingButtons() {
        const btnContainer = document.querySelector('[data-quest-steps-routing]')
        this.routingButtons = this.questSteps.map((step, index) => {
            const dataAttributes = { 'data-quest-step-selected': index === 0, 'tabindex': 1 }

            const element = createDomElement('li', null, null, null, dataAttributes)
            element.appendChild(createDomElement('div', index+1))
            element.appendChild(createDomElement('span', step.description));
            element.addEventListener('click', () => this.toggleVisibleQuestStep(index))

            btnContainer.appendChild(element);
            return element;
        });
    }

    toggleVisibleQuestStep(index) {
        this.questSteps.forEach(step => step.setHidden())
        this.questSteps[index].setVisible()
        this.routingButtons.forEach(button => {
            button.setAttribute('data-quest-step-selected', 'false')
        })
        this.routingButtons[index].setAttribute('data-quest-step-selected', 'true')
    }

    validate() {
        this.questSteps.forEach(step => step.validate())
    }

    get isValid() {
        this.questSteps.some(step => !step.isValid)
    }
}