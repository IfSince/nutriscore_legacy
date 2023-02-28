import {formatDateDot, formatDateKebab} from './util/format-date.js';

const today = new Date()
let offsetWeeks = 0
let initial = true

export function addDateSelectorListeners(callback) {
    document.querySelectorAll('[name="dayOfWeek"]').forEach(element => {
        element.addEventListener('change', () => callback(getSelectedDate()))
    })

    document.querySelector('#prev').addEventListener('click', () => {
        offsetWeeks = offsetWeeks - 7
        callback(getSelectedDate())
    })

    document.querySelector('#next').addEventListener('click', () => {
        offsetWeeks = offsetWeeks + 7
        callback(getSelectedDate())
    })
}

export function getSelectedDate() {
    if (initial) {
        const initialIndex = today.getDay() -1
        const inputElements = document.querySelectorAll('input[name="dayOfWeek"]')
        inputElements[initialIndex].checked = true
        initial = false
    }

    const selectedDateIndex = parseInt(document.querySelector('input[name="dayOfWeek"]:checked').value)

    const week = new Date(today.getFullYear(), today.getMonth(), today.getDate() + offsetWeeks)

    const dayOfWeek = week.getDay()
    const mondayOfWeek = new Date(week)
    mondayOfWeek.setDate(week.getDate() - dayOfWeek + 1)

    const sundayOfWeek = new Date(week)
    sundayOfWeek.setDate(week.getDate() - dayOfWeek + 7)

    document.querySelector('#dateRange').innerHTML = `${formatDateDot(mondayOfWeek)} - ${formatDateDot(sundayOfWeek)}`;

    const currentDate = new Date(mondayOfWeek)
    currentDate.setDate(mondayOfWeek.getDate() + selectedDateIndex)

    return formatDateKebab(currentDate)
}