window.addEventListener('load',function () {
    let ratings = document.querySelector('.single__ratings');

    for (let i = 1; i <=5; i++) {
        ratings.innerHTML='<i class="fa fa-star star-'+i+'"></i>';
    }
})