var hideElements1 = function(){
  $('#facebook div').each(function(i){
        if(i > 13){
            $(this).slideToggle(200);
        }
    });
};

hideElements1();
var toggleStatusFB = true;
$('#toggle-collapse-fb').click(function(){
    var $this = $(this);
    $this.toggleClass('bt1');
    if(toggleStatusFB){
    $('#facebook .list-group-item table-content:not(:visible)').slideToggle(200);
      $this.text('Show older notifications');
    } else {
      $this.text('Hide older notifications');
      hideElements1();
    }
    toggleStatusFB = !toggleStatusFB;
});
