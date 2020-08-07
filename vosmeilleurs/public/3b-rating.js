var rating = {
  highlight : function(selected){
  // highlight() : update the number of stars on mouse over
  // PARAM selected : number of stars selected

    var stars = document.getElementsByClassName("star");
    for (var i=0; i<stars.length; i++) {
      if (i < selected) {
        stars[i].classList.add("over");
      } else {
        stars[i].classList.remove("over");
      }
    }
  },

  save : function(rating){
  // save() : save rating
  // PARAM rating : selected rating

    // FETCH RATING DATA
    var data = new FormData();
    data.append('req', "save");
    data.append('product_id', document.getElementById("rate-id").value);
    data.append('rating', rating);

    // AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', "2c-ajax-rating.php", true);
    xhr.onload = function(){
      if (this.response=="OK") {
        alert("Rating Saved.");
      } else {
        alert("Error saving rating.");
      }
    };
    xhr.send(data);
  }
};