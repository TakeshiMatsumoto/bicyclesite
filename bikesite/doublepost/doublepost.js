
function disableSubmit(form) {//2連続でクリックするのを防ぐ
  var elements = form.elements;
  for (var i = 0; i < elements.length; i++) {
    if (elements[i].type == 'submit') {
      elements[i].disabled = true;
    }
  }
}
