<?php

class PreviewStore
{
	public static $instance = null;
	public $nonce = '';

	public static function getInstance()
	{
		null === self::$instance AND self::$instance = new self;
		return self::$instance;
	}

	public function __construct()
	{
		add_action('save_post', array($this, 'storePreview'));
	}
	
	public function storePreview($post_id)
	{
		if(get_post_type($post_id) != 'download')
		{
			return false;
		}
		if(!empty($_POST['preview_video']))
		{
			$previewVideos = $_POST['preview_video'];
			$previewUrl = $previewVideos[0];
		}
		$previewPaths = explode('/wp-content/uploads', $previewUrl);
		$pathPart = $previewPaths[1];
		$completeVideoPath = wp_upload_dir()['basedir'].$pathPart;
		$filetype = wp_check_filetype(basename($completeVideoPath), null);
		$attachment = array(
				'post_mime_type' => $filetype['type'],
				'post_title'     => preg_replace('/\.[^.]+$/', '', basename($completeVideoPath)),
				'post_content'   => '',
				'post_status'    => 'publish'
		);
		$attachId = wp_insert_attachment( $attachment, $completeVideoPath);
		update_post_meta($post_id, '_preview_id', $attachId);
	}
}