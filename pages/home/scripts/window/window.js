import * as MWListeners from './MWListeners.js';
import * as MWDraw from './MWDraw.js';
import createSlider from '../swipes/slider.js';

export function openWindow(event) {
    const target = event.target;

    const post = MWDraw.getPost(target);

    const modalWindow = MWDraw.getModalWindow(target);
    MWListeners.addMWCloseListener(modalWindow);
    MWDraw.insertPostToMW(post, modalWindow);
    
    addSlider(modalWindow, ' из ');

    MWDraw.showMW(modalWindow);
}

function addSlider(post) {
    const postContent = post.getElementsByClassName('post-picture');
    const postContentLen = postContent.length;
    if (postContentLen > 1) {
        createSlider(post, ' из ');
    }
}