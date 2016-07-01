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
    var_dump($user['customers_telephone']);
    var_dump( $user['customers_id'] );
?>
    <div class="property-map contact-agent">
        <h3>Contact Agent</h3>
        <div class="col-md-4 agent-details">
            <div class="agent-header">
                <div class="agent-img"><img src="images/<?php echo $user['photo_thumbnail']; ?>" alt="agent" /></div>
                <div class="agent-name">
                    <h5><?php echo $user['user_name'];?></h5>
                </div>
                <p><?php echo stripslashes($user['detail']);?></p>
            </div>
        </div>
        <div class="col-md-8 agent-information p_z">
            <div class="agent-info">
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
                <h3>Send Instant Message</h3>
                <form>
                    <div class="col-md-6 p_l_z">
                        <input type="text" placeholder="Your Name" />
                    </div>
                    <div class="col-md-6 p_r_z">
                        <input type="text" placeholder="Your Email ID" />
                    </div>
                    <input type="text" placeholder="Message" />
                    <input type="submit" value="Submit" class="btn">
                </form>
            </div>
        </div>
    </div>
<?php
    }
?>