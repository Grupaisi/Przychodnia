

function showonlyonev2(thechosenone) {
      var newboxes = document.getElementsByTagName("div");
      for(var x=0; x<newboxes.length; x++) {
            name = newboxes[x].getAttribute("class");
            if (name == 'newboxes-4') {
                  if (newboxes[x].id == thechosenone) {
                        if (newboxes[x].style.display == 'block') {
                              newboxes[x].style.display = 'none';
                        }
                        else {
                              newboxes[x].style.display = 'block';
                        }
                  }else {
                        newboxes[x].style.display = 'none';
                  }
            }
      }
}



