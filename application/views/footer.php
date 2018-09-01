<script type="text/javascript" src=<?php echo $assets['bootstrap_js']; ?>></script>
<script type="text/javascript">
$(function(){
  
  $(document).on('click','button#print',function(){
    window.print();
  });
  $(document).on('click','button#approve',function(){
    var id=$("#id").val();
    var name=$("#name").val();
    var _url=$("#url").val();
    var loan_id=$("#loan_id").val();
    $.ajax({
      url: _url,
      type:"POST",
      data:"status=Approved&loan_id="+loan_id,
      success: function(e){
        window.parent.location.href='http://localhost/project/index.php/loan/approve_loan_success/'+id+'/'+name;
      },
      error: function (e){
        window.parent.location.href='http://localhost/project/index.php/loan/approve_loan_fail/'+id+'/'+name;
      }
    });
  });
  $(document).on('click','button#reject',function(){
    var id=$("#id").val();
    var name=$("#name").val();
    var _url=$("#url").val();
    var loan_id=$("#loan_id").val();
    $.ajax({
      url: _url,
      type:"POST",
      data:"status=Rejected&loan_id="+loan_id,
      success: function(e){
        window.parent.location.href='http://localhost/project/index.php/loan/approve_loan_success/'+id+'/'+name;
      },
      error: function (e){
        window.parent.location.href='http://localhost/project/index.php/loan/approve_loan_fail/'+id+'/'+name;
      }
    });
  });

});
</script>
</body>
</html>
