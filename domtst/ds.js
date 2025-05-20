document.addEventListener("DOMContentLoaded", () => {
    
    const allPosts = document.getElementsByClassName('post-block')
    for(let post of allPosts) {
        const postContent = post.getElementsByClassName('post').length
        if (postContent > 1) {
            post.innerHTML += getButtons()
        }
    }

    const postBox = document.querySelector('.all-posts')
    postBox.onclick = function(event) {
        let target = event.target
        let targetClasses = target.classList
        for (let atr of targetClasses) {
            
            
            if ( (atr == 'right-arrow') || (atr == 'left-arrow') ) {
                doSwipe(target, atr)
            } 
        }
    }

})

function doSwipe(target, type) {
    const post = target.closest('.post-block').querySelector('.posts');
    let curr = post.querySelector('.visiable');
    curr.classList.remove('visiable');

    (type == 'right-arrow')
        ? rightSwipe(curr, post)
        : leftSwipe(curr, post)
}

function rightSwipe(curr, post) {
    curr = curr.nextElementSibling

    if (curr == null) {
        curr = post.firstElementChild
    }
    curr.classList.add('visiable')
}

function leftSwipe(curr, post) {
    curr = curr.previousElementSibling
    if (curr == null) {
        curr = post.lastElementChild
    }
    curr.classList.add('visiable')
}

function getButtons() {
    return `
    <img class="top-button" src="/media/static_media/edit_icon.svg">
    <div class="buttons">
        <img class="left-arrow" onclick="tstLSwipe(event)" src="/media/static_media/edit_icon.svg">
        <img class="right-arrow" onclick="tstRSwipe(event)" src="/media/static_media/edit_icon.svg">
    </div>
    `
}