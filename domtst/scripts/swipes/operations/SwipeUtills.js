import constants from "./constants.js";

export function getCountBox(post) {
    post = post.closest('.post-block') || post.closest('.modal-window__content');
    return post.querySelector('.post-counter')||post.querySelector('.modal-window__counter');
}

export function getBoxNums(countBox, divider) {
    let boxNums = countBox.innerText.split(divider);
    boxNums = boxNums.map((x) => Number(x));
    return boxNums;
}

export function getCBDivider(CountBox) {
    let divider;
    (CountBox.innerText.includes('/'))
        ? divider = constants.COUNTER_SPLIT
        : divider = constants.MWSplit;
    return divider;
}