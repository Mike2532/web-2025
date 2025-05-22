import * as SWListeners from './scripts/swipes/postData.js'
import * as ModWindow from './scripts/window/window.js'

const constants = {
    MIN_LEN: 1,
    FIRST_POST: 1,
    POST_COUNTER_SEPARATOR: '/'
}

document.addEventListener("DOMContentLoaded", () => {
    postsAddUI();
});

function postsAddUI() {
    const allPosts = document.getElementsByClassName('content--block');
    for(let post of allPosts) {
        const postContent = post.getElementsByClassName('post-picture');
        const postContentLen = postContent.length;
        if (postContentLen > constants.MIN_LEN) {
            post.querySelector('.media').innerHTML += getButtons();
            post.innerHTML += getCounter();
            SWListeners.addSWListeners(post);
            fillCountBox(post, postContentLen);
        }
        pictureaddSWListeners(postContent);
    } 
}

function fillCountBox(post, postContentLen) {
    const countBox = post.querySelector('.post-counter');
    countBox.innerText = constants.FIRST_POST + constants.POST_COUNTER_SEPARATOR + postContentLen;       
}

function pictureaddSWListeners(postContent) {
    for (let picture of postContent) {
        picture.addEventListener('click', (event) => ModWindow.openWindow(event));
    }
}

function getButtons() {
    return `
        <img class="left-arrow" src="/domtst/images/LeftSlide.svg">
        <img class="right-arrow" src="/domtst/images/RightSlide.svg">
    `
}

function getCounter() {
    return `
        <div class="post-counter">
        </div>
    `
}