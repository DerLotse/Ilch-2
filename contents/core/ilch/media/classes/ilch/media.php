<?php defined('SYSPATH') or die('No direct script access.');

class Ilch_Media {
	
	/*
	 * Return static files as information array
	 */
	public static function get($file)
	{
		// Find the file extension
		$ext = pathinfo($file, PATHINFO_EXTENSION);

		// Remove the extension from the filename
		$file = substr($file, 0, -(strlen($ext) + 1));

		if ($file = Kohana::find_file('media', $file, $ext))
		{
			return array(
						'body' => file_get_contents($file),
						'content_type' => File::mime_by_ext($ext),
						'last_modified' => filemtime($file)
			);
		}
		else
		{
			return FALSE;
		}
	}
	
	/*
	 * Return static file with document header and body
	 */
	public static function controller(Request $request, Response $response, $file)
	{
		if ($file = Media::get($file))
		{
			// Check if the browser sent an "if-none-match: <etag>" header, and tell if the file hasn't changed
			$response->check_cache(sha1($request->uri()).$file['last_modified'], $request);

			// Send the file content as the response
			$response->body($file['body']);

			// Set the proper headers to allow caching
			$response->headers('content-type',  $file['content_type']);
			$response->headers('last-modified', date('r', $file['last_modified']));
		}
		else
		{
			// Return a 404 status
			$response->status(404);
		}
	}
	
}