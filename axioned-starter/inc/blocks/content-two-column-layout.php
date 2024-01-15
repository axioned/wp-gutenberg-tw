<?php
/**
 * Block Name: Two Column Layout
 *
 * This is the template that displays the Two Column Layout block.
 */

// get image field (array)
$content = get_field('content');
$image = get_field('image');
$image_position = get_field('image_position');
$backgroung_color = get_field('backgroung_color');
$heading_tag = get_field('heading_tag');
$heading = get_field('heading');
$cta = get_field('cta');

// create id attribute for specific styling
$id = 'two-column-layout-' . $block['id'];

// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';

?>
<section class="my-28">
    <div class="wrapper flex flex-col rounded-md overflow-hidden shadow-lg bg-[#E8ECE9] <?php echo $image_position ? "md:flex-row-reverse" : "md:flex-row" ?>" style="background: <?php echo $backgroung_color ? $backgroung_color : '#E8ECE9'; ?>">
        <figure class="max-h-[252px] md:max-h-[425px] w-full md:w-1/2 overflow-hidden">
            <img class="h-full w-full object-cover" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
        </figure>
        <div class="p-6 w-full md:w-1/2">
            <?php if($heading) { ?>
                <?php echo create_html_tag($heading_tag, array('class' => 'text-3xl lg:text-5xl mb-5'), $heading) ?>
            <?php } ?>
            <?php if($content) { ?>
                <div class="text-lg mb-5">
                    <?php echo $content; ?>
                </div>
            <?php } ?>
            <?php if($cta) { ?>
                <div>
                    <a class="btn" href="<?php echo $cta['url'] ?>"><?php echo $cta['title']; ?></a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
