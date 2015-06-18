<?php if ($args['id'] == 'slider-area') : ?>
<?php echo $before_widget; ?>
<?php echo $before_title . '<i class="fa fa-picture-o"></i> ' . (($instance['title']) ? $instance['title'] : 'Bildspel') . $after_title; ?>
<div class="box-content">
    <ul class="orbit-slider" data-orbit data-options="animation:fade; timer_speed:10000; slide_number:false;">
        <?php
            foreach ($items as $num => $item) :
                $force_width  = (!empty($item_force_widths[$num])) ? 'width:100%;' : '';
                $force_margin = (!empty($item_force_margins[$num]) && !empty($item_force_margin_values[$num])) ? ' margin-top:-' . $item_force_margin_values[$num] . 'px;' : '';
        ?>
        <li style="background-image:url('<?php echo $item_imageurl[$num]; ?>');">
            <?php if (!empty($item_texts[$num]) && !empty($item_links[$num])) : ?>
            <div class="caption">
                <div class="caption-content">
                    <div class="row">
                        <div class="columns large-12">
                            <?php
                                if (!empty($item_texts[$num])) {
                                    echo $item_texts[$num];
                                }

                                if (!empty($item_links[$num])) :
                            ?>
                                <a href="<?php echo $item_links[$num]; ?>" class="read-more">Läs mer</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
<?php echo $after_widget; ?>
<?php else : ?>
<?php echo $before_widget; ?>
    <ul class="orbit-slider" data-orbit data-options="animation:fade; timer_speed:10000; slide_number:false;">

        <?php
            foreach ($items as $num => $item) :
                $force_width  = (!empty($item_force_widths[$num])) ? 'width:100%;' : '';
                $force_margin = (!empty($item_force_margins[$num]) && !empty($item_force_margin_values[$num])) ? ' margin-top:-' . $item_force_margin_values[$num] . 'px;' : '';
        ?>
        <li style="background-image:url('<?php echo $item_imageurl[$num]; ?>');">
            <?php if (!empty($item_texts[$num]) && !empty($item_links[$num])) : ?>
            <div class="caption">
                <div class="caption-content">
                    <div class="row">
                        <div class="columns large-12">
                            <?php
                                if (!empty($item_texts[$num])) {
                                    echo $item_texts[$num];
                                }

                                if (!empty($item_links[$num])) :
                            ?>
                                <a href="<?php echo $item_links[$num]; ?>" class="read-more">Läs mer</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        </li>
        <?php endforeach; ?>

    </ul>
<?php echo $after_widget; ?>
<?php endif; ?>