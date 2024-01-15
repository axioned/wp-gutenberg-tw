<?php
/**
 * Block Name: Image Grid
 *
 * This is the template that displays the Image Grid block.
 */


// create id attribute for specific styling
$id = 'image-grid-' . $block['id'];

// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';

?>
<?php if(have_rows('image_grid')) { ?>
  <div>
    <div class="wrapper">
    <?php get_template_part('template-parts/global/content', 'sec-heading', array("classname" => 'bg-red-400')); ?>
      <ul class="font-sans py-3 flex flex-wrap gap-[3%]">
        <?php while( have_rows('image_grid') ) { ?>
          <?php 
            the_row();
    
            $heading = get_sub_field('heading');
            $description = get_sub_field('description');
            $image = get_sub_field('image');
          ?>
          <li class="shadow-sm relative basis-full sm:basis-[48%] lg:basis-[31.33%] overflow-hidden group cursor-pointer mb-[3%]">
            <figure class="h-[300px] rounded-xl overflow-hidden relative">
              <img src="<?php echo $image['url']; ?> " class="h-full w-full object-cover" alt="">
              <figcaption class="z-10 text-base lg:text-xl cursor-pointer absolute px-4 py-2 rounded-xl left-5 bottom-5 bg-slate-50 max-w-[200px] lg:max-w-[350px]"><?php echo $heading ?></figcaption>
            </figure>
            <p class="static lg:absolute w-full lg:h-full bg-slate-50 lg:bg-black lg:bg-opacity-25 lg:top-0 lg:left-0 p-4 text-black lg:text-white lg:translate-y-full rounded-b-lg lg:rounded-xl md:group-hover:translate-y-0 transition-all ease-in-out duration-700"><?php echo $description; ?></p>
          </li>
          <?php } ?>
      </ul>
    </div>
  </div>
<?php } ?>
