export function setCircleFillPercentage() {
    const circles = document.querySelectorAll('[data-percentage]')

    circles.forEach(circle => {
        const percentage = circle.getAttribute('data-percentage')
        const radius = circle.getAttribute('r')

        const dasharrayLength = 2 * Math.PI * radius
        circle.style.strokeDasharray = `${percentage * dasharrayLength / 100} ${dasharrayLength}`;
    })
}

function circleFillAnimation() {

}