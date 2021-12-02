<!-- Footer -->
<footer class="text-center text-lg-start bg-light text-muted">
  <!-- Section: Social media -->
  <section
    class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom"
  >
    <!-- Right -->
    <div>
      <a href="https://github.com/charlesTech8/projet1_Question.git" class="me-4 text-reset">
        <i class="bi bi-github"></i>
      </a>
    </div>
    <!-- Right -->
  </section>
  <!-- Section: Social media -->

  <section class="container">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-sm-4 mx-auto mb-4">
          <!-- Content -->
          <h3 class="text-uppercase fw-bold mb-4">
           Qui sommes-nous?
          </h3>
          <p >
            <!--texte de presentation-->
            We can est une plateforme d'echange conçu pour des étudiants et par des étudiants en informatique. Son but est de créer un large reseau de professionnels de l'IT au Benin et dans la sous-region, ou les utilisateurs pourront partager leurs experiences, preoccupations, et opportunites.
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-ms-2 mx-auto mb-4">
          <!-- Links -->
          <h3 class="text-uppercase fw-bold mb-4">
            PAGES
          </h3>
          <p>
            <a href="../controler/index.php?pg=<?php echo md5('accueil') ?>" class="text-reset">Acceuil</a>
          </p>
          <p>
            <a href="../controler/index.php?pg=<?php echo md5('question') ?>" class="text-reset">Questions</a>
          </p>
          <p>
            <a href="../controler/index.php?pg=<?= md5('askform'); ?>" class="text-reset">Poser une question</a>
          </p>
          <p>
            <a href="../controler/index.php?pg=<?php echo md5('contactus') ?>" class="text-reset">Contacts</a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-ms-2 mx-auto mb-4">
          <!-- Links -->
          </p>
          
          
          <p>
          <i class="bi bi-envelope me-3"></i>
            <a href="mailto:gboyoucharles5@gmail.com">NOUS ECRIRE</a>
          </p>
          <p><i class="bi bi-home me-3"></i> BENIN/COTONOU </p>
          <p>
            <h5 class="text-center" style="text-decoration: underline;">Site</h5>
            <a href="https://theinfobenin.000webhostapp.com/controllers/index.php?pg=cours" class="text-reset">Bi-Etudiant</a>
            <br>Retrouver des documents <br> et épreuves pour étudiant.
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
  Copyright © 2021 WE CAN
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->
