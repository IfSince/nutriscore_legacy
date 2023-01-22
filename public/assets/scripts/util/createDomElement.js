/**
 * Creates and returns new DOM-Element with given definitions
 * @param type {string}
 * @param innerHTML {string | null}
 * @param classes {string[]?}
 * @param styles {Object?}
 * @param attributes {Object?}
 * @returns {HTMLElement}
 */
export function createDomElement(
    type,
    innerHTML = null,
    classes = [],
    styles = {},
    attributes = {},
) {
    const element = document.createElement(type);
    element.innerHTML = innerHTML;
    if (classes) element.classList.add(...classes);

    if (styles) {
        Object.keys(styles).forEach((key) => {
            element.style[key] = styles[key];
        });
    }

    if (attributes) {
        Object.keys(attributes).forEach((key) => {
            element.setAttribute(key, attributes[key]);
        });
    }

    return element;
}