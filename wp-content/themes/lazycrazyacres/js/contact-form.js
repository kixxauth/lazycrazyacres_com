$(function ($) {
var $form = $('#contact-form')
  , $email = $('#id_email')
  , $name = $('#id_name')
  , $comment = $('#id_comment')
  , isLocked = false

function onSuccess(aData, aStatus, aXHR) {
    $form.fadeOut(600, function () {
        $('#thank-you').fadeIn();
        clearForm();
    });
}

function onFailure(aXHR, aStatus, aErr) {
    aXHR = (aXHR || {});

    if (aXHR.status == 400) {
        reportInputError(aXHR.responseText);
        return;
    }

    if (typeof console !== 'undefined' && console.error) {
        console.error('form response error', aXHR.status, aXHR.statusText);
        console.error(aXHR.responseText);
        if (aErr) {
            console.error(aErr);
        }
    }

    reportUnknownError();
}

function reportInputError(aMsg) {
    var message = $.trim(aMsg);

    switch (message) {
        case 'MESSAGE_UNDEFINED':
            alert('Ooops. Did you forget to type a comment?');
            break;
        case 'EMAIL_UNDEFINED':
            alert('Ooops. Did you forget your email address?');
            break;
        case 'EMAIL_INVALID':
            alert('Ooops. Your email does not look valid. Try typing it again.');
            break;
        default:
            reportUnknownError();
    }
}

function reportUnknownError() {
    clearForm();
    var msg = "Sorry, there was a problem sending your comment. ";
    msg += "Please help us fix this problem by sending an ";
    msg += "email to info@lazycrazyacres.com";
    alert(msg);
}

function clearForm() {
    $email.val('');
    $name.val('');
    $comment.val('');
}

$form.submit(function (ev) {
    ev.preventDefault();

    if (isLocked) return;
    isLocked = true;

    var data = {}
      , req = {
            url: $form.attr('action')
          , type: $form.attr('method')
          , data: data
        }

    data.contact_email = $email.val();
    data.contact_name = $name.val();
    data.contact_comment = $comment.val();

    $.when($.ajax(req))
        .then(onSuccess, onFailure)
        .always(function () { isLocked = false; });
});
});
