/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
import $ from 'jquery';


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


const articles = document.getElementById('articles');

if (articles) {
    articles.addEventListener('click', e => {
        if (e.target.className === 'btn btn-danger delete-article') {
            if (confirm('Tem certeza que deseja excluir?')) {
                const id = e.target.getAttribute('data-id');

                fetch(`/article/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }
    });
}
