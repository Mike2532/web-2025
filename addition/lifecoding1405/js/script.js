/**
 * 
 * @param {{
 *  title: string,
 *  body: string,
 *  LikeCount: number,
 * }} post 
 */

function renderPost(post) {
    const post = document.querySelector('#posts');

    const postBlock = document.createElement('div');
    postBlock.classList.add('post');
    
    const postTitle = document.createElement('h2');
    postTitle.textContent = post.title;
    postBlock.appendChild(postTitle);
    
    const description = document.createElement('p');
    description.textContent = post.body;
    postBlock.appendChild(description);
    
    
    const postLikeButton = document.createElement('button');
    postLikeButton.textContent = post.LikeCount;
    postLikeButton.addEventListener('click', (event) => {
        const likes = +event.target.innerText;
        const newLikesCount = likes + 1;
        event.target.innerText = newLikesCount;
    });
    postBlock.appendChild(postLikeButton);

    posts.appendChild(postBlock);
}

function initPosts() {
    fetch('https://dummyjson.com/posts?limit=5')
        .then(res => res.json())
        .then(posts => {
            posts.posts.forEach(post => {
                console.log(posts.title);
                const postBlock = document.createElement('div');
                postBlock.classList.add('post');
                
                const postTitle = document.createElement('h2');
                postTitle.textContent = post.title;
                postBlock.appendChild(postTitle);
                
                const description = document.createElement('p');
                description.textContent = post.body;
                postBlock.appendChild(description);
                
                posts.appendChild(postBlock);
                renderPost({
                    title: post.title,
                    body: post.body,
                })
            })
        });
}

async function AddPost() {
    const res = await fetch('https://dummyjson.com/posts/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify ({
            title,
            body: description,
            userId: 1,
        }),
    });
    const post = await res.json();
    
    renderPost({
        title: post.title,
        body: post.body,
    })
    
}

function initAddPosts() {
    const addPostButton = document.querySelector('#addPostButton');
    addPostButton.addEventListener('click', () => {
        const title = document.querySelector('#postTitle');
        const description = document.querySelector('#postDescription');

        addPost();
    });
}

getPosts();
initAddPosts();