jQuery(function ($) {

    let like = $('.single__likes');

    like.on('click',likeFn);


    function likeFn(e) {
        if (like.attr('data-exists') == 'yes') {
            deleteLike();
        }else{
            createLike();
        }
    }

    function createLike(e) {
        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', universityData.nonce);
            },
            url : universityData.root_url + '/wp-json/university/v1/like',
            type : 'POST',
            data : { 'professorId' : like.attr('data-professor')},
            success: function (response) {
                like.attr('data-exists','yes');
                let likeCount = parseInt($('.single__likes-count').html(),10);
                likeCount++;
                $('.single__likes-count').html(likeCount);
                like.attr('data-like',response);
                console.log(response);
            },
            error: function(response){
                console.log(response);
            }
        });
    }

    function deleteLike(e) {
        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', universityData.nonce);
            },
            url : universityData.root_url + '/wp-json/university/v1/like',
            type : 'DELETE',
            data : { 'like' : like.attr('data-like')},
            success: function (response) {
                like.attr('data-exists','no');
                let likeCount = parseInt($('.single__likes-count').html(),10);
                likeCount--;
                $('.single__likes-count').html(likeCount);
                like.attr('data-like','');
                console.log(response);
            },
            error: function(response){
                console.log(response);
            }
        });
    }

});