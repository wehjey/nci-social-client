<?php 

use Carbon\Carbon;

/**
 * Format date
 */
function formatDate($date, $newFormat = 'd M, Y', $currentFormat = 'Y-m-d')
{
    return Carbon::createFromFormat($currentFormat, $date)->format($newFormat);
}

/**
 * Get page number
 *
 * @return int
 */
function getPage()
{
    $page = 1;

    // Check if per_page exists in query and ensure its an integer
    if (request()->exists('page')) {
        $page = (int) request('page');
    }

    return $page;
}

/**
 * Get page count
 *
 * @param [int] $per_page
 * @param [int] $total_items
 * @return int
 */
function getPageCount($per_page, $total_items)
{
  return ceil($total_items/$per_page);
}

function getAuthor($topic)
{
  $user = $topic['user'];
  return ucwords($user['firstname'] . ' '. $user['lastname']);
}

function getAuthorImage($topic)
{
  $user = $topic['user'];
  if ($user['profile_url']) {
      return $user['profile_url'];
  }
  return 'https://via.placeholder.com/100';

}

function getTotalComments($topic)
{
  return $topic['comments_count'];
}

/**
 * Return thumbnail image for product
 *
 * @param [type] $product
 * @return string
 */
function getImage($product)
{
  if(count($product['images']) > 0) {
    return $product['images'][0]['image_url'];
  } 
  return 'https://via.placeholder.com/100';
}