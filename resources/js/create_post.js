import $ from "jquery"
import "select2/dist/js/select2"
import 'summernote/dist/summernote-lite';
import Toastify from "toastify-js";

(function () {
    $('#content').summernote({
        placeholder: '...',
        tabsize: 2,
        height: 300
    });
    $('select').select2();

    let tagList = [];
    let idList = [];
    let addList = [];

    const $tagList = $("#tagList");
    const $newTag = $("#newTag");
    const $boxSearch = $('.hashtag-result');
    const $storageTag = $("input[name=hashtag]");
    const $btnAdd = $(".js-add-tag");
    const $hashtagAdd = $("input[name=newHashtag]");

    $(document).ready(function () {
        let $type = $storageTag.attr('data-type');
        if ($type !== undefined) {
            let $dataUpdate = JSON.parse($storageTag.val());

            $dataUpdate.forEach(function (value) {
                tagList.push(value.slug);
                idList.push(value.id);
            });
        }
        tagList_render();
    });

    $(document).on('click', function (event) {
        if (!$(event.target).closest($boxSearch).length) {
            $boxSearch.hide();
        }
    });

    $boxSearch.on('click', function (event) {
        event.stopPropagation();
    });

    function tagList_render()
    {
        $tagList.empty();
        tagList.map(function (_tag) {
            let temp = '<li><label>' + _tag + '</label><span class="rmTag">&times;</span></li>';
            $tagList.append(temp);
        });
    }

    $newTag.on('keyup', function (e) {
        let $val = $(e.target).val();
        if ($val === '') {
            $boxSearch.hide();
        } else {
            $boxSearch.show();
            $boxSearch.find('li').each((index, value) => {
                let $valueSearch = $(value).text().toLowerCase();
                let $slugSearch = $(value).data('slug');

                if (tagList.includes($slugSearch)) {
                    $(value).hide();
                } else {
                    if ($valueSearch.includes($val)) {
                        $(value).show();
                    } else {
                        $(value).hide();
                    }
                }
            });
        }
    });

    $btnAdd.click((e) => {
        e.preventDefault();
        let newTag = $("#newTag").val().trim().toLowerCase();
        const $textToast = $(e.target).attr('data-toast');
        if (newTag !== '') {
            if (tagList.indexOf(newTag) === -1 && addList.indexOf(newTag) === -1) {
                tagList.push(newTag);
                addList.push(newTag);
                $newTag.val('');
                tagList_render();
            } else {
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
            }
        }
    });

    $boxSearch.find('li').click((e) => {
        let $slug = $(e.target).attr('data-slug');
        let $id = $(e.target).attr('data-id');

        if ($slug.replace(/\s/g, '') !== '' && !tagList.includes($slug)) {
            idList.push($id);
            tagList.push($slug);
            $newTag.val('');
            tagList_render();
        }
    });

    $tagList.on("click", "li>span.rmTag", function () {
        let index = $(this).parent().index();
        let textTagAdd = $(this).parent().find('label').html();

        if ($.inArray(textTagAdd, addList) !== -1) {
            addList = $.grep(addList, function (value) {
                return value !== textTagAdd;
            });
        } else {
            idList.splice(index, 1);
        }
        tagList.splice(index, 1);

        tagList_render();
    });

    $('#posts').one('submit', function (e) {
        e.preventDefault();
        $storageTag.val(null);
        if (idList.length > 0) {
            $storageTag.val(idList.join(','));
        }
        if (addList.length > 0) {
            $hashtagAdd.val(addList.join(','));
        }
        $(this).submit();
    });
})();
