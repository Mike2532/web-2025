import constants from './constants.js';

export function getButtons() {
    return `
        <img class="left-arrow" src="/domtst/images/LeftSlide.svg">
        <img class="right-arrow" src="/domtst/images/RightSlide.svg">
    `
}

export function getCounter() {
    return `
        <div class="content-block__counter">
        </div>
    `
}

export function fillCountBox(post, postContentLen, splitter) {
    const countBox = post.querySelector('.content-block__counter')||post.querySelector('.modal-window__counter');
    countBox.innerText = constants.FIRST_POST + splitter + postContentLen;       
}