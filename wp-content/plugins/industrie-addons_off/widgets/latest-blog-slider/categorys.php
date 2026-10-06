<?php 
$category = get_the_category(get_the_ID());
foreach($category as $cat) { 
?>
<a href="<?php echo esc_url( get_category_link($cat->term_id) ); ?>">
    <?php echo esc_html($cat->name);?>
</a>
<?php } ?>