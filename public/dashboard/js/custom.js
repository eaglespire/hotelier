$(document).ready(function () {
    //Toggle whether to input text or select image for the
    //column title
    let options = document.getElementsByClassName('column-title');
    let titleString = document.getElementsByClassName('title-string');
    let titleImage = document.getElementsByClassName('title-image');
    let selectIcon = document.getElementsByClassName('select-icon');
    let chooseIcon = document.getElementsByClassName('choose-icon');
    let makeLink = document.getElementById('make-link');
    let pickLink = document.getElementsByClassName('pick-link');


    titleString[0].style.display = 'none';
    titleImage[0].style.display = 'none';
    chooseIcon[0].style.display = 'none';
    pickLink[0].style.display = 'none';
    pickLink[1].style.display = 'none';


    //Event Listeners
    options[0].addEventListener('click', function () {
        if(options[0].value === 'text'){
            titleString[0].style.display = 'block';
            titleImage[0].style.display = 'none';
        }
        if(options[0].value === 'image'){
            titleString[0].style.display = 'none';
            titleImage[0].style.display = 'block';
        }
    })

    selectIcon[0].addEventListener('click', function (){
        if (selectIcon[0].value === 'yes'){
            chooseIcon[0].style.display = 'block';
        }else{
            chooseIcon[0].style.display = 'none';
        }
    })

    makeLink.addEventListener('click', function () {
        if (makeLink.value === '1'){
            pickLink[0].style.display = 'block';
            pickLink[1].style.display = 'block';
        }else{
            pickLink[0].style.display = 'none';
            pickLink[1].style.display = 'none';
        }
    })

})

$(document).ready(function () {
    let options2 = document.getElementsByClassName('column-title-2');
    let titleString2 = document.getElementsByClassName('title-string-2');
    let titleImage2 = document.getElementsByClassName('title-image-2');
    let selectIcon2 = document.getElementsByClassName('select-icon-2');
    let chooseIcon2 = document.getElementsByClassName('choose-icon-2');
    let makeLink2 = document.getElementById('make-link-2');
    let pickLink2 = document.getElementsByClassName('pick-link-2');

    titleString2[0].style.display = 'none';
    titleImage2[0].style.display = 'none';
    chooseIcon2[0].style.display = 'none';
    pickLink2[0].style.display = 'none';
    pickLink2[1].style.display = 'none';


    //Event Listeners

    options2[0].addEventListener('click', function () {
        if(options2[0].value === 'text'){
            titleString2[0].style.display = 'block';
            titleImage2[0].style.display = 'none';
        }
        if(options2[0].value === 'image'){
            titleString2[0].style.display = 'none';
            titleImage2[0].style.display = 'block';
        }
    })


    selectIcon2[0].addEventListener('click', function (){
        if (selectIcon2[0].value === 'yes'){
            chooseIcon2[0].style.display = 'block';
        }else{
            chooseIcon2[0].style.display = 'none';
        }
    })
    makeLink2.addEventListener('click', function () {
        if (makeLink2.value === '1'){
            pickLink2[0].style.display = 'block';
            pickLink2[1].style.display = 'block';
        }else{
            pickLink2[0].style.display = 'none';
            pickLink2[1].style.display = 'none';
        }
    })
})

$(document).ready(function () {
    let options3 = document.getElementsByClassName('column-title-3');
    let titleString3 = document.getElementsByClassName('title-string-3');
    let titleImage3 = document.getElementsByClassName('title-image-3');
    let selectIcon3 = document.getElementsByClassName('select-icon-3');
    let chooseIcon3 = document.getElementsByClassName('choose-icon-3');
    let makeLink3 = document.getElementById('make-link-3');
    let pickLink3 = document.getElementsByClassName('pick-link-3');

    titleString3[0].style.display = 'none';
    titleImage3[0].style.display = 'none';
    chooseIcon3[0].style.display = 'none';
    pickLink3[0].style.display = 'none';
    pickLink3[1].style.display = 'none';

    //Event Listeners
    options3[0].addEventListener('click', function () {
        if(options3[0].value === 'text'){
            titleString3[0].style.display = 'block';
            titleImage3[0].style.display = 'none';
        }
        if(options3[0].value === 'image'){
            titleString3[0].style.display = 'none';
            titleImage3[0].style.display = 'block';
        }
    })

    selectIcon3[0].addEventListener('click', function (){
        if (selectIcon3[0].value === 'yes'){
            chooseIcon3[0].style.display = 'block';
        }else{
            chooseIcon3[0].style.display = 'none';
        }
    })
    makeLink3.addEventListener('click', function () {
        if (makeLink3.value === '1'){
            pickLink3[0].style.display = 'block';
            pickLink3[1].style.display = 'block';
        }else{
            pickLink3[0].style.display = 'none';
            pickLink3[1].style.display = 'none';
        }
    })
})


$(document).ready(function () {
    let selectIcon4 = document.getElementsByClassName('select-icon-4');
    let chooseIcon4 = document.getElementsByClassName('choose-icon-4');
    let makeLink4 = document.getElementById('make-link-4');
    let pickLink4 = document.getElementById('pick-link-4');


    chooseIcon4[0].style.display = 'none';
    pickLink4.style.display = 'none';

    //Event Listeners
    selectIcon4[0].addEventListener('click', function (){
        if (selectIcon4[0].value === 'yes'){
            chooseIcon4[0].style.display = 'block';
        }else{
            chooseIcon4[0].style.display = 'none';
        }
    })
    makeLink4.addEventListener('click', function () {
        if (makeLink4.value === '1'){
            pickLink4.style.display = 'block';
        }else{
            pickLink4.style.display = 'none';
        }
    })
})
