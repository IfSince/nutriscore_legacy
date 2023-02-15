export function addDropdownEventListeners() {
    const dropdownButtons = document.querySelectorAll('[data-dropdown-button]')
    const dropdowns = document.querySelectorAll('[data-dropdown]')

    dropdownButtons?.forEach(btn => {
        const value = btn.getAttribute('data-dropdown-button');
        btn.addEventListener('click', () => {
            const relatedDropdown = [...dropdowns].filter(dropdown => dropdown.getAttribute('data-dropdown') === value)[0]
            toggleDropdownVisibility(relatedDropdown)
        })
    })
}

function toggleDropdownVisibility(dropdown) {
    dropdown.classList.toggle('hidden')
}