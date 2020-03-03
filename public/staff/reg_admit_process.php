<?php

if(is_post_request()) {
  
}
else {
  redirect_to(url_for('staff/registration.php'));
}

?>
