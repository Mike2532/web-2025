document.addEventListener("DOMContentLoaded", () => {
    checkDescriptionSize();
});

function checkDescriptionSize() {
    const txt = document.querySelector('.container');
    const maxHeight = parseFloat(getComputedStyle(txt).lineHeight) * 2;
    const originalTxt = txt.innerText;
    if (txt.scrollHeight > maxHeight) {
        showSmallText(txt, maxHeight, originalTxt);
    }
}

function showSmallText(txt, maxHeight, originalTxt) {
    txt.innerText = '';
    let newContent = '';

    for (let char of originalTxt) {
        txt.innerHTML += char;
        if (txt.scrollHeight > maxHeight) {
            newContent = txt.innerHTML.slice(0, -1).trim();

            while(txt.scrollHeight > maxHeight) {
                newContent = newContent.slice(0, -1).trim();
                txt.innerHTML = newContent + '...';
            }
            break;
        }
    }
}

function showFullText(txt, originalTxt) {
    txt.innerHTML = originalTxt;
}