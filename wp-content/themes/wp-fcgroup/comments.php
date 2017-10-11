<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area wow fadeIn">
	<?php if ( have_comments() ) : ?>
		<div class="comments-area-inner">
			<h2 class="comments-title">
				<?php esc_html_e('Comment\'s', 'wp-fcgroup'); ?>
			</h2>

			<?php wp_fcgroup_comment_nav(); ?>

			<ol class="comment-list">
				<?php wp_list_comments('type=comment&callback=wp_fcgroup_comment'); ?>
			</ol><!-- .comment-list -->

			<?php wp_fcgroup_comment_nav(); ?>

			<?php
			// If comments are closed and there are comments, let's leave a little note, shall we?
			if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
				?>
				<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'wp-fcgroup' ); ?></p>
			<?php endif; ?>
		</div>
	<?php endif; // have_comments() ?>
</div><!-- .comments-area -->

<div class="comment-form-wrap <?php echo (have_comments()) ? 'post-has-comment' : ''; ?>">
	<?php
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name__mail' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$args = array(
			'id_form'           => 'commentform',
			'id_submit'         => 'submit',
			'title_reply'       => esc_html__( 'Add Comment', 'wp-fcgroup'),
			'title_reply_to'    => esc_html__( 'Leave A Comment','wp-fcgroup'),
			'cancel_reply_link' => esc_html__( 'Cancel Reply','wp-fcgroup'),
			'label_submit'      => esc_html__( 'SUBMIT COMMENT','wp-fcgroup'),
			'comment_notes_before' => '',
			'comment_notes_after' => '',
			'fields' => apply_filters( 'comment_form_default_fields', array(

					'author' =>
					'<div class="col-md-6 mb-20">'.
					'<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
					'" size="30"' . $aria_req . ' placeholder="'.esc_html__('Enter your name...', 'wp-fcgroup').'"/></div>',

					'email' =>
					'<div class="col-md-6 mb-20">'.
					'<input id="email" class="form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
					'" size="30"' . $aria_req . ' placeholder="'.esc_html__('Enter your email...', 'wp-fcgroup').'"/></div>',
			)
			),
			'comment_field' =>  '<div class="col-md-12"><textarea id="comment" class="form-control" name="comment" cols="45" rows="4" placeholder="'.esc_html__('Enter your message here...','wp-fcgroup').'" aria-required="true"></textarea></div>',
		);
		comment_form($args);
	?>
</div>