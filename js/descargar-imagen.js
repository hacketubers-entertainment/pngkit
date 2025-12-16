$('a[download]').each(function() {
    var $a = $(this),
        fileUrl = $a.attr('href');
    $a.attr('href', 'data:application/octet-stream,' + encodeURIComponent(fileUrl));
});
