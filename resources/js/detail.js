import $ from "jquery"
import 'emojionearea/dist/emojionearea';
import Toastify from 'toastify-js'

$('.textarea-emoji').emojioneArea({
    pickerPosition: 'top',
})

$('#comment').on('submit', function (e) {
    e.preventDefault();

    let $postId = $(e.target).find('button[type=submit]').data('post');
    let $userId = $(e.target).find('button[type=submit]').data('user');
    let $content = $(e.target).find('.emojionearea-editor').html();
    let $route = $(e.target).attr('action');
    let $csrfToken = $('meta[name="csrf-token"]').attr('content');
    let $data = new FormData();

    if ($content === '') {
        const $textToast = $(e.target).find('button[type=submit]').data('validate-false');

        Toastify({
            text: $textToast,
            duration: 3000,
            close: true,
            gravity: "bottom",
            position: "right",
            stopOnFocus: true,
            style: {
                background: "linear-gradient(to right, rgb(255, 0, 0), rgb(255, 153, 153))"
            }
        }).showToast();
    } else {
        $(e.target).find('.emojionearea-editor').html('');
        const $textToast = $(e.target).find('button[type=submit]').data('validate-true');

        $data.append('postId', $postId);
        $data.append('userId', $userId);
        $data.append('content', $content);

        $.ajax({
            url: $route,
            data: $data,
            processData: false,
            contentType: false,
            type: 'POST',
            headers: {
                'X-CSRF-Token': $csrfToken
            },
            success: function () {
                Toastify({
                    text: $textToast,
                    duration: 3000,
                    close: true,
                    gravity: "bottom",
                    position: "right",
                    stopOnFocus: true,
                    style: {
                        background: "linear-gradient(to right, rgb(0, 100, 0), rgb(0, 255, 0))"
                    }
                }).showToast();
            }
        });
    }
})
