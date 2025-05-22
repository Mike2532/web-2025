import * as ModWindow from './../window/window.js';

export function pictureaddSWListeners(postContent) {
    for (let picture of postContent) {
        picture.addEventListener('click', (event) => ModWindow.openWindow(event));
    }
}