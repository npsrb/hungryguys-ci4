   <?php
    $session = session();
    $errors = $session->getFlashdata('errors');
    $success = $session->getFlashData('success');
    ?>

   <div class="position-absolute w-100 p-5">
       <?php if ($errors != null) : ?>
           <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 0 !important;">
               <?php echo $errors  ?>
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>
       <?php endif ?>
       <?php if ($success != null) :  ?>
           <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 0 !important;">
               <?php echo $success  ?>
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>
       <?php endif  ?>
   </div>