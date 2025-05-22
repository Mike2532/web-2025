import constants from "./constants.js";
import postPrepare from "./postPrepare.js";

export function incrementCounter(post) {
    updateCounter(post, 'increment');
}

export function decrementCounter(post) {
    updateCounter(post, 'decrement');
}

function updateCounter(post, direction) {
    const postData = postPrepare(post);

    let newNum;
    if (direction == 'increment') {
        newNum = (postData.currNum % postData.maxNum) + constants.OFFSET;
    } else if (direction == 'decrement') {
        newNum = ((postData.currNum - constants.OFFSET - constants.MIN_VALUE + postData.maxNum) % postData.maxNum) + constants.MIN_VALUE;
    }

    postData.countBox.innerText = newNum + postData.divider + postData.maxNum;
}

export function getCountBox(post) {
    post = post.closest('.content-block') || post.closest('.modal-window__content');
    return post.querySelector('.content-block__media')||post.querySelector('.modal-window__counter');
}

export function getBoxNums(countBox, divider) {
    let boxNums = countBox.innerText.split(divider);
    boxNums = boxNums.map((x) => Number(x));
    return boxNums;
}