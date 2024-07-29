var hideElements2 = function(){
  $('#twitter div').each(function(i){
        if(i > 13){
            $(this).slideToggle(200);
        }
    });
};

hideElements2();
var toggleStatusTW = true;
$('#toggle-collapse-tw').click(function(){
  var $this = $(this);
    $this.toggleClass('bt2');
    if(toggleStatusTW){
    $('#twitter .list-group-item table-content:not(:visible)').slideToggle(200);
    $this.text('Eμφάνιση παλαιότερων ειδοποιήσεων');
    } else {
      $this.text('Απόκρυψη παλαιότερων ειδοποιήσεων');
      hideElements2();
    }
    toggleStatusTW = !toggleStatusTW;
});
