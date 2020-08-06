var thumb = $("#thumb-area")[0];

var thumbs = function(element, event, on, off) {
  var element = $(element);
  var iconClassOn = "icon-thumbs-"+on;
  var iconClassOff = "icon-thumbs-"+off;
  element.removeClass(off).addClass(on);
  element.find(".icon").removeClass(iconClassOff).addClass(iconClassOn);
  setTimeout(function() { element.removeClass(on).find(".icon").removeClass(iconClassOn) }, 1000);
};

var thumbsUp = function(event) {
  thumbs(this, event, "up", "down");
};

var thumbsDown = function(event) {
  thumbs(this, event, "down", "up");
};

var defaults = {
  drag_block_vertical: true
}
Hammer(thumb).on("swipeup", thumbsUp);
Hammer(thumb).on("swipedown", thumbsDown);
Hammer(thumb).on("drag", function(event) {
  if (event.gesture) {
    event.gesture.preventDefault();
  }
});


