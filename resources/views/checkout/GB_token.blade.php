@php
    $public_key =  env('GB_publicKey');
@endphp
<form name="form" action="{{ env('GB_url') }}/v1/tokens/3d_secured" method="POST">
    <input type="hidden" name="publicKey" value="<?php echo $public_key; ?>" /><br>
    <input type="hidden" name="gbpReferenceNo" value="<?php echo $Charge['gbpReferenceNo']; ?>" />
</form>
<script>
  window.onload=function(){
    document.forms["form"].submit();
  }
</script>