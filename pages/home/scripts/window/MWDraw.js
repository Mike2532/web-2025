//import * as SwipeOperations from './../swipes/operations/operations.js';
import constants from './constants.js';

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

    const CounterBox = getCountBox(post); 
    const CBNums = getBoxNums(CounterBox, constants.DEFAULT_SPLITTER);
    
    Counter.innerHTML =  CBNums[constants.CUR_PICTURE_IND] + constants.MW_SPLITTER + CBNums[constants.MAX_PICTURE_IND];
    return Counter;
}

function getCountBox(post) {
    post = post.closest('.content-block') || post.closest('.modal-window__content');
    return post.querySelector('.content-block__media') || post.querySelector('.modal-window__counter');
}

function getBoxNums(countBox, divider) {
    let boxNums = countBox.innerText.split(divider);
    boxNums = boxNums.map((x) => Number(x));
    return boxNums;
}




document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.info__description-more').forEach(button => {
        const text = button.parentElement.querySelector('.info__description-text');
        
        function checkTextHeight() {
            text.classList.remove('showContent');
            const isOverflowing = text.scrollHeight > text.clientHeight;
            button.style.display = isOverflowing ? 'inline-block' : 'none';
            text.classList.add('hideContent');
        }
        
        button.addEventListener('click', function() {
            if (text.classList.contains('hideContent')) {
                text.classList.remove('hideContent');
                text.classList.add('showContent');
                this.textContent = 'свернуть';
            } else {
                text.classList.remove('showContent');
                text.classList.add('hideContent');
                this.textContent = 'ещё';
            }
        });
        
        checkTextHeight();
        window.addEventListener('resize', checkTextHeight);
    });
});