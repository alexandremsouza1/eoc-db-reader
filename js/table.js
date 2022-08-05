jQuery(document).ready(function($) {  
    
  var $table = $('#table')

  $(function() {
    $table.bootstrapTable()

    $('.toolbar input').change(function () {
      var paginationParts = []
      $('.toolbar input:checked').map(function () {
        paginationParts.push($(this).next().text())
      })

      $table.bootstrapTable('refreshOptions', {
        paginationParts: paginationParts
      })
    })
  })

  function myAjax() {
    $.ajax({
         type: "POST",
         url: 'your_url/ajax.php',
         data:{action:'call_this'},
         success:function(html) {
           alert(html);
         }

    });
  }
});
