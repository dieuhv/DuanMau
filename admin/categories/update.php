 <?php include '../../model/category.php';
    if (isset($_POST['category-name']) && isset($_GET['id'])) {
        update_category($_POST['category-name'], $_GET['id']);
        header('Location: ./index.php?page=categories');
    }
    ?>
 <div class="products__wrapper">
     <div class="product__title">Categories Management</div>
     <div class="popup__wrapper active__popup">
         <div class="popup__container">
             <div class="popup__container--exits">
                 <a href="./index.php?page=categories"><i class="fa-solid fa-xmark"></i></a>
             </div>
             <div class="popup__title">
                 Update Category
             </div>
             <form action="" method="post">
                 <label for="">
                     Name:
                 </label>
                 <input name="category-name" required type="text" value="<?php echo $item['name'] ?> ">
                 <input name="category-submit" type="submit" value="Update">
             </form>
         </div>
     </div>
 </div>