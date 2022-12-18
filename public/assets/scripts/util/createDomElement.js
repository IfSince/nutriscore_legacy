/**
 * Creates and returns new DOM-Element with given definitions
 * @param type {string}
 * @param innerHTML {string | null}
 * @param classes {string[]?}
 * @param styles {Object?}
 * @param dataAttributes {Object?}
 * @returns {HTMLElement}
 */
export function createDomElement(
    type,
    innerHTML = null,
    classes = [],
    styles = {},
    dataAttributes = {},
) {
    const element = document.createElement(type);
    element.innerHTML = innerHTML;
    if (classes) element.classList.add(...classes);

    if (styles) {
        Object.keys(styles).forEach((key) => {
            element.style[key] = styles[key];
        });
    }

    if (dataAttributes) {
        Object.keys(dataAttributes).forEach((key) => {
            element.setAttribute(key, dataAttributes[key]);
        });
    }

    return element;
}