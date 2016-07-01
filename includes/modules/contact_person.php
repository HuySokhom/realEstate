<?php
$new_customer_query = tep_db_query("
    select
      user_name,
      photo_thumbnail,
      detail,
      customers_address,
      customers_telephone
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
                <div class="agent-img"><img src="images/single-property/agent.jpg" alt="agent" /></div>
                <div class="agent-name">
                    <h5>agent John Doe</h5>
                    <ul>
                        <li><a href="property-detail-2.html#" title="twitter"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="property-detail-2.html#" title="facebook"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="property-detail-2.html#" title="google-plus"><i class="fa fa-google-plus"></i></a></li>
                    </ul>
                </div>
                <p>Our Latest listed properties and check out the facilities on them test listed properties.</p>
                <p>Our Latest listed properties and check out the facilities on them test listed properties.</p>
            </div>
        </div>
        <div class="col-md-8 agent-information p_z">
            <div class="agent-info">
                <p><i class="fa fa-phone"></i>0123 456 7890</p>
                <p>
                    <i class="fa fa-envelope-o"></i>
                    <a href="mailto:info@johndoe.com" title="mail">info@johndoe.com</a>
                </p>
                <p><i class="fa fa-fax"></i>041-789-4561</p>
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