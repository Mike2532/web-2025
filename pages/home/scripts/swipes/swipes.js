import * as SwipeOperations from './operations/operations.js';
import getPostData from './postData.js';

export function addSWListeners(post) {
    const leftButton = post.querySelector('.left-arrow');
    if (leftButton !== null) {
        leftButton.addEventListener('click', (event) => tstLSwipe(event));
    }
    
    const rightButton = post.querySelector('.right-arrow');
    if (rightButton !== null) {
        rightButton.addEventListener('click', (event) => tstRSwipe(event));
    }
}

export function tstRSwipe(event) {
    doSwipe(event, 'right');
}

export function tstLSwipe(event) {
    doSwipe(event, 'left');
}

function doSwipe(event, direction) {
    const postData = getPostData(event);

    let curr = postData.curr;
    curr.classList.remove('visiable');

    if (direction == 'right') {
        curr = curr.nextElementSibling;
        if (curr == null) {
            curr = postData.postPictures.firstElementChild;
        }
        SwipeOperations.incrementCounter(postData.post);
    } else if (direction == 'left') {
        curr = curr.previousElementSibling;
        if (curr == null) {
            curr = postData.postPictures.lastElementChild;
        }
        SwipeOperations.decrementCounter(postData.post);
    }
    curr.classList.add('visiable');
}