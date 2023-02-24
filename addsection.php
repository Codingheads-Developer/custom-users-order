<?php
function addsection()
{
    /**** Condition to update User Role ****/
    if (isset($_REQUEST['usersid'])) {
        $usersid = $_REQUEST['usersid'];
        data_insert($usersid);
    }

    echo users_table();
}


function data_insert($data_sent)
{

    $user_ids = explode(',', $data_sent);

    if ($user_ids)
        foreach ($user_ids as $k => $user_id) {

            update_user_meta($user_id, 'order', $k);
        }

}


function users_table()
{

    $ulist = '<h2>User Listing</h2>';

    /* Form 2 (Drag And Drop Form) */
    $ulist .= '<form name="frmCustomUser" id="frmCustomUser" method="post" action="?page=addsection">
	<ul class="usersheading">';
    $ulist .= '<li class="lineitem"><span>Username</span><span>Name</span></li>';
    $ulist .= '</ul>';
    $ulist .= '<ul id="UserOrderList">';


    $user_fields = ['ID', 'user_login', 'user_nicename', 'user_email', 'user_url'];
    $args = [
        'fields' => $user_fields,
        'limit' => 9999,
        'orderby' => 'meta_value',
        'order' => 'ASC',
        'subpress_filters' => true,

        'meta_query' => [
            'relation' => 'OR',
            [
                'key' => 'order',
                'compare' => 'IN',
            ],
            [
                'key' => 'order',
                'compare' => 'NOT EXISTS',
            ]
        ]
    ];
    $current_list_users = new WP_User_Query($args);

    if (!empty($current_list_users->get_results())) {
        foreach ($current_list_users->get_results() as $k => $user) {

            $u = get_userdata($user->ID);

            $ulist .= "<li value='" . $user->ID . "' id='" . $user->ID . "' class='lineitem'><span>" . $user->user_nicename . "</span><span>" . $u->first_name . ' ' . $u->last_name . "</span></li>";
        }
    }

    $ulist .= '</ul>

	    <input type="hidden" name="usersid" />
    	<input type="submit" name="send" value="Update" id="send" class="button-primary" />
	</form>';
    $ulist .= "<p><b>Note: </b> Simply drag and drop the users into the desired position and update.</p>";

    return $ulist;
}
