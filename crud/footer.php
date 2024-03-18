<style>
  #fot{  
      background: linear-gradient(55deg, rgba(27,94,32,1) 23%, rgba(215,215,215,1) 23%, rgba(254,254,254,1) 100%);
    }
    footer {
      padding: 30px;
    }
    .footer-content {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 0px;
    }
</style>
<footer id="fot" style="margin-bottom: 0px;">
  <div class="container">
    <div class="row footer-content">
      <div style="margin-left:6rem" class="col s6">
        <span class="black-text ">Instituto Federal Farroupilha <br> Campus Avançado Uruguaiana <br><?PHP echo date('d/m/y')  ?>
      </div>
      <div class="col s6">
        <div class="right-align">
          <p class="black-text">Contato:</p>
          <hr>
          <a href="https://instagram.com/terceiraoinfo31?igshid=NTc4MTIwNjQ2YQ=="><img src="../img/instagram.png" height="30" alt=""> </a>
          <a href="https://www.iffarroupilha.edu.br/uruguaiana"> <img src="../img/iff.png" height="40" alt=""> </a>
        </div>
      </div>
    </div>
  </div>
</footer>
<script>
  $(document).ready(function() {
    $('.sidenav').sidenav();
  });
</script>
</body>
<!-- <script src="../js/java.js"></script> -->
</body>

</html>