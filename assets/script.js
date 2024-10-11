
$(document).ready(function() {
    $('.removeElement').on('click', function() {
        var bookId = $(this).data('id');
        $('#bookId').val(bookId);
    });
});

$('.removeElement').on('click', function() {
    var loanId = $(this).data('id');
    $('#loanId').val(loanId);
});
    $(document).on('click', '.removeElement', function() {
        var userId = $(this).data('id');
        $('#userId').val(userId);
    });



