export function setCircleFillPercentage() {
    const circles = document.querySelectorAll('[data-percentage]')

    circles.forEach(circle => {
        const percentage = Math.min(parseFloat(circle.getAttribute('data-percentage')), 100)
        const radius = circle.getAttribute('r')

        const dasharrayLength = 2 * Math.PI * radius
        circle.style.strokeDasharray = `${percentage * dasharrayLength / 100} ${dasharrayLength}`;
    })
}