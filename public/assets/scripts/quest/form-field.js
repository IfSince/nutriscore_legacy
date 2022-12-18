export class FormField {
    element;
    errors = [];

    /**
     *
     * @param id {string}
     * @param validationObject {string[]}
     */
    constructor(id, validationObject) {
        this.init(id)
        this.validationObject = validationObject;
    }

    init(id) {
        this.element = document.querySelector(`#${id}`)
        this.element.addEventListener('focusout', this.validate)
    }

    validate() {
        console.log('validate formField')
    }

    get isValid() {
        return this.errors.length > 0;
    }
}