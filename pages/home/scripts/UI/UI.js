import openWindow from '../window/window.js';
import createSlider from '../swipes/slider.js';
import constants from './constants.js';

document.addEventListener("DOMContentLoaded", () => {
    postsAddUI();
});

function postsAddUI() {
    const allPosts = document.getElementsByClassName('content-block');
    for(let post of allPosts) {
        const postContent = post.getElementsByClassName('post-picture');
        const postContentLen = postContent.length;
        if (postContentLen > constants.MIN_LEN) {
            createSlider(post, '/');
        }
        addMWListeners(postContent);
        checkDescriptionSize(post);
    } 
}

function addMWListeners(postContent) {
    for (let picture of postContent) {
        picture.addEventListener('click', (event) => openWindow(event));
    }
}

function checkDescriptionSize(post) {
    post = post.closest('.post');
    const txt = post.querySelector('.post__description');
    const maxHeight = parseFloat(getComputedStyle(txt).lineHeight) * 2;
    const originalTxt = txt.innerText;
    if (txt.scrollHeight > maxHeight) {
        showSmallText(txt, maxHeight, originalTxt);
        insertMoreSwitch(post);
        addMoreSwitchInterruct(post, txt, maxHeight, originalTxt)
    }
}

function insertMoreSwitch(post) {
    let moreSwitch = document.createElement('button');
    moreSwitch.textContent = 'eщё';
    moreSwitch.classList.add('describe-switch');

    post.insertBefore(moreSwitch, post.querySelector('.post__when-posted'));
}

function addMoreSwitchInterruct(post, txt, maxHeight, originalTxt) {
    let moreSwitch = post.querySelector('.describe-switch');
    moreSwitch.addEventListener('click', function () {
        const moreState = moreSwitch.textContent;
        if (moreState == 'скрыть') {
            moreSwitch.textContent = 'ещё';
            showSmallText(txt, maxHeight, originalTxt);
        } else {
            moreSwitch.textContent = 'скрыть';
            showFullText(txt, originalTxt)
        }
    });
}

function showFullText(txt, originalTxt) {
    txt.innerHTML = originalTxt;
}

function showSmallText(txt, maxHeight, originalTxt) {
    txt.innerText = '';
    let newContent = '';

    for (let char of originalTxt) {
        txt.innerHTML += char;
        if (txt.scrollHeight > maxHeight) {
            newContent = txt.innerHTML.slice(0, -1).trim();

            while(txt.scrollHeight > maxHeight) {
                newContent = newContent.slice(0, -1).trim();
                txt.innerHTML = newContent + '...';
            }
            break;
        }
    }
}