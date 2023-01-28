export function addQuickActionEventListener() {
    const actionsButton = document.querySelector('[data-action-button]')
    const actions = document.querySelector('[data-actions]')

    actionsButton?.addEventListener('click', () => {
        actions.classList.toggle('hidden')
        actionsButton.classList.toggle('rotate-[135deg]')
    })
}
