

$(document).ready(function(){

  $('.read-more-c').click(function(){
    var $text = $(this).prev('.commentText');
    $text.toggleClass('show-more');
    if ($text.hasClass('show-more')) {
      $(this).text('Read less');
    } else {
      $(this).text('Read more');
    }
          // $('#omda').html($text.height());

  });
//////////////////////////////////////////////////page reload 
      var alreadyRun = false; 
    function checkAndHide() {
        if (!alreadyRun) {
            $('.read-more-c').each(function() {
                var commentText = $(this).prev('.commentText');
                if (commentText.height() < 190) {
                    $(this).hide(); // Hide the readmore button
                }
            });
            alreadyRun = true; 
        }
    }

    checkAndHide(); // Run the function when the page loads

/////////////////////////////////////
 $(window).resize(function() {
      $('.read-more-c').each(function() {
        var commentText = $(this).prev('.commentText');
        // $('#omda').html(commentText.height());
        if (commentText.height() < 190) {
          $(this).hide(); // Hide the readmore button
        } else {
          $(this).show(); // Show the readmore button if condition is not met
        }
      });
    });






});

