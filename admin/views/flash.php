<div id="Alert" class="alert alert-<?php echo $color;?>" role="alert">
  <?php echo $msg; ?>
</div>

<script>
  var alertElement = document.getElementById('Alert');
  function removeAlert() {
    alertElement.remove();
  }
  setTimeout(removeAlert, 2000);
</script>