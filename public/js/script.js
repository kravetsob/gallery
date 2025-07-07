const footer = document.querySelector('footer');
const rightArrow = document.querySelector('.right-arrow');
const leftArrow = document.querySelector('.left-arrow');
const photoContainer = document.querySelector('.photo-container');
const imageElement = document.getElementById('image');

const gallery = document.getElementById('gallery');
const images = JSON.parse(gallery.dataset.images);
let currentIndex = 0;

function getImg(index) {
    if (images.length > 0){
        imageElement.src = 'images/' + images[index];
    }
}

function reset() {
    if (leftArrow) leftArrow.classList.remove('hide');
    if (rightArrow) rightArrow.classList.remove('hide');
    if (footer) footer.classList.remove('hide');
}


function clickOnArrows(){
    document.querySelector('.left-arrow').addEventListener('click', function (){
        if(currentIndex === 0){
            currentIndex = images.length - 1;
        }else{
            currentIndex = currentIndex - 1;
        }
        getImg(currentIndex);
    });

    document.querySelector('.right-arrow').addEventListener('click', function(){
        if(currentIndex === images.length - 1){
            currentIndex = 0;
        }else{
            currentIndex = currentIndex + 1;
        }
        getImg(currentIndex);
    });
}

function fullScreenOn(){
    imageElement.addEventListener('click', function () {
        photoContainer.classList.toggle('fullscreen');
        footer.classList.toggle('hide');
        rightArrow.classList.toggle('hide');
        leftArrow.classList.toggle('hide');
    });

}

function showUploadMessage() {
    const successMessage = document.getElementById('upload-success');
    const errorList = document.getElementById('upload-errors');

    if (successMessage) {
        successMessage.classList.remove('hide');
        setTimeout(() => successMessage.classList.add('hide'), 5000);
    }

    if (errorList) {
        errorList.classList.remove('hide');
        setTimeout(() => errorList.classList.add('hide'), 5000);
    }
}

function delUploadMsg() {
    document.querySelectorAll('.message .close-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const messageBox = btn.parentElement;
            messageBox.classList.add('hide');
        });
    });
}


function init()
{
    reset();
    clickOnArrows();
    fullScreenOn();
    showUploadMessage();
    delUploadMsg();
}
init();


