import 'bootstrap/dist/js/bootstrap.bundle'
import $ from "jquery"
import Toastify from "toastify-js";

const $btnSubmitReport = $('.js-submit-report');
const $textareaSubmit = $('#reportModal').find('textarea[name=content]');
const $btnReport = $('.js-report');

$btnReport.click((e) => {
    e.preventDefault();
    let $title = $(e.target).closest('.js-parent').find('.js-title-report').html();
    let $boxImportTitle = $('.js-import-title');

    $boxImportTitle.html('');
    $boxImportTitle.html($title);
})

$btnReport.click((e) => {
    let $this = $(e.target).closest('.js-report');
    let $id = $this.data('id');
    let $type = $this.data('type');

    $btnSubmitReport.attr('data-id', $id);
    $btnSubmitReport.attr('data-type', $type);
})

$('button[data-dismiss=modal]').click(() => {
    $btnSubmitReport.attr('data-id', '');
    $btnSubmitReport.attr('data-type', '');
})

$btnSubmitReport.click((e) => {
    let $id = $(e.target).attr('data-id');
    let $type = $(e.target).attr('data-type');
    let $content = $textareaSubmit.val();
    let $route = $(e.target).data('route');
    let $userId = $(e.target).data('user-id');
    let $csrfToken = $('meta[name="csrf-token"]').attr('content');

    if ($content === '') {
        const $textToast = $(e.target).data('validate-false');

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
        let $data = new FormData();
        const $textToast = $(e.target).data('validate-true');

        $textareaSubmit.val('');

        $data.append('id', $id);
        $data.append('type', $type);
        $data.append('content', $content);
        $data.append('user_id', $userId);

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
});
