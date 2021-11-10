<!-- Footer -->
<footer class="text-center text-lg-start bg-light text-muted">
  <!-- Section: Social media -->
  <section
    class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom"
  >
    <!-- Right -->
    <div>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-google"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-instagram"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-linkedin"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-github"></i>
      </a>
    </div>
    <!-- Right -->
  </section>
  <!-- Section: Social media -->

  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-sm-4 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4">
            <i class="fas fa-gem me-3"></i>Bi-Etudiant
          </h6>
          <p>
            Nous vous donnons la possibilité de retrouver vos documents et épreuves sans problème.<br>
            De plus vous avez la possibilité de discuter avec vos amis <?php if(!isset( $_SESSION['id'] ) ) echo 'sur <strong><a href="index.php?pg=presentation">EliChat</a></strong>'; ?> à partir d'ici.<br>
            Merci pour la confiance :)
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-ms-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            PAGE
          </h6>
          <p>
            <a href="index.php?pg=cours" class="text-reset">Cours</a>
          </p>
          <p>
            <a href="index.php?pg=epreuve" class="text-reset">Epreuve</a>
          </p>
          <p>
            <a href="index.php?pg=presentation" class="text-reset">Profile</a>
          </p>
          <p>
            <a href="index.php?pg=liste_msg" class="text-reset">Discussion</a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-ms-2 mx-auto mb-4">
          <!-- Links -->
          </p>
          <p>
            <a href="index.php?pg=contactme" class="text-reset">Contact</a>
          </p>
          <p>
            <a href="index.php?pg=aboutme" class="text-reset">About</a>
          </p>
          <p><i class="fas fa-home me-3"></i> BENIN/COTONOU </p>
          <p>
            <i class="fas fa-envelope me-3"></i>
            <a href="mailto:gboyoucharles5@gmail.com">Ecrire au programmeur</a>
          </p>
        </div>
        <!-- Grid column -->

      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
  Copyright © 2021
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->
