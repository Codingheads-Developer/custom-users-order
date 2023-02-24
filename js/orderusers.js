function myuserorderaddloadevent() {
    jQuery("#UserOrderList").sortable({
        placeholder: "sortable-placeholder",
        revert: false,
        tolerance: "pointer"
    });
};
addLoadEvent(myuserorderaddloadevent);

/**** Function for save User Order on update - Page 2 ****/
jQuery(document).ready(function () {
    var order_users = "";
    var order_users_roles = "";
    jQuery('#frmCustomUser').submit(function (e) {

        e.preventDefault();
        e.stopPropagation();

        /* Get User IDs and Insert in Hidden Fields */
        jQuery("#UserOrderList li").each(function (index) {
            order_users = order_users + "," + jQuery(this).attr('id');
        });
        order_users = order_users.substring(1, order_users.length);

        jQuery('input[name=usersid]').val(order_users).val();

        e.currentTarget.submit();
    });
});
