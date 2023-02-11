export function addToastEventListeners() {
    const elements = document.querySelectorAll('[data-toast]')
    elements?.forEach(element => {
        const btn = element.querySelector('button')
        btn.addEventListener('click', () => closeToast(element))
    })
}

function closeToast(element) {
    element.remove();

    const parents = document.querySelectorAll('[data-toast-parent]');
    parents?.forEach(parent => {
       if (parent.childElementCount <= 0) {
           parent.classList.add("hidden");
       }
    });
}