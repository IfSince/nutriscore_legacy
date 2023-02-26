import {formatDateDot} from './util/format-date.js';

const dateRangeElement = document.querySelector('#dateRange')
const today = new Date()

export function addDateSelectorListeners(callback) {
    document.querySelectorAll('[name="dayOfWeek"]').forEach(element => {
        element.addEventListener('change', () => {
            const { from, to } = getSelectedDateRange()
            return callback(from, to);
        })
    })
}

export function getSelectedDateRange() {
    const selectedRange = document.querySelector('input[name="dayOfWeek"]:checked').value

    if (selectedRange === 'week') {
        const week = new Date(today.getFullYear(), today.getMonth(), today.getDate())
        const dayOfWeek = week.getDay()

        const mondayOfWeek = new Date(week)
        mondayOfWeek.setDate(week.getDate() - dayOfWeek + 1)

        const sundayOfWeek = new Date(week)
        sundayOfWeek.setDate(week.getDate() - dayOfWeek + 7)

        dateRangeElement.innerHTML = `${formatDateDot(mondayOfWeek)} - ${formatDateDot(sundayOfWeek)}`;
        return { from: mondayOfWeek, to: sundayOfWeek }
    } else if (selectedRange === 'month') {
        const m = today.getMonth();
        const y = today.getFullYear();

        const firstDayOfMonth = new Date(y, m, 1)
        const lastDayOfMonth = new Date(y, m + 1, 0)

        dateRangeElement.innerHTML = `${formatDateDot(firstDayOfMonth)} - ${formatDateDot(lastDayOfMonth)}`;
        return { from: firstDayOfMonth, to: lastDayOfMonth }
    } else if (selectedRange === 'year') {
        const firstDayOfYear = new Date(new Date().getFullYear(), 0, 1);
        const lastDayOfYear = new Date(new Date().getFullYear(), 11, 31);

        dateRangeElement.innerHTML = `${formatDateDot(firstDayOfYear)} - ${formatDateDot(lastDayOfYear)}`;
        return { from: firstDayOfYear, to: lastDayOfYear }
    } else if (selectedRange === 'all') {

        dateRangeElement.innerHTML = null;
        return { from: null, to: null }
    }
}