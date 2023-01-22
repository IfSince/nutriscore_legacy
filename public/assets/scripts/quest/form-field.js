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
        this.name = id;
        this.element = document.querySelector(`#${id}`)
        this.element.addEventListener('focusout', this.validate)
    }

    validate() {
        // TODO add frontend validation
    }

    get isValid() {
        return this.errors.length > 0;
    }

    get value() {
        return this.element.value;
    }

    set value(value) {
        this.element.value = value;
    }

    disable() {
        this.element.disabled = true;
    }

    enable() {
        this.element.disabled = false;
    }
}