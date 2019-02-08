<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/nariman924/movies
 * @since      1.0.0
 *
 * @package    Movies
 * @subpackage Movies/admin/partials
 */
?>

<table>
    <tr>
        <td>Movie Cost</td>
        <td><input type="number" step="0.01" min="0" name="movie_cost" value="<?= $movieCost; ?>"/></td>
    </tr>
    <tr>
        <td>Movie Date</td>
        <td><input type="text" name="movie_date" class="js-date-picker" value="<?= $movieDate ?>"></td>
    </tr>
</table>