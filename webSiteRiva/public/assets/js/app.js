/*
Get click and show likes
 */


var $container = $('.js-like-dislike');
$container.find('a').on('click',function(e){
    console.log('Click detectado');
    e.preventDefault();
    var $link = $(e.currentTarget)
    console.log($link);
    console.log($link.data('like'));

    $.ajax({
       url: '/messages/12/like/' + $link.data('like'),
       method: 'POST'
    }).then(function (response){
        console.log(response.likes);
        document.getElementById('js-total-likes').innerHTML = response.likes;
    });

});
