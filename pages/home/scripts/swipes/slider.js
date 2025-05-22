const OFFSET = 1;

function createSlider(postElement, splitter) {
    const pictures = postElement.querySelectorAll('.post-picture');
    const counterBox = postElement.querySelector('.content-block__counter')||postElement.querySelector('.modal-window__counter');
    const maxIndex = pictures.length;

    let currentIndex = Array.from(pictures).findIndex(pic => pic.classList.contains('visiable'));
    let currentPicture = pictures[currentIndex];

    function showPicture(index) {
        currentPicture.classList.remove('visiable');
        currentPicture = pictures[index];
        currentPicture.classList.add('visiable');
        updateCounter(index);
    }

    function updateCounter(index) {
        let newCounter = ''

        newCounter = `${index + 1}`;
        (splitter == '/')
            ? newCounter += '/'
            : newCounter += ' из ';
        newCounter += `${maxIndex}`;    
        
        counterBox.innerText = newCounter;
    }

    function swipeLeft() {
        currentIndex = (currentIndex - OFFSET + maxIndex) % maxIndex;
        showPicture(currentIndex);
    }

    function swipeRight() {
        currentIndex = (currentIndex + OFFSET) % maxIndex;
        showPicture(currentIndex);
    }

    function init() {
        postElement.querySelector('.left-arrow')?.addEventListener('click', swipeLeft);
        postElement.querySelector('.right-arrow')?.addEventListener('click', swipeRight);
        currentPicture.classList.add('visiable');
        updateCounter(currentIndex);
    }

    init();
}

export default createSlider;