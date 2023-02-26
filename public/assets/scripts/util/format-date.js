/**
 *
 * @param date {Date}
 * @return {string}
 */
export function formatDateKebab(date) {
    let year = date.getFullYear();
    let month = date.getMonth() + 1;
    let day = date.getDate();

    if (month < 10) {
        month = '0' + month;
    }
    if (day < 10) {
        day = '0' + day;
    }

    return year + '-' + month + '-' + day;
}

/**
 *
 * @param date {Date}
 * @return {string}
 */
export function formatDateDot(date) {
    let year = date.getFullYear();
    let month = date.getMonth() + 1;
    let day = date.getDate();

    if (month < 10) {
        month = '0' + month;
    }
    if (day < 10) {
        day = '0' + day;
    }

    return day + '.' + month + '.' + year;
}
