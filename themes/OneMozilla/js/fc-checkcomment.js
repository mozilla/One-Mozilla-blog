/*********
* This checks that a commenter has filled required fields.
* It also checks that the provided e-mail is well formed.
* Requires jQuery. 
*/
function fc_checkform(req) {
  author  = document.getElementById("author");
  email   = document.getElementById("email");
  comment = document.getElementById("comment");
  
if (jQuery("#errors")) { jQuery("#errors").remove(); }
jQuery("#author, #email, #comment").removeClass("err");

if (req == 'req') {
  if ((author.value == "") && (email.value == "")) {
    author.focus();
    jQuery("#author, #email").addClass("err");
    jQuery("#comment-form ol").before("<div id='errors'></div>");
    jQuery("#errors").html("<p>You must provide a name and e-mail (your e-mail address won't be published).</p>");
    return false;
  }
  if ((author.value == "") && (email.value != "")) {
    author.focus();
    jQuery("#author").addClass("err");
    jQuery("#email").removeClass("err");
    jQuery("#comment-form ol").before("<div id='errors'></div>");
    jQuery("#errors").html("<p>You must provide a name.</p>");
    return false;
  }
  if ((author.value != "") && (email.value == "")) {
    email.focus();
    jQuery("#email").addClass("err");
    jQuery("#author").removeClass("err");
    jQuery("#comment-form ol").before("<div id='errors'></div>");
    jQuery("#errors").html("<p>You must provide an e-mail address (it won't be published).</p>");
    return false;
  }
}

// check email format
var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
if ((email.value != "") && (filter.test(email.value))) {
  jQuery("#email").removeClass("err");
}
else {
  jQuery("#email").addClass("err").focus();
  jQuery("#comment-form ol").before("<div id='errors'></div>");
  jQuery("#errors").html("<p>The e-mail address you entered doesn't look like a complete e-mail address. It should look like <em>yourname@example.com</em>.</p>");
  return false;
}
  
if ( comment.value == "" ) {
  comment.focus();
  jQuery("#comment").addClass("err");
  jQuery("#comment-form ol").before("<div id='errors'></div>");
  jQuery("#errors").html("<p>You must enter a comment.</p>");
  return false;
}
else {
  jQuery("#comment").removeClass("err");
}
  
/* if everything checks out, return true */
return true;
}
