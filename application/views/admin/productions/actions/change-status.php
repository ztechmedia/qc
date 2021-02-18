<p style="font-weight:bold;">Aksi:</p>
<p>Ubah status slitting: <?=$product?></p>
<button onclick="changeStatusAction('<?=$id?>', 'OK')" class="btn btn-primary">OK</button>
<button onclick="changeStatusAction('<?=$id?>', 'NCR')" class="btn" style="background:blue;color:white;">NCR</button>
<button onclick="changeStatusAction('<?=$id?>', 'HOLD')" class="btn btn-warning">HOLD</button>
<button onclick="changeStatusAction('<?=$id?>', 'NOT')" class="btn btn-danger">NOT</button>