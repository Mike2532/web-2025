document.addEventListener("DOMContentLoaded", () => {

    const posts = document.getElementsByClassName('post')
    console.log(posts)

    //getElementByClassName() - ищет по имени класса, возвращает живую коллекцию
    //querySelectorAll() - ищет по css селектору
    //.children - живая коллекция элементов родительского DOM элемента
    //document.body.children || document.body.firstElementChild.children
    //.firstElementChild - применяется к DOM и возвращает первый HTML-элемент (<div>)
    //.nextElementSibling - применяется к HTML-элементу и возвращает следующий
    //parentElement - применяется к DOM, возвращает родительский HTML-элемент
    //closest() - ищет ближайщего предка по css селектору (сам элемент тоже участвует)
    //matches - проверяет, есть ли у элемента css селектор



    // const posts = document.querySelectorAll('.post')
    // console.log(posts)


    // const posts = document.querySelector('.posts').children

    // const size = posts.length
    // const post = posts[0]
    // const post_content = post.querySelector('.post__content').children
    // const post_pict = post_content[0]
    // post_pict.classList.add('visiable')

    // console.log('всего постов: ', size)
    // console.log('посты: ', post_content)
    // console.log('перввая картинка поста: ', post_pict)



    // const post = posts.firstElementChild
    // const post2 = post.nextElementSibling
    // console.log(post)
    // console.log(post2)



    // const bodyElem = Array.from(document.body.childNodes).filter(x => x.nodeType === div.post);
    // console.log(bodyElem)
})