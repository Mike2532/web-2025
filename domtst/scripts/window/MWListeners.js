export function addMWCloseListener(modalWindow) {
    const closeIcon = modalWindow.querySelector('.modal-window__close');
    closeIcon.addEventListener('click', (event) => closeListener(event));
    document.addEventListener('keydown', (event) => EventKeyValidate(event));
}

function EventKeyValidate(event) {
    if (event.key == 'Escape') {
        document.removeEventListener('keydown', (event) => EventKeyValidate(event));
        const closeIcon = document.querySelector('.modal-window__close');
        closeIcon.dispatchEvent(new MouseEvent('click'));
    }
}

function closeListener(event) {
    const target = event.target;
    const ModWindow = target.closest('.modal-window');
    ModWindow.classList.remove('visiable');
    ModWindow.innerHTML = MWReInit();
}

function MWReInit() {
    return `
    <div class="modal-window__content">
        <img class="modal-window__close" src="/domtst/images/MWCloseButton.svg">
        <div class="media">
        </div>
    </div>
    `
}