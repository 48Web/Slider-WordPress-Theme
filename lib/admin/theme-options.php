<?php
    $themename = "Slider";
$shortname = "sld";

/* setup option vars */
$options = array(
    array(
        "name"  => __("Homepage Options"),
        "desc"  => __("Theme Options"),
        "type"  => "title"
    ),
    array("type" => "open"),
    array(
        "name"  => __("Homepage Slider"),
        "desc"  => __("Do you want to show posts or pages on your homepage?"),
        "id"    => $shortname."_homepageShow",
        "options" => array("pages" => "Pages", "posts" => "Posts"),
        "std"   => "pages",
        "type"  => "radio"
    ),
    array("type" => "close")
);

add_action('admin_menu', 'theme_add_admin');

function theme_add_admin() {

    global $themename, $shortname, $options;

    if ($_GET['page'] == basename(__FILE__)) {

        if ('save' == $_REQUEST['action']) {

            foreach ($options as $value) {
                update_option($value['id'], $_REQUEST[$value['id']]);
            }

            foreach ($options as $value) {
                if (isset($_REQUEST[$value['id']])) {
                    update_option($value['id'], $_REQUEST[$value['id']]);
                } else {
                    delete_option($value['id']);
                }
            }

            header("Location: themes.php?page=functions.php&saved=true");
            die;

        } else if ('reset' == $_REQUEST['action']) {

            foreach ($options as $value) {
                delete_option($value['id']);
            }

            header("Location: themes.php?page=functions.php&reset=true");
            die;

        }
    }

    add_theme_page($themename . " Options", "" . $themename . " Options", 'edit_themes', basename(__FILE__), 'theme_admin');

}

function theme_admin() {

    global $themename, $shortname, $options;

    if ($_REQUEST['saved']) echo '<div id="message" class="updated fade"><p><strong>' . $themename . ' settings saved.</strong></p></div>';
    if ($_REQUEST['reset']) echo '<div id="message" class="updated fade"><p><strong>' . $themename . ' settings reset.</strong></p></div>';

    ?>
    <div class="wrap">
        <h2><?php echo $themename; ?> Settings</h2>

        <form method="post">

        <?php foreach ($options as $value) {
            switch ($value['type']) {

                case "open": ?>
                    <table width="100%" border="0" style="background-color:#eef5fb;">
                    <?php break;

                case "close": ?>
                    </table><br/>
                    <?php break;

                case "title": ?>
                    <table width="100%" border="0" style="background-color:#dceefc;">
                        <tr>
                            <td colspan="2"><h3><?php echo $value['name']; ?></h3></td>
                        </tr>

                    <?php break;

                case 'text':
                    ?>

                        <tr>
                            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong>
                            </td>
                            <td width="80%"><input style="width:400px;" name="<?php echo $value['id']; ?>"
                                                   id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>"
                                                   value="<?php if (get_settings($value['id']) != "") {
                                                       echo get_settings($value['id']);
                                                   } else {
                                                       echo $value['std'];
                                                   } ?>"/></td>
                        </tr>

                        <tr>
                            <td>
                                <small><?php echo $value['desc']; ?></small>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>

                    <?php
                        break;

                case 'textarea':
                    ?>

                        <tr>
                            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong>
                            </td>
                            <td width="80%"><textarea name="<?php echo $value['id']; ?>"
                                                      style="width:400px; height:200px;"
                                                      type="<?php echo $value['type']; ?>" cols=""
                                                      rows=""><?php if (get_settings($value['id']) != "") {
                                echo get_settings($value['id']);
                            } else {
                                echo $value['std'];
                            } ?></textarea></td>

                        </tr>

                        <tr>
                            <td>
                                <small><?php echo $value['desc']; ?></small>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>

                    <?php
                        break;

                case 'select':
                    ?>
                        <tr>
                            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong>
                            </td>
                            <td width="80%"><select style="width:240px;" name="<?php echo $value['id']; ?>"
                                                    id="<?php echo $value['id']; ?>"><?php foreach ($value['options'] as $option) { ?>
                                <option<?php if (get_settings($value['id']) == $option) {
                                    echo ' selected="selected"';
                                } elseif ($option == $value['std']) {
                                    echo ' selected="selected"';
                                } ?>><?php echo $option; ?></option><?php } ?></select></td>
                        </tr>

                        <tr>
                            <td>
                                <small><?php echo $value['desc']; ?></small>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>

                    <?php
                        break;

                case "checkbox":
                    ?>
                        <tr>
                            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong>
                            </td>
                            <td width="80%"><?php if (get_option($value['id'])) {
                                $checked = "checked=\"checked\"";
                            } else {
                                $checked = "";
                            } ?>
                                <input type="checkbox" name="<?php echo $value['id']; ?>"
                                       id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <small><?php echo $value['desc']; ?></small>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>

                    <?php break;

                case "radio":
                    create_section_for_radio($value);

            }
        }
        ?>

            <p class="submit">
                <input name="save" type="submit" value="Save changes"/>
                <input type="hidden" name="action" value="save"/>
            </p>
        </form>
        <form method="post">
            <p class="submit">
                <input name="reset" type="submit" value="Reset"/>
                <input type="hidden" name="action" value="reset"/>
            </p>
        </form>

    <?php

}

function create_section_for_radio($value) {
    create_opening_tag($value);
    foreach ($value['options'] as $option_value => $option_text) {
        $checked = ' ';
        if (get_option($value['id']) == $option_value) {
            $checked = ' checked="checked" ';
        }
        else if (get_option($value['id']) === FALSE && $value['std'] == $option_value){
            $checked = ' checked="checked" ';
        }
        else {
            $checked = ' ';
        }
        echo '<tr><td colspan="2"><div class="mnt-radio"><input type="radio" name="'.$value['id'].'" value="'.
            $option_value.'" '.$checked."/>".$option_text."</div></td></tr>\n";
    }
    create_closing_tag();
}

function create_opening_tag($value) {
	$group_class = "";
	if (isset($value['grouping'])) {
		$group_class = "48-grouping-{$value['grouping']} suf-grouping ";
	}
	echo '<div class="'.$group_class.'48-section fix">'."\n";
	if (isset($value['name'])) {
		echo "<h3>" . $value['name'] . "</h3>\n";
	}
	if (isset($value['desc'])) {
		echo $value['desc']."<br/>";
	}
	if (isset($value['note'])) {
		echo "<span class=\"note\">".$value['note']."</span><br/>";
	}
}

function create_closing_tag() {
	echo "</div>\n";
}

?>