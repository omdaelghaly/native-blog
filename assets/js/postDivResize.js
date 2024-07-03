

$(document).ready(function(){

  $('.read-more').click(function(){
    var $text = $(this).prev('.postText');
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
            $('.read-more').each(function() {
                var postText = $(this).prev('.postText');
                if (postText.height() < 190) {
                    $(this).hide(); // Hide the readmore button
                }
            });
            alreadyRun = true; 
        }
    }

    checkAndHide(); // Run the function when the page loads

/////////////////////////////////////
 $(window).resize(function() {
      $('.read-more').each(function() {
        var postText = $(this).prev('.postText');
        // $('#omda').html(postText.height());
        if (postText.height() < 190) {
          $(this).hide(); // Hide the readmore button
        } else {
          $(this).show(); // Show the readmore button if condition is not met
        }
      });
    });






});

