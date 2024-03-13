<?php session_start(); ?>
<?php
    if (isset($_SESSION["type"])) {
        if ($_SESSION["type"] == "admin") {
            header( "Location: dashboard_admin.php");
        }
        if ($_SESSION["type"] == "entreprise") {
            header( "Location: dashboard_business.php");
        }
        if ($_SESSION["type"] == "utilisateur") {
            header( "Location: dashboard_pnj.php");
        }
        if ($_SESSION["type"] == "ecole") {
            header( "Location: dashboard_school.php");
        }


}
?>