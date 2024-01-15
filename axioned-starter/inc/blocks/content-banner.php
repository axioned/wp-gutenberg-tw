<?php
/**
 * Block Name: Banner
 *
 * This is the template that displays the Banner block.
 */

$banner_heading = get_field('banner_heading');
$desktop_image = get_field('desktop_image');
$mobile_image = get_field('mobile_image');

// create id attribute for specific styling
$id = 'banner-' . $block['id'];

// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';

?>
<div class="relative overlay-black">
  <h2 class="absolute top-1/2 left-10 -translate-y-1/2 text-2xl sm:text-4xl md:text-7xl text-white z-10"><?php echo $banner_heading; ?></h2>
  <figure class="w-full max-h-[600px] overflow-hidden">
    <picture>
      <source media="(max-width:650px)" srcset="<?php echo $mobile_image['url'] ?>">
      <img class="h-full object-cover" srcset="<?php echo $desktop_image['url'] ?>" alt="Flowers" style="width:auto;">
    </picture>
  </figure>
</div>
