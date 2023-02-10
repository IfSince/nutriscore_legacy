export function addToastEventListeners() {
    const elements = document.querySelectorAll('[data-toast]')
    elements?.forEach(element => {
        const btn = element.querySelector('button')
        btn.addEventListener('click', () => closeToast(element))
    })
}

function closeToast(element) {
    element.remove();
}