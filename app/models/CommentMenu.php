 <?php

/*
	菜品的评论
	表结构：(id, shop_id, user_id, order_id, value, content, time)
 */
class CommentMenu extends Eloquent{

	public $timestamps = false;

	protected $table = 'comment_for_menu';

}