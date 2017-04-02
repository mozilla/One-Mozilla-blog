/*********
* This checks that a commenter has filled required fields.
* It also checks that the provided e-mail is well formed.
* Requires jQuery. 
*/

function fc_clear_errors(elements) {
  if (jQuery("#errors").length > 0) {
    jQuery("#errors").remove();
  }
  for (var i = 0; i < elements.length; i++) {
    elements[i].removeClass("err");
  }
}

function fc_add_error(element, error) {
  errorsDiv = document.getElementById("errors");
  if (errorsDiv == null) {
    errorsDiv = document.createElement("div");
    errorsDiv.id = "errors";
    jQuery("#comment-form .comment-notes").after(errorsDiv);
    jQuery("#comment-form .logged-in-as").after(errorsDiv);
  }
  errorP = document.createElement("p");
  errorP.innerHTML = error;
  errorsDiv.insertBefore(errorP, errorsDiv.firstChild);
  element.addClass("err");
}

function fc_check_author(author) {
  if (author.val() == "") {
    fc_add_error(author, objectL10n.noname);
    return false;
  }
  return true;
}

function fc_check_email(email) {
   if (email.val() == "") {
    fc_add_error(email, objectL10n.noemail);
    return false;
  } else {
    // check email format
    var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    if (!filter.test(email.val())) {
      fc_add_error(email, objectL10n.bademail);
      return false;
    }
  }
  return true;
}

function fc_check_comment(comment) {
  if (comment.val() == "") {
    fc_add_error(comment, objectL10n.nocomment);
    return false;
  }
  return true;
}

function fc_checkform() {
  comment = jQuery("#comment");
  email = jQuery("#email");
  author = jQuery("#author");

  fc_clear_errors([comment, email, author]);

  if (comment.length > 0) {
    fc_check_comment(comment) || comment.focus();
  }
  if (email.length > 0) {
    fc_check_email(email) || email.focus();
  }
  if (author.length > 0) {
    fc_check_author(author) || author.focus();;
  }

  return jQuery("#errors").length == 0;
}

jQuery( document ).ready(function() {
  jQuery("#comment-form").submit(fc_checkform);
});
