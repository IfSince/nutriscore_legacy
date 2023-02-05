const upload = document.querySelector('#upload');
const profileImg = document.querySelector('[data-profile-img]');
const submitButton = document.querySelector('[data-submit]')

upload?.addEventListener('change', (e) => {
    const file = e.target.files[0];

    if (file) {
        const reader = new FileReader();

        reader.addEventListener('load', (e) => {
            profileImg.src = e.target.result;
        })
        reader.readAsDataURL(file);

        submitButton.classList.remove('hidden');
    }
});