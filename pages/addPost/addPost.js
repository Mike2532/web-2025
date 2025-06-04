document.addEventListener("DOMContentLoaded", () => {
    const adButton = document.getElementById('upload');
    const previev = document.getElementById('preview');
    
    adButton.addEventListener('change', function() {
        const files = this.files;  
        if (!files.length) return;

        const lastFile = files[files.length - 1];

        const reader = new FileReader();

        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.alt = 'Загруженное изображение';

            img.classList.add('previw-picture');
            previev.appendChild(img);
        }

        reader.readAsDataURL(lastFile);
    })
})