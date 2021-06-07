/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

require('bootstrap');

document.addEventListener('DOMContentLoaded', function () {
    document.getElementsByClassName('feedbackDelete').forEach(item => {
    item.addEventListener('click', event => {
            const url = item.dataset.path;
            const feedbackRow =  item.parentElement.parentElement;

            console.log(url);

            fetch(url, {
                method: 'DELETE',
                // body: {id: feedbackId}
            }).then((response) => {
                // console.log(response);
                return response.json();
            }).then((json) => {
                console.log('YAAAY', json);
                feedbackRow.remove();
            }).catch((error) =>{
                console.error('ERROR', error);
            })
        });
    })
})

// $(document).ready(function () {
//     console.log('Yaay');

//     $('.feedbackDelete').click(function (e) {
//         e.preventDefault();

//         var feedbackPath = $(this).data('path');

//         var array = feedbackPath.substring(1).split('/');

//         console.log(feedbackPath);


//         if (array[0] === 'lines' && array.length === 2) {
//             var id = parseInt(array[1]);
//             $.ajax({
//                 method: 'DELETE',
//                 url: "{{path('feedback_delete')}}",
//                 data: {id: id},
//                 success: function() {
//                     alert('GOOD');
//                 },
                
//             })
//         }

//         console.log(array);




//     })
// })

