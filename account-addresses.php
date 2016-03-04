<?php
include_once("settings.php");
include_once("include/frontend_functions.php");
include_once("include/login_functions.php");
include_once("include/geocode_functions.php");
include("include/session.php");

/*
 * DEFAULT VALUES FOR USER (ADDRESS, PAYMENT, etc.)
 */
$addresses = $db->get_delivery_addresses_by_user_id($_SESSION['js_user_id']);
?>

<?php include_once("html-head.php");?>
<body>

<?php include_once("header.php"); ?>

<div class="wrapper">
  <div id="main">
    <h1 class="offscreen">My Addresses</h1>

    <div class="box box-extra-thin">
      <?php side_welcome();
      side_nav(); ?>
    </div>

    <div class="box box-standard">
      <?php if(isset($_SESSION['js_action']) && $_SESSION['js_action']=='addupdate'){ ?>
        <div class="success">Your address has been updated.</div>
        <?php unset($_SESSION['js_action']);
      }
      if(isset($_SESSION['js_action']) && $_SESSION['js_action']=='addsave'){ ?>
        <div class="success">Your address has been added.</div>
        <?php unset($_SESSION['js_action']);
      }
      if(isset($_SESSION['js_action']) && $_SESSION['js_action']=='addremove'){ ?>
        <div class="success">Your address has been deleted.</div>
        <?php unset($_SESSION['js_action']);
      }
      if(isset($_SESSION['js_action']) && $_SESSION['js_action']=='addremoveerror'){ ?>
        <div class="error">There was an error deleting your address.  Please try again.</div>
        <?php unset($_SESSION['js_action']);
      }
      if(isset($_SESSION['js_action']) && $_SESSION['js_action']=='addediterror'){ ?>
        <div class="error">There was an error editing your address.  Please try again.</div>
        <?php unset($_SESSION['js_action']);
      }
      if(isset($_SESSION['js_action']) && $_SESSION['js_action']=='addexists'){ ?>
        <div class="error">This address already exists for your account. Please edit it below.</div>
        <?php unset($_SESSION['js_action']);
      } ?>



      <?php foreach($addresses as $a){

        if ($a['type'] == 'D') {?>
          <div class="address_box" id="address_box_<?php echo $a['id'];?>">

            <div class="addressInfo<?php echo $infoBoxClass; ?>">
              <?php show_row($a['address_name'], '<h2>', '</h2>');?>
              <p>
                <?php show_row($a['company'], '', '<br />');?>
                <?php show_row($a['address_1']);?>
                <?php show_row($a['address_2'], '', '', true);?>
                <?php show_row($a['address_3'], '', '', true);?>
                <?php show_row($a['city'], '', ',', true);?>
                <?php show_row($a['abbreviation'], ' ');?>
                <?php show_row($a['zip'], ' ');?>
              </p>

              <?php if($a['default']==1){?>
                <p><b>Default Address</b></p>
              <?php };?>
              <?php show_row(htmlspecialchars_decode($a['comments']), '<p class="delivery_info">', '</p>');?>
            </div>


            <form name="edit-address-form" id="edit-address-form" class="button-form edit-form" action="" method="POST">
              <div class="buttons edit_button" id="<?= $a['id'];?>">
                <button class="edit button" type="submit" >
                  Edit
                </button>
              </div>
            </form>

            <form name="delete-address-form" id="delete-address-form" class="button-form delete-form" action="<?php echo BASE_URL; ?>deleter.php" method="POST">
              <div class="buttons delete_button">
                <input type="hidden" name="del_id" id="del_id" value="<?php echo $a['id'];?>"/>
                <button type="submit" name="action" value="delete address">
                  Delete
                </button>
              </div>
            </form>
          </div>
        <?php } ?>
      <?php } ?>

        <a class="form-link add_address" href="#">+ add another address</a>
    <!---->
    </div>
  </div>
</div>

<?php include_once("footer.php"); ?>

</body>
</html>