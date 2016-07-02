<?php
$new_customer_query = tep_db_query("
    select
      user_name,
      photo_thumbnail,
      detail,
      customers_address,
      customers_telephone,
      customers_email_address,
      customers_fax
    from
        " . TABLE_CUSTOMERS . "
    where
        customers_id = '" . (int)$product_info['customers_id'] . "'
    "
);
$num_customer = tep_db_num_rows($new_customer_query);

if ($num_customer > 0) {
    $user = tep_db_fetch_array($new_customer_query);
?>
    <div class="property-direction pull-left">
        <h3>contact Agency</h3>
        <div class="agent-information p_z">
            <div class="agent-info">
                <p>
                    <i class="fa fa-user"></i>
                    <?php echo $user['user_name'];?>
                </p>
                <p><i class="fa fa-phone"></i><?php echo $user['customers_telephone'];?></p>
                <p>
                    <i class="fa fa-envelope-o"></i>
                    <a href="mailto:<?php echo $user['customers_email_address'];?>" title="mail"><?php echo $user['customers_email_address'];?></a>
                </p>
                <?php
                    if($user['customers_fax'] != ''){
                        echo '<p><i class="fa fa-fax"></i>' . $user['customers_fax'] . '</p>';
                    }
                ?>
            </div>
            <div class="agent-form">
                <h3>Make an Enquiry</h3>
                <form name="make_enquiry">
                    <div class="col-md-6 p_l_z">
                        <input type="text" placeholder="* Your Name" required/>
                    </div>
                    <div class="col-md-6 p_r_z">
                        <input type="text" placeholder="* Your Email ID" />
                    </div>
                    <textarea required placeholder="* Message" class="enquiry" rows="5"></textarea>
                    <input type="submit" value="Submit" class="btn">
                </form>
            </div>
        </div>
    </div>
<?php
    }
?>