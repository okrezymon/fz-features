/*
This is where custom js scripts go
 */
(function($){
    $(document).ready(function(){

        let container = $('#other-books-list');
        if (!container.length) return;
        let currentId = fz_features_ajax.current_id;

        $.ajax({
            url: fz_features_ajax.ajax_url,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'fz_get_latest_books',
                nonce: fz_features_ajax.nonce,
                current_id: currentId
            },
            success: function(response){
                if (response.success) {
                    let books = response.data;
                    let html = '<h3>Other books</h3><ul class="fz-latest-books-list">';
                    books.forEach(function(book){
                        html += '<li class="fz-book-item">';
                        html += '<a href="' + book.link + '">' + book.title + '</a>';
                        html += '<p><strong>Published:</strong> ' + book.date + '</p>';
                        html += '<p><strong>Genre:</strong> ' + book.genre + '</p>';
                        html += '<p>' + book.excerpt + '</p>';
                        html += '</li>';
                    });
                    html += '</ul>';
                    container.html(html);
                }
            }
        });

    });
})(jQuery);