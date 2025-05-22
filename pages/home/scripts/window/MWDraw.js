import * as SwipeOperations from './../swipes/operations/operations.js';
import constants from './constants.js';

export function getPost(target) {
    const posBlockClone = target.closest('.content-block').cloneNode(true);
    return posBlockClone;
}

export function getModalWindow(target) {
    return target.closest('.all-posts').nextElementSibling;
}

export function insertPostToMW(post, modalWindow) {
    const MWContent = modalWindow.querySelector('.modal-window__content');
    const MWMedia = MWContent.querySelector('.content-block__media');
    
    MWMedia.appendChild(post.querySelector('.posts'));

    if (post.querySelector('.left-arrow') !== null) {
        MWMedia.appendChild(post.querySelector('.left-arrow'));
        MWMedia.appendChild(post.querySelector('.right-arrow'));
        MWContent.appendChild(createMWCounter(post));
    }
}

export function showMW(modalWindow) {
    modalWindow.classList.add('visiable');
}

function createMWCounter(post) {
    let Counter = document.createElement('span');
    Counter.classList.add('modal-window__counter');

    const CounterBox = SwipeOperations.getCountBox(post); 
    const CBNums = SwipeOperations.getBoxNums(CounterBox, constants.DEFAULT_SPLITTER);
    
    Counter.innerHTML =  CBNums[constants.CUR_PICTURE_IND] + constants.MW_SPLITTER + CBNums[constants.MAX_PICTURE_IND];
    return Counter;
}