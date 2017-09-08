
$(document).ready(function () {
    $('.js-products-userSearch').select2({
        placeholder: 'Select user',
        ajax: {
            url: '/user/ajax-search',
            dataType: 'json',
            delay: 250,
            cache: true
        }
    });
});