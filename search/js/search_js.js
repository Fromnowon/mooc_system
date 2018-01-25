$(function () {
    $(':input').labelauty();
    //checkbox互斥
    checkboxMutex($(".all-grade"),$(".grade-m"));
    checkboxMutex($(".all-subject"),$(".subject-m"));
});

function checkboxMutex(a, b) {
    a.change(function () {
        if ($(this).is(':checked')) {
            b.prop('checked', false);
        }
    });
    b.change(function () {
        if ($(this).is(':checked')) {
            a.prop('checked', false);
        }
    });
}