<div id="myModal" class="modal modal-lg" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="color:#634927">DATA BARANG</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php include("pages/web/viewbarang.php"); ?>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

// Get the modal
var modal = document.getElementById("myModal");kodeobat

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

modal.style.display = "none";

document.getElementById("kodeobat").readonly = true;



// When the user clicks the button, open the modal
kodeobat.onclick = function() {
  modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
}

</script>
