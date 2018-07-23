
$(window).load(function() {
  $('.carousel').carousel({
      interval: 3000
    });
});

$(window).ready(function() {
  $('#project-categories a').click(function(e) {
    e.preventDefault();
    var a = $(e.target);
    if(a.hasClass('active')) {
      $('#project-categories a').removeClass('active');
      $('#projects .pic').addClass('active');
    }
    else {
      $('#project-categories a').removeClass('active');
      a.addClass('active');
      var category = a.data('id');
      $('#projects .pic-' + category).addClass('active');
      $('#projects .pic:not(.pic-' + category + ')').removeClass('active');
    }
    $('#projects').toggleClass('filtered', a.hasClass('active'));
  });
});
