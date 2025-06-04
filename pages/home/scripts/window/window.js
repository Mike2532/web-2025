import * as MWDraw from './MWDraw.js';
import createSlider from '../swipes/slider.js';

export function openWindow(event) {
    const target = event.target;

    const post = getPost(target);

    const modalWindow = getModalWindow(target);
    MWDraw.insertPostToMW(post, modalWindow);
    
    addMWCloseListener(modalWindow);
    addSlider(modalWindow, ' из ');
    
    MWDraw.showMW(modalWindow);
}

function addMWCloseListener(modalWindow) {
    const closeIcon = modalWindow.querySelector('.modal-window__close');
    closeIcon.addEventListener('click', (event) => closeListener(event), {once: true});
    document.addEventListener('keydown', keyHandler);
}

const keyHandler = (event) => {
    if (event.key === 'Escape') {
        //const closeIcon = document.querySelector('.modal-window__close');
        //closeIcon.dispatchEvent(new MouseEvent('click'));
        closeListener(event);
    }
};

function addSlider(post) {
    const postContent = post.getElementsByClassName('post-picture');
    const postContentLen = postContent.length;
    if (postContentLen > 1) {
        createSlider(post, ' из ');
    }
}

function closeListener(event) {
    document.removeEventListener('keydown', keyHandler);
    const target = event.target;
    const ModWindow = target.closest('.modal-window');
    ModWindow.classList.remove('visiable');
    ModWindow.innerHTML = modWindowReInit();
}

function getPost(target) {
    const posBlockClone = target.closest('.content-block').cloneNode(true);
    return posBlockClone;
}

function getModalWindow(target) {
    return target.closest('.all-posts').nextElementSibling;
}

function modWindowReInit() {
    return `
    <div class="modal-window__content">
        <img class="modal-window__close" src="/domtst/images/MWCloseButton.svg">
        <div class="content-block__media">
        </div>
    </div>
    `
}

export default openWindow;