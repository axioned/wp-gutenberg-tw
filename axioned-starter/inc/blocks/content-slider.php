<?php
/**
 * Block Name: Slider
 *
 * This is the template that displays the Slider block.
 */

// get image field (array)
$heading = get_field('heading');

// create id attribute for specific styling
$id = 'slider-' . $block['id'];

// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';

?>
<?php if(have_rows('slider')) { ?>
  <div>
    <div class="wrapper">
    <?php get_template_part('template-parts/global/content', 'sec-heading'); ?>
      <div class="font-sans py-3 slider-image flex flex-wrap">
        <?php while( have_rows('slider') ) { ?>
          <?php 
            the_row();

            $image = get_sub_field('image');
          ?>
          <div class="shadow-sm relative basis-full sm:basis-[48%] lg:basis-[31.33%] overflow-hidden group cursor-pointer mb-[3%] h-[300px]">
            <img class="h-full object-cover w-full" srcset="<?php echo $image['url'] ?>" alt="Flowers">
          </div>
          <?php } ?>
      </div>
    <?php } ?>
  </div>     
</div>
