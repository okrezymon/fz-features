<?php
/**
 * @param array  $attributes - atrybuty zapisane w edytorze
 * @param string $content    - zawartość InnerBlocks
 */

$title   = $attributes['title'] ?? '';
$content = $content ?? '';

/*
 * Replacing h3 and p elements from post editor so we can use proper html semantics,
 * while still using core gutneberg blocks in editor. There could also be used custom faq items blocks
 * but for purpose of this task I decided to use core blocks that are already in wp.
*/
$content = str_replace(
	['<h3', '</h3>', '<p>', '</p>'],
	['<dt', '</dt>', '<dd>', '</dd>'],
	$content
);
?>
<div class="fz-faq-block js-faq-block">
	<?php if ( ! empty( $title ) ) : ?>
		<h2 class="fz-faq-block__title">
			<?php echo esc_html( $title ); ?>
		</h2>
	<?php endif; ?>

	<dl class="fz-faq-block__list">
		<?php echo $content ?>
	</dl>
</div>

