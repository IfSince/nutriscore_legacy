import {createDomElement} from '../util/createDomElement.js';

export function updateRowData(container, recordings) {
    container.innerHTML = null
    const parent = container.parentElement
    if (parent.nextElementSibling?.innerHTML) {
        parent.nextElementSibling.remove()
    }
    if (recordings.length > 0) {
        recordings.forEach(recording => {

            const row = createDomElement('tr', null, ['rounded-lg', 'even:bg-gray-200'])

            const title = createDomElement(
                'th',
                recording.title,
                ['block', 'px-2', 'py-2', 'capitalize'],
                {},
                {scope: 'row'},
            )
            const amount = createDomElement('td', recording.amount);
            const calories = createDomElement('td', recording.calories);
            const protein = createDomElement('td', recording.protein);
            const carbohydrates = createDomElement('td', recording.carbohydrates);
            const fat = createDomElement('td', recording.fat);

            row.appendChild(title)
            row.appendChild(amount)
            row.appendChild(calories)
            row.appendChild(protein)
            row.appendChild(carbohydrates)
            row.appendChild(fat)

            container.appendChild(row)
        })
    } else {
        const notFoundElement = createDomElement(
            'span',
            'No entries have been found.',
            ['pt-6', 'block', 'text-center', 'text-sm', 'text-gray-500'],
        )
        container.parentElement.after(notFoundElement)
    }
}