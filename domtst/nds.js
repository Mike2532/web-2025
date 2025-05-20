const constants = {
    OFFSET: 1,
    MIN_VALUE: 1,
    FIRST_NUM_IND: 0,
    SECOND_NUM_IND: 1,
    COUNTER_SPLIT: '/'
}

function tstRSwipe(event) {
    const target = event.target;
    const post = target.closest('.post-block');
    const postPictures = post.querySelector('.posts');
    let curr = postPictures.querySelector('.visiable');
    
    curr.classList.remove('visiable');
    
    curr = curr.nextElementSibling;
    if (curr == null) {
        curr = postPictures.firstElementChild;
    }
    curr.classList.add('visiable');

    incrementCounter(post);
}

function tstLSwipe(event) {
    const target = event.target;
    const post = target.closest('.post-block');
    const postPictures = post.querySelector('.posts');
    let curr = postPictures.querySelector('.visiable');
    curr.classList.remove('visiable');
    
    curr = curr.previousElementSibling;
    if (curr == null) {
        curr = postPictures.lastElementChild;
    }
    curr.classList.add('visiable');

    decrementCounter(post);
}

function decrementCounter(post) {
    const postData = postPrepare(post);
    const newNum = ((postData.currNum - constants.OFFSET - constants.MIN_VALUE + postData.maxNum) % postData.maxNum) + constants.MIN_VALUE;
    postData.countBox.innerText = newNum + constants.COUNTER_SPLIT + postData.maxNum;
}

function incrementCounter(post) {
    const postData = postPrepare(post);
    const newNum = (postData.currNum % postData.maxNum) + constants.OFFSET;
    postData.countBox.innerText = newNum + constants.COUNTER_SPLIT + postData.maxNum;
}

function getCountBox(post) {
    return post.querySelector('.post-counter');
}

function getBoxNums(post) {
    const countBox = post.querySelector('.post-counter');
    let boxNums = countBox.innerText.split([constants.COUNTER_SPLIT]);
    boxNums = boxNums.map((x) => Number(x));
    return boxNums;
}

function postPrepare(post) {
    const postData = {};
    const boxNums = getBoxNums(post);
    postData.countBox = getCountBox(post);
    postData.boxNums = boxNums;
    postData.currNum = boxNums[constants.FIRST_NUM_IND];
    postData.maxNum = boxNums[constants.SECOND_NUM_IND];
    return postData;
}
