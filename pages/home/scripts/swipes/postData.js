function getPostData(event) {
    const postData = {};

    const target = event.target;
    const post = target.closest('.content-block__media')
    const postPictures = post.querySelector('.posts');
    let curr = postPictures.querySelector('.visiable');

    postData.post = post;
    postData.postPictures = postPictures;
    postData.curr = curr;

    return postData;
}

export default getPostData;