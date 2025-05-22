import * as UIDrow from './UIDrow.js';
import * as UIListeners from './UIListeners.js';
import constants from './constants.js';
import createSlider from '../swipes/slider.js';

document.addEventListener("DOMContentLoaded", () => {
    postsAddUI();
});

function postsAddUI() {
    const allPosts = document.getElementsByClassName('content-block');
    for(let post of allPosts) {
        const postContent = post.getElementsByClassName('post-picture');
        const postContentLen = postContent.length;
        if (postContentLen > constants.MIN_LEN) {
            post.querySelector('.content-block__media').innerHTML += UIDrow.getButtons();
            post.innerHTML += UIDrow.getCounter();
            UIDrow.fillCountBox(post, postContentLen);
            createSlider(post, '/');
        }
        UIListeners.pictureaddSWListeners(postContent);
    } 
}