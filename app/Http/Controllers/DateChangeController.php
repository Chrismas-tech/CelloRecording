<?php

namespace App\Http\Controllers;

use App\Models\Order;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;

class DateChangeController extends Controller
{
    public static function date_created_at_to_string($date_created_at)
    {
        $date = new DateTime($date_created_at);
        $date_created_at = date_format($date, 'g:ia \o\n l jS F Y');
        return $date_created_at;
    }

    public static function date_due_on_buyer($date_created_at, $nb_days)
    {

        $date_delivery = new DateTime($date_created_at);
        $date_delivery = date_add($date_delivery, date_interval_create_from_date_string($nb_days . ' days'));
        $date_delivery_formated = date_format($date_delivery, ' l jS F Y');

        return  $date_delivery_formated;
    }


    public static function date_minuteur(Request $request)
    {
        /*Créer un compteur de temps pour la livraison*/
        /*Step 1 - On formatte les deux dates en Y-m-d */
        /*Step 2 - On fait la différence pour avoir un interval de temps en secondes */

        if ($request->ajax()) {

            $date_created_at = $request->get('order_created_at');
            $nb_days = $request->get('nb_days');

            $date_delivery = new DateTime($date_created_at);
            $date_delivery = date_add($date_delivery, date_interval_create_from_date_string($nb_days . ' days'));
            $date_delivery_formated = date_format($date_delivery, "Y-m-d H:i:s");

            $currentDateTime = date('Y-m-d H:i:s');

            $diff_seconds = strtotime($date_delivery_formated) - strtotime($currentDateTime);

            /*Conversion secondes en jours, heures, minutes, secondes*/
            /*Conversion secondes en jours, heures, minutes, secondes*/
            /*Conversion secondes en jours, heures, minutes, secondes*/
            /*Conversion secondes en jours, heures, minutes, secondes*/
            /*Conversion secondes en jours, heures, minutes, secondes*/

            /*Nombre de minutes exactes dans $diff_seconds*/
            $min_total = floor($diff_seconds / 60);

            /*secondes au compteur*/
            $seconds = $diff_seconds - (60 * $min_total);

            /*Nombre d'heures exactes dans $diff_seconds*/
            $hours_total = floor($min_total / 60);

            /*minutes au compteur*/
            $min = $min_total - (60 * $hours_total);

            /*Nombre de jours exacts dans $diff_seconds*/
            $days = floor($hours_total / 24);

            /*heures au compteur*/
            $hours = $hours_total - (24 * $days);

            $result = [$days, $hours, $min, $seconds];

            return  $result;
        }
    }

    public static function date_delivered_on($date_created_at)
    {
        $date = new DateTime($date_created_at);
        $date_created_at = date_format($date, 'l jS F Y');
        return $date_created_at;
    }
}
